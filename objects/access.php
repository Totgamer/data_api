<?php
class Access {
   private $conn;
   private $id;
   private $apikey;
   private $name;
   function __construct($db) {
       $this->conn = $db;
   }

   function Validate($user, $key) {
    $sql = "SELECT user, apikey FROM `access` WHERE user = '$user' AND apikey = '$key'";
    $result = $this->conn->query($sql);
    $num = $result->num_rows;
    if($num>0){
        $validate = true;
    }else{
        $validate = false;
    }
    var_dump($_POST);
    return $validate;
}
}