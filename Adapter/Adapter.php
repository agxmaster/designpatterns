<?php

//现在需要的接口 学生上课、老师教书 需要适配成 学生、老师 工作
interface Worker {
  public function dosomething();
}

abstract class Role {

}

class Student extends Role{

  public function study(){
      return '学生上课';
  }

}

class Teacher extends Role{
  public function teaching(){
      return '老师教书';
  }
}

//适配器类
class Adapter implements Worker{
  private $role = null;
  public function __construct(Role $role){
      $this->role = $role;
  }

  public function dosomething(){
      $work = '工作:';
      if($this->role instanceof Teacher){
          $work .= $this->role->teaching();
      }elseif($this->role instanceof Student){
          $work .= $this->role->study();
      }

      return $work;
  }
}

//client
$adpStudent = new Adapter(new Student());
echo $adpStudent->dosomething();
echo "<br>";
$adpTeacher = new Adapter(new Teacher());
echo $adpTeacher->dosomething();
