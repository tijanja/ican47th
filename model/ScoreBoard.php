<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ScoreBoard
 *
 * @author ADMIN
 */
class ScoreBoard extends Connection{
    
    function __construct()
    {
        parent::__construct();
    }
    
    private function getMedal($r)
    {
        switch ($r)
        {
            case 1:
                
                return 'first';
                break;
             case 2:
                
                return 'second';
                break;
             case 3:
                
                return 'third';
                break;
            default :
                return 'medal';
        }
    }
            
   function getScoreRating()
   {
       $result = $this->db->query("SELECT memberId,fname, lname, numRight, 
CASE 
WHEN @prevRank = numRight THEN @curRank 
WHEN @prevRank := numRight THEN @curRank := @curRank + 1
END AS rank
FROM Members p, 
(SELECT @curRank :=0, @prevRank := NULL) r
WHERE numRight !=0 ORDER BY numRight desc limit 100;");
       
       while($row = $result->fetch_assoc())
       {
           $members[] = array("memberid"=>$row['memberId'],"fname"=>$row['fname'],"lname"=>$row['lname'],"score"=>$row['numRight'],"rank"=>$row['rank'],"medal"=> $this->getMedal($row['rank']));
       }
       
       return $members;
   }
    
   function share($param)
   {
       $memberid = trim($param->memberid);
       if($this->db->query("UPDATE Members set status='1' WHERE memberid='$memberid' limit 1;"))
       {
           $item["action"] = true;
           return $item;
       }
       else
       {
           $item["action"] = false;
           return $item;
       }
       
               
   }
}
