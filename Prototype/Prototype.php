<?php
//原型模式接口需要实现copy方法
interface PrototypeInterface{
    public function copy();
}

//原型模式基类
abstract class Prototype implements PrototypeInterface{

    public $sleep = [];

    public $wakeup = [];

    public $clone = [];

    public function __construct(){

    }

    public function __clone(){
        foreach($this->sleep as $pro){
            $this->{$pro} = '';
        }
        $this->setDefaultValue();
    }

    public function __sleep(){
        return $this->sleep;
    }

    public function __wakeup(){
        $this->setDefaultValue();
    }

    public function setDefaultValue(){
        foreach($this->wakeup as $pro => $val){
            $this->{$pro} = $val;
        }
    }
}

//原型管理者
class PrototypeManager{

  const DEEPCOPY = 1;

  const SHALLOWCOPY = 2;

  private  $type = 1;

  private $obj = null;

  public function __construct($obj){
      $this->obj = $obj;
  }

  public function copy(){
      if($this->type == self::SHALLOWCOPY){
          return clone $this->obj;
      }else{
          return unserialize(serialize($this->obj));
      }

  }

  public function setSecretPrototypes($prototypes){
      if($this->type == self::DEEPCOPY){
          $objPrototypes = array_keys(get_object_vars($this->obj));
          foreach($prototypes as $pro){
             if($key = array_search($pro,$objPrototypes) !== false){
                  unset($objPrototypes[$key]);
             }
          }
          $this->obj->sleep = $objPrototypes;

      }else{
          $this->obj->sleep = $prototypes;
      }
      return $this;
  }

  public function setPrototypes($prototypes){
      $this->obj->wakeup = $prototypes;
      return $this;
  }

  public function setType($type){
      $this->type = $type;
      return $this;
  }

}


//原型类
class Student extends Prototype{

  private $studentNumber = '';
  public $teacher = null;

  private $studentName = '';
  private $studentAge = '';
  private $studentLevel = '';

  public function __construct($studentInfo){
     $this->studentNumber = rand(1000,9999);
     $this->teacher = new Teacher();
     if(isset($studentInfo['studentNumber'])) $this->studentNumber = '小明';
     if(isset($studentInfo['studentAge'])) $this->studentAge = '8';
     if(isset($studentInfo['studentLevel']))  $this->studentLevel = '1';

  }

  public function setStudentNumber($studentNumber){
      $this->studentNumber = $studentNumber;
  }

  public function getStudentNumber(){
      return $this->studentNumber;
  }

  public function __set($prototypeName,$prototypeValue){
      if(property_exists($this,$prototypeName)) $this->{$prototypeName} = $prototypeValue;
      else  throw new Exception('prototype not exist!');
  }

  public function __get($prototypeName){
      if(property_exists($this,$prototypeName)) return $this->{$prototypeName};
      throw new Exception('prototype not exist!');
  }

  public function copy(){
      parent::copy();
  }
}
//原型类的附属类
class Teacher{

    private $teacherId = '';
    public function __construct(){
      $this->teacherId = rand(1000,9999);
    }

    public function getTeacherId(){
      return $this->teacherId;
    }

    public function setTeacherId($teacherId){
      $this->teacherId = $teacherId;
    }
}


//clinet
$studenta = new Student([
  'studentName' => '小明',
  'studentAge'  =>  '8',
  'studentLevel'=>  '1'
]);

$prototypeManager = new PrototypeManager($studenta);

//这只是个例子作为原型模式主要是为了节省创建对象的消耗没必要写这么复杂。
$studentb = $prototypeManager
          ->setType(1)
          ->setSecretPrototypes(['studentNumber'])
          ->setPrototypes(['studentAge' => '10'])
          ->copy();

$studentc = $prototypeManager
          ->setType(2)
          ->setSecretPrototypes(['studentNumber'])
          ->setPrototypes(['studentAge' => '10'])
          ->copy();

var_dump($studentb);

echo $studentb->getStudentNumber();
echo "<br>";
echo $studentb->studentAge;
echo "<br>";
echo $studentb->studentNumber;
