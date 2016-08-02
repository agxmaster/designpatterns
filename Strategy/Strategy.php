<?php
//策略接口
interface StudyStrategy{
    public function study();
}

//具体的学习策略直播
class Live implements StudyStrategy{
    public function study(){
        return 'live stduy <br>';
    }
}

//具体的学习策略回播
class Playback implements StudyStrategy{
    public function study(){
        return 'playback study <br>';
    }
}

//策略选择类
class StudentStudy{

    private $study = null;

    public function __construct(StudyStrategy $starategy){
        $this->study = $starategy;
    }

    public function getStudyMethod(){
        return $this->study->study();
    }
}
$studyLive = new StudentStudy(new Live());
echo $studyLive ->getStudyMethod();
$studyLive = new StudentStudy(new playback());
echo $studyLive ->getStudyMethod();
