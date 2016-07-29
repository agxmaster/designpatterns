<?php
//简单工厂模式
class Factory{
    private static $map = [
        1   =>  'Man',
        2   =>  'Woman'
    ];
    
    public static function create($sex){
       switch($sex){
          case '1':
            return new Man();
            break;

          case '2':
            return new Woman();
            break;
       }
    }
    
    public static function create2($sex){
        if(!isset(self::$map[$sex]))
            throw new Exception('not found keyWord!');
        return new self::$map[$sex];
    }
}

class Man{}
class Woman{}

//client
$man = Factory::create(1);
$woman = Factory::create(2);
