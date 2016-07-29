<?php
namespace Singleton;
class Singleton{

  private static $instance;

  private function __construct(){}

  public static function getInstance(){
      if(!(self::$instance instanceof self))
        self::$instance = new self;
      return self::$instance;
  }

  private function __clone(){}

}

//client
$singleton = Singleton::getInstance();
