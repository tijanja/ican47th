<?php
include_once './model/include.php';

class ICAN {
     private $_params;
    
    function __construct($params)
    {
        $this->_params =$params;
    }
    
    function loginAction()
    {
       $auth = new Auth(); 
       return $auth->login($this->_params);
    }
    
    function getQuestionAction()
    {
        $quest = new Question();
        return $quest->fetchQuestion($this->_params);
    }
    
    function submitAnswerAction()
    {
        $quest = new Question();
        return $quest->updateQuestion($this->_params);
    }
    
    function getScoreListingAction()
    {
        $scoreBoard = new ScoreBoard();
        return $scoreBoard->getScoreRating();
    }
    
    function shareScoreAction()
    {
         $scoreBoard = new ScoreBoard();
         return $scoreBoard->share($this->_params);
    }
    
    function rateingAction()
    {
        
    }
    
    function markAttendanceAction()
    {
        
    }
    
    function getVideoListAction()
    {
         $a["name"] = "Investiture of the 53rd ICAN President - Live stream. 30/05/2017";
         $a["links"] = "https://www.youtube.com/embed/kxiMBQOCHCU";
         
         $b["name"] = "45th Annual Accountants' Conference and 5oth Anniversary celebration";
         $b["links"] = "https://www.youtube.com/embed/M97WnoNmunw";
         
         $c["name"] = "2015 Annual Dinner & Awards";
         $c["links"] = "https://www.youtube.com/embed/tos89-FQED0";
         
         return array($a,$b,$c);
        
    }
    
    function encryptAction()
    {
       
        $auth = new Auth();
        return $auth->encrypt($this->_params);
    }
    
    function decryptAction()
    {
        
    }
}
