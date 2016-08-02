<?php
//签到接口
interface sign{
    public function sign();
    public function signout();
}
//学生签到类
class Student implements sign{
    private $signs = [];
    public function sign($time = ''){
        $this->signs[] = ['sign' => $this->getTime($time)];
    }

    public function signout($time = ''){
        $this->signs[] = ['signout' => $this->getTime($time)];
    }

    public function getTime($time){
        return $time ? $time : time();
    }

    public function getSign(){
        return $this->signs;
    }
}
//机器人代理 学生偷懒的时候可以请机器人代打卡
class RobotProxy implements sign{

    private $student = null;
    public function __construct(Student $student){
        $this->student = $student;
    }
    public function sign($time = ''){
        $this->student->sign($time);
    }

    public function signout($time = ''){
        $this->student->signout($time);
    }
}

//client
$student = new Student();
$robotProxy = new RobotProxy($student);
$robotProxy->sign('08:00');
$robotProxy->signout('09:00');
$student->sign('13:00');
print_r($student->getsign());
