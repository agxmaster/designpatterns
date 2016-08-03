<?php
//抽象主体接口
interface LessonSubject{

    public function begin();

    public function regist();
}
//抽象观察者接口
interface LessonObserver{
    public function gotoClassroom();
}
//具体的观察者学生
class Student implements LessonObserver{

    public function gotoClassroom(){
        echo 'student goto classroom <br>';
    }
}
//具体观察者老师
class Teacher implements LessonObserver{

    public function gotoClassroom(){
        echo 'teacher goto classroom <br>';
    }
}
//具体的主体上课
class Lesson{

    private $obj = [];

    public function regist(LessonObserver $observer){
        $this->obj[] = $observer;
    }

    public function begin(){
        echo 'begin class <br>';
        foreach($this->obj as $obj){
            $obj->gotoClassroom();
        }
    }
}

//client 开始上课 老师和学生都到教室里。
$lesson = new Lesson();
$lesson -> regist(new Student());
$lesson -> regist(new Teacher());
$lesson->begin();
