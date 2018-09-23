<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Question
 *
 * @author ADMIN
 */
class Question extends Connection
{
    function __construct() {
        parent::__construct();
    }
    
    private function getQuestion($param)
    {
        $count = 1;
       $result = $this->db->query("select * from question_table order by rand() limit 1"); 
       $obj = $result->fetch_object(); 
       
       if($this->isQuestionAnswered($param,$obj->id) && $count<=50)
       {
           $count +=1;
           return $this->getQuestion($param);
       }
 else {
       
         
          return $obj;  
       }
        
    }
    
    private function isQuestionAnswered($param,$questId)
    {
        $memberId = trim($param->memberId);
        $result = $this->db->query("select count(id) as rows from question_answered where question_id='$questId' and memberId='$memberId';");
        $obj = $result->fetch_object();
        if($obj->rows<=50)
        {
            $result->free();
            return FALSE; 
        }
        else
        {
            $result->free();
            return TRUE;
        }
    }


    private function quizAnswered($param)
    {
        $memberId = trim($param->memberId);
        $result = $this->db->query("SELECT * FROM question_answered where memberId='$memberId';");
       $obj = $result->num_rows;
       return $obj;
        
    }
    
    private function submitAnswer($param)
    {
        $questObj = $param;
        
        $questId = trim($questObj->questionid);
        $memberId = trim($questObj->memberId);
        $userOption = trim($questObj->answer);
        $right = trim($questObj->numRight);
        $wrong = trim($questObj->numWrong);
        
        
        $correctOption = trim($this->getCorrectAnswer($questId));
        
        if($userOption==$correctOption)
        {
            $flag = 1;
        }
        else
        {
            $flag = 0;
        }
        
        $this->db->query("INSERT INTO question_answered VALUES('','$questId','$memberId','$userOption','$correctOption','$flag')");
        $this->updateRightWrong($memberId, $right, $wrong);
        //echo $this->db->error;
    }
    
    private function updateRightWrong($memberid,$right,$wrong)
    {
        $m = trim($memberid);
        $r = trim($right);
        $w = trim($wrong);
        $total = $r + $w;
        
        $this->db->query("UPDATE Members set numRight='$r',numWrong='$w', totalAnswered='$total' where memberId='$m' limit 1;");
    }
    
    private function getRightWrong($p)
    {
        $memberId = trim($p->memberId);
        
       $result = $this->db->query("SELECT numRight,numWrong FROM Members where memberId='$memberId' limit 1;"); 
       return $result->fetch_object(); 
    }


    private function getCorrectAnswer($questId)
    {
        $result = $this->db->query("select answer as answer from question_table where id='$questId' limit 1;"); 
        $obj = $result->fetch_object();
        return $obj->answer;
    }
            
    function fetchQuestion($param)
    {
        $totalAnswered = $this->quizAnswered($param);
        if($totalAnswered<=50)
        {
            //print_r($param);
            $returns['action']=TRUE;
            $returns['rightWrong']= $this->getRightWrong($param);
            $returns['totalAnswered'] = $totalAnswered;
            $returns['nextQuest'] = $this->getQuestion($param); 
        }
        else
        {
            $returns['action']=FALSE;
            $returns['message'] = "You have completed your 50 questions.";
           $returns['totalAnswered'] = $totalAnswered;
            
        }
        $this->db->close();
        return $returns;
        
    }
    
    function updateQuestion($param)
    {
        $this->submitAnswer($param);
       if($this->quizAnswered($param)<=50)
       {
            $response['action'] = TRUE;
            //$response['rightWrong']= $this->getRightWrong($param);
            //$response['nextQuest'] = $this->getQuestion($param);
            
             
        }
        else
        {
            $response['action'] = FALSE;
            $response['message'] = "You have completed your 50 questions.";
        }
        $this->db->close();
        return $response;
    }
}
