<?php
//学生创建者
class student{
    private $lesson = '';
    private $schedule = '';
    const MAX = 100;
    public function __construct($lesson){
        $this->setlesson($lesson);
    }

    public function study(){
        if($this->schedule < 90)
          $this->schedule += 10;
        else
          $this->schedule = self::MAX;
    }

    public function setlesson($lesson){
        $this->lesson = $lesson;
        $this->schedule = 0;
    }

    public function getStatus(){
        return "正在学习 {$this->lesson} 进度是 {$this->schedule}% <br>";
    }

    public function save(MementoManager $manager,$key){
        $manager->createMemento($key,$this->lesson,$this->schedule);
    }

    public function recovery(MementoManager $manager , $key){
        if(!isset($manager->mementos[$key]))  throw new \Exception("{$key} 状态不存在");
        $this->lesson = $manager->mementos[$key]->lesson;
        $this->schedule = $manager->mementos[$key]->schedule;
    }
}

//备忘录
class Memento{
    public $lesson = 0;
    public $schedule = 0;

    public function __construct($lesson,$schedule){
        $this->lesson = $lesson;
        $this->schedule = $schedule;
    }
}
//备忘录管理者
class MementoManager{
    public  $mementos = [];
    public function createMemento($key,$lesson,$schedule){
        $this->mementos[$key] = new Memento($lesson,$schedule);
    }
}

//client
$manager = new MementoManager();
//学生首学习了英语
$student = new Student('英语');
//学习两次进度20%
$student->study();
$student->study();
echo $student->getStatus();
//保存当前学习英语的进度
$student->save($manager,'english');
//学生又去学习数学
$student->setlesson('数学');
$student->study();
echo $student->getStatus();
//学完数学接着学习英语
$student->recovery($manager, 'english');
$student->study();
echo $student->getStatus();
