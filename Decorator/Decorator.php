<?php
//学生信息接口
interface StudentInterface{
    public function setInfo();
}

//学生信息类
class Student implements StudentInterface{

    private $info = [];

    public function setInfo($info = ''){

        foreach($info as $infok => $infov){
            $this->info[$infok] = $infov;
        }

    }

    public function getInfo(){
        return $this->info;
    }

}

//抽象装饰者
abstract class Decorator implements StudentInterface{

    public $student = null;

    public function __construct(Student $student){
        $this->student = $student;
    }

    public abstract function setInfo();
}

//性别装饰者
class GenderDecorator extends Decorator{

    const MAN = '男';

    const WOMAN = '女';

    private $gender = '';

    public function __construct(Student $student){
        parent::__construct($student);
    }

    public function setGender($gender){
        $this->gender = $gender;
    }

    public function setInfo(){
        $this->student->setInfo(['gender' => $this->gender]);
    }
}

//学校装饰者
class SchoolDecorator extends Decorator{

    private $school = '';

    public function __construct(Student $student){
        parent::__construct($student);
    }

    public function setSchool($school){
        $this->school = $school;
    }

    public function setInfo(){
        $this->student->setInfo(['school' => $this->school]);
    }
}

//client 不改动Student类机器继承关系的情况下扩展了Student类 本例子不明显..
$student = new Student();
$student->setInfo(['name' => '牛牛']);

$school = new SchoolDecorator($student);
$school->setSchool('北京大学');
$school->setInfo();


$gender = new GenderDecorator($student);
$gender->setGender(GenderDecorator::MAN);
$gender->setInfo();
print_r($student->getInfo());
