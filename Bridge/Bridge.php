<?php

//学生主体类 程序中有两个属性 （性别、学校）各有两个维度 男、女 高中、大学
class Student{

    private $gender = '';
    private $school = '';
    private $name = '';

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function setGender(Gender $gender){
        $this->gender = $gender->getGender();
        return $this;
    }

    public function setSchool(School $school){
        $this->school = $school->getSchool();
        return $this;
    }

    public function __tostring(){
        return "Student : {$this->name} , {$this->gender} , {$this->school} <br>";
    }
}

//属性性别抽象
abstract class Gender{
    public abstract function getGender();
}

//属性学校抽象
abstract class School{
    public abstract function getSchool();
}

//属性维度高中
class HighSchool extends School{

    private $school = '高中';

    public function getSchool(){
        return $this->school;
    }
}

//属性维度大学
class University extends School{
    private $school = '大学';

    public function getSchool(){
        return $this->school;
    }
}

//属性维度男
class Man extends Gender{
    private $gender = '男';
    public function getGender(){
        return $this->gender;
    }
}

//属性维度女
class Woman extends Gender{
    private $gender = '女';
    public function getGender(){
        return $this->gender;
    }
}

//client
$studenta = new Student();
$studenta
  ->setName('牛牛')
  ->setGender(new Man())
  ->setSchool(new HighSchool());

$studentb = new Student();
$studentb
  ->setName('狗狗')
  ->setGender(new Man())
  ->setSchool(new University());

echo $studenta,$studentb;
