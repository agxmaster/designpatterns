<?php
//建造者接口
interface Builder{
  public function sign();
  public function lecture();
  public function schoolwork();
  public function gohome();
}

class Student implements Builder{
  public function sign(){
      echo '签到';
      return $this;
  }

  public function lecture(){
      echo '听课';
      return $this;
  }

  public function schoolwork(){
      echo '写作业';
      return $this;
  }

  public function gohome(){
      echo '回家';
      return $this;
  }
}

//指导者可直接针对接口编程
class Director{
    public function onClass(Student $student){
        $student->sign()->lecture()->schoolwork();
    }
}

//client
$student = new Student();
//指导者本身不做任何事，所有处理由构造者处理
$director = new director();
//学生上课是一个复杂的过程 使用者不必知道细节 构造者内部定义了流程。
$director->onClass($student);
//放学回家
$student->gohome();
