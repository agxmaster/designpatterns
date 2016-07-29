<?php
class Student{
  private $studentNumber = '';
  public $teacher = null;

  public function __construct(){
     $this->studentNumber = rand(1000,9999);
     $this->teacher = new Teacher();
  }

  public function setStudentNumber($studentNumber){
      $this->studentNumber = $studentNumber;
  }

  public function getStudentNumber(){
      return $this->studentNumber;
  }

  public function __clone(){
      $this->studentNumber = '';
  }

  public function __sleep(){
     return ['teacher'];
  }

  public function __wakeup(){
     $this->studentNumber = '00000';
  }
}

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

//php类都是引用传递所以studenta和studentb是一个对象
$studenta = new student();
$studentb = unserialize(serialize($studenta));

echo $studentb->getStudentNumber();
echo "<br>";
echo $studenta->getStudentNumber();

echo $studenta->teacher->getTeacherId();
echo "<br>";
echo $studentb->teacher->getTeacherId();
