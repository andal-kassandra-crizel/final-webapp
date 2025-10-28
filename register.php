<?php

include 'dbconnection.php';

if(! empty($_POST)){
//    echo '<pre>';
//    var_dump($_POST);
//    echo '</pre>';

   

   $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

   $query = "INSERT INTO account (firstname,middlename,lastname, email,password) VALUES (?, ?, ?, ?, ?)";

   $stmt = $pdo->prepare($query);

   $insertedId = $stmt->execute([$_POST['firstname'],$_POST['middlename'],$_POST['lastname'],$_POST['email'],$hashedPassword]);

   if ($insertedId) {
      session_start();
      $_SESSION['msg_success'] = 'Registered successfully, you may now login.';
      header("location: login.php");
   }

}


die();