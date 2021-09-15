<?php
require 'db.php';
if (isset($_POST['comment_posted'])) {


    $name=$_POST['name'];
    $email=$_POST['email'];
    $comment=$_POST['comment'];
    $parent=$_POST["comment_id"];
    




    $sql="INSERT INTO comments(name,email,comment,parent) VALUES ('$name','$email','$comment','$parent')";
    
    if($conn ->query($sql)){
      echo json_encode(array("statusCode"=>200));
    }
    else
    echo json_encode(array("statusCode"=>201));
  }
  
    if (isset($_POST['reply_posted'])) {
    
      $reply_name=$_POST['reply_name'];
      $reply_email=$_POST['reply_email'];
      $reply_comment=$_POST['reply_comment'];
      $reply_parent = $_POST['comment_id']; 
      
      $sql="INSERT INTO comments(name,email,comment,parent) VALUES ('$reply_name','$reply_email','$reply_comment','$reply_parent')";
      if($conn ->query($sql)){
        echo json_encode(array("statusCode"=>200));
      }
      else
      echo json_encode(array("statusCode"=>201));
    }

?>


     



