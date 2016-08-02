<?php
//抽象魔板
abstract class TemplateStudent{

  public function gotoSchool(){
      echo $this->getup();
      echo $this->toShcool();
  }

  public abstract function getup();
  public abstract function toShcool();

}

//具体的在校生
class StudentAtShcool extends TemplateStudent{

    public function getup(){
        return '起床 <br>';
    }

    public function toShcool(){
        return 'walk <br>';
    }
}
//具体的跑校生
class StudentAtHome extends TemplateStudent{
    public function getup(){
        return '起床 <br>';
    }

    public function toShcool(){
        return 'bus <br>';
    }
}
//client
$studentAtHome = new studentAtHome();
$StudentAtShcool = new StudentAtShcool();
$studentAtHome->gotoSchool();
$StudentAtShcool->gotoSchool();
