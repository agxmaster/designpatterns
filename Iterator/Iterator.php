<?php
//迭代器模式利用php spl提供的迭代器接口实现对象属性的遍历
class Sign implements Iterator{

    private $students = [];
    private $index = 0;

    public function __construct($students){
        $this->students = $students;
    }

    public function addStudent($student){
        $this->students[] = $student;
    }

    public function valid(){
        return isset($this->students[$this->index]);
    }

    public function current(){
      return $this->students[$this->index];
   }

   public function key(){
      return $this->index;
   }

   public function next(){
      $this->index++;
   }
   public function rewind(){
      $this->index = 0;
   }
}

//client 
$sign = new Sign(array('牛牛','虎虎'));
$sign->addStudent('狗狗');


while($sign->valid()){
  print_r($sign->current());
  $sign->next();
  echo "签到<br>";
}

foreach($sign as $k => $v){
    echo "{$k} => {$v}签到<br>";
}
