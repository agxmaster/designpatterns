<?php
abstract class abstractFactory{
    public abstract function createMan();
    public abstract function createWoman();
}

class StudentFactory extends abstractFactory{
    public function createMan(){
        return new StudentMan();
    }
    public function createWoman(){
        return new StudentWoman();
    }
}

class TeacherFactory extends abstractFactory{
    public function createMan(){
        return new TeacherMan();
    }
    public function createWoman(){
        return new TeacherWoman();
    }
}

class StudentMan{}
class StudentWoman{}
class TeacherWoman{}
class TeacherMan{}

//client
//示例结合了方法工厂模式和抽象工厂模式，
//方法工厂模式 修改时隔离了方法
//抽象工厂模式 修改时隔离了类
$studentFactory = new StudentFactory();
$studentMan = $studentFactory->createMan();
$studentWoman = $studentFactory->createWoman();
