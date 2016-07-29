<?php
//上课类
class OnClass{
    private $flow = [];
    public function setFlow($flow){
        $this->flow[] = $flow;
    }

    public function getFlow(){
      return $this->flow;
    }
}

//建造者接口
interface Builder{
  public function sign();
  public function lecture();
  public function schoolwork();
  public function gohome();
}

//建造者
class Student implements Builder{
  private $class = null;
  public function __construct(OnClass $class){
    $this->class = $class;
  }
  public function sign(){
      $this->class->setFlow('签到');
  }

  public function lecture(){
      $this->class->setFlow('听课');
  }

  public function schoolwork(){
      $this->class->setFlow('写作业');
  }

  public function gohome(){
      $this->class->setFlow('回家');
  }
}

//指导者
class Director{
    public function onClass(Student $student){
        $student->sign();
        $student->lecture();
        $student->schoolwork();
    }
}

$class = new Onclass();
//client
$student = new Student($class);
//指导者本身不做任何事，所有处理由构造者处理
$director = new director();
//学生上课是一个复杂的过程 使用者不必知道细节 构造者内部定义了流程。
$director->onClass($student);
//放学回家
$student->gohome();
print_r($class->getFlow());
