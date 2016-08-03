<?php

//命令接收者
class Student{

    public function beginClass(){
        echo '开始上课 <br>';
    }

    public function endClass(){
        echo '下课 <br>';
    }
}

//抽象命令接口
interface Command{
    public function action();
}

//具体命令 上课
class BeginClassCommand implements Command{

    private $student = null;
    public function __construct(Student $student){
        $this->student = $student;
    }

    public function action(){
        $this->student->beginClass();
    }
}

//具体命令 下课
class EndClassCommand implements Command{

    private $student = null;
    public function __construct(Student $student){
        $this->student = $student;
    }

    public function action(){
        $this->student->endClass();
    }
}

//命名控制者
class Teacher{

    private $command = [];

    public function addCommand(Command $command){
        $this->command[get_class($command)] = $command;
    }

    public function Command($command){
        $command = ucwords($command);
        if(!isset($this->command[$command]))
          throw new \Exception("{$command} not found");
        $this->command[$command] -> action();
    }
}

//client 控制者添加命令 控制者发布命令 如果需要添加命令 只需要新建具体命令 命令接收添加处理，不会影响其他命令。
$student = new Student();
$teacher = new Teacher();
$teacher->addCommand(new beginClassCommand($student));
$teacher->addCommand(new endClassCommand($student));

echo $teacher->Command('beginClassCommand');
echo $teacher->Command('endClassCommand');
