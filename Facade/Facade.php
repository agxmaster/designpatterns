<?php
//学生类
class Student{

    private $studentInfo = [];

    private $studentId = '';

    private $students = [
        '1' =>['name'  =>  '牛牛','teacher' => '1'],
        '2' =>['name'  =>  '狗狗','teacher' => '2'],
    ];

    public function __construct($studentId){
        $this->studentId = $studentId;
    }

    public function getStudentInfo(){
        if(isset($this->students[$this->studentId]))  return $this->students[$this->studentId];
        else return [];
    }
}

//教室类
class Teacher{

    private $teacherId = '';

    private $teachers = [
        '1' =>['name'  =>  '张老师'],
        '2' =>['name'  =>  '刘老师'],
    ];

    public function __construct($teacherId){
        $this->teacherId = $teacherId;
    }

    public function getTeacherInfo(){
      if(isset($this->teachers[$this->teacherId]))  return $this->teachers[$this->teacherId];
      else return [];
    }
}

//学生信息门面 可以直接获取到学生和对应的老师信息，客户端不用了解学生和教室类。
class StudentFacade{

  private $student = null;
  private $teacher = null;

  public function __construct(){

  }
  public function getStudentInfo($studentId){

      $this->student = new student($studentId);


      $studentInfo = [];
      $studentInfo = $this->student->getStudentInfo();

      if(!empty($studentInfo) && isset($studentInfo['teacher'])){
          $this->teacher = new Teacher($studentInfo['teacher']);
          $studentInfo['teacher'] = $this->teacher->getTeacherInfo();
      }

      return $studentInfo;
  }
}

//client
$studntFace = new StudentFacade();
print_r($studntFace->getStudentInfo(1));
