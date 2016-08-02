<?php

//亨元对象接口
interface StudentFlyweight{
    public function getStudentState();
}

//班长 一个班只有一个班长
class Monitor {

    private  $state = '';
    private $studentName = '班长';

    public function __construct($state){
        $this->state = $state;
    }

    public function getStudentState(){
        return "{$this->studentName} is {$this->state}ing <br>";
    }
}

//一个班有许多学生
class Student{

    private  $state = '';
    private $studentName = '';

    public function __construct($state){
        $this->state = $state;
    }

    public function setStudentName($studentName){
        $this->studentName = $studentName;
    }

    public function getStudentState(){
      return "{$this->studentName} is {$this->state}ing <br>";
    }
}

//班长属于内蕴状态可共享 班长状态工厂
class StudentFlyweightFactory{

    private $students = [];

    public function getStudent($state){
        if(isset($this->students[$state]))
            return $this->students[$state];
        else
            return $this->students[$state] = new Monitor($state);
    }

    public function getStudents(){
        return $this->students;
    }
}

//client

$studentFlyweightFactory = new studentFlyweightFactory();
$monitorSleep = $studentFlyweightFactory -> getStudent('sleep');
$monitorStudy = $studentFlyweightFactory -> getStudent('study');
$monitorSleep2 = $studentFlyweightFactory -> getStudent('sleep');
echo $monitorSleep2->getStudentState();
var_dump($monitorSleep2 === $monitorSleep);
echo "<br>";
$studentsleep = new Student('sleep');
$studentsleep -> setStudentName('牛牛');
echo $studentsleep->getStudentState();
