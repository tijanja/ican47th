<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author ADMIN
 */
class Auth extends Connection{
   
    var $EC_Key = "B374A26A71490437AA024E4FADD5B497FDFF1A8EA6FF12F6FB65AF2720B59CCF";
    function __construct() {
        parent::__construct();
    }
            function login($params) {
        
        $username = ucwords($params->username);
        $password = ucwords($params->password);
         
            $result = $this->db->query("select * from Members where memberId='$username' and registrationNum='$password'");
           
            if($result->num_rows>0)
            {
               $obj = $result->fetch_object();
               $return_res["action"] = TRUE;
               $return_res['data']=$obj;
               return $return_res; 
            }
           else
               {
                    return "{'action':false}";
               }
             
      
 
    }
    
    function encrypt($param)
    {
        $obj = json_encode($param);
        echo $obj->loginId."-----";
        $ecLoginId = AesCtr::encrypt($obj->loginId, $this->EC_Key, 256);
        $ecPassword = AesCtr::encrypt($obj->password, $this->EC_Key, 256);
        $ecUUID = AesCtr::encrypt($obj->device_uuid, $this->EC_Key, 256);
        
        return array("loginId"=>$ecLoginId,"password"=>$ecPassword,"device_uuid"=>$ecUUID);
    }
}
