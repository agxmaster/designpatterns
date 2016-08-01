<?php

//文件系统抽象类
abstract class System{
    public abstract function getStruct();

    protected $fileName;

    public function getName(){
        return $this->fileName;
    }


}

//文件夹
class Floder extends System{

    private $children = [];

    private $tree = [];

    public function __construct($name){
        $this->fileName = $name;
    }

    public function addChild(System $system){
        $this->children[$system->getName()] = $system;
    }

    public function removeChild(System $system){
        if(isset($this->children[$system->getName])){
           unset($this->children[$system->getName]);
           return true;
        }else{
          return false;
        }
    }

    public function getChildren(){
        return $this->children;
    }

    public function getStruct(&$tree = null){

        $tree['name'] = $this->fileName;
        if(!empty($this->children)){
            foreach($this->children as $child){
                $child->getStruct($tree['child']);
            }
        }
        return $tree;
    }
}

//文件
class File extends System{

    public function __construct($name){
        $this->fileName = $name;
    }

    public function getStruct(&$tree = null){
        $tree['name'] = $this->fileName;
    }
}

//client
$windosSystem = new Floder("我的电脑");
$c = new Floder("c盘");
$d = new Floder("D盘");

$system32 = new Floder("system32");
$hosts = new File("hosts");
$windosSystem -> addChild($c);
$windosSystem-> addChild($d);
$c->addChild($system32);
$system32->addChild($hosts);
print_r($windosSystem->getStruct());
print_r($windosSystem);
