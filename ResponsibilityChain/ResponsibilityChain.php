<?php
//请求
class RequestLeave{
    public $days = 0;
    public function __construct($days){
        $this->days = $days;
    }
}

//责任链维护者
class ResponsibilityChain{
    private $manager = null;
    public function __construct(RequestLeave $request){
        $this->manager = new Monitor($request);
        $this->manager->setLeader(new Headmaster($request));
    }

    public function handle(){
        $this->manager->handle();
    }
}
//抽象责任角色
abstract class Manager{
    protected $leader = null;
    protected $request = null;

    public abstract function handle();

    public function leaderHandle(){
        if($this->leader){
            $this->leader->handle();
        }else{
            echo 'sorry 这个请求还没有人能处理';
        }
    }
}
//班长具体责任角色
class Monitor extends Manager{

    public function __construct(RequestLeave $request){
        $this->request = $request;
    }

    public function setLeader(Manager $manager){
        $this->leader = $manager;
    }

    public function handle(){
        if($this->request->days < 1){
            echo "班长:请假{$this->request->days}天没问题 <br>";
        }else{
            $this->leaderHandle();
        }
    }
}
//班主任具体责任角色
class Headmaster extends Manager{

  public function __construct(RequestLeave $request){
      $this->request = $request;
  }

  public function setLeader(Manager $manager){
      $this->leader = $manager;
  }

  public function handle(){
    if($this->request->days < 7){
        echo "班主任:请假{$this->request->days}天没问题 <br>";
    }else{
        $this->leaderHandle();
    }
  }
}

//client

(new ResponsibilityChain(new RequestLeave(3)))->handle();
(new ResponsibilityChain(new RequestLeave(0.5)))->handle();
(new ResponsibilityChain(new RequestLeave(10)))->handle();
