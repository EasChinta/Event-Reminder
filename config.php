<?php 
	$con=mysqli_connect("localhost","root","","db_event_reminder");

   #flash message
   function flash($description='',$msg='',$cate='green'){
    if(!empty($description)){
      if(!empty($msg)&&empty($_SESSION[$description])){
        $_SESSION[$description]=$description;
        $_SESSION[$description."_msg"]=$msg;
        $_SESSION[$description."_cate"]=$cate;
      }
      else if(empty($msg)&&!empty($_SESSION[$description])){
        echo "<div class='alert-{$_SESSION[$description."_cate"]}'>{$_SESSION[$description."_msg"]}</div>";
        unset($_SESSION[$description]);
        unset($_SESSION[$description."_msg"]);
        unset($_SESSION[$description."_cate"]);
      }
    }
  }
?>