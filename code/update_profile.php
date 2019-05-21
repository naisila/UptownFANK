<?php
/**
 * Create Board Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $userId = $_POST['userId'];
  $email = $_POST['email'];
  $name = $_POST['name'];
  $address = $_POST['address'];
  //-----------

  $userId = (string) $userId;
  $email = (string) $email;
  $name = (string) $name;
  $address = (string) $address;

  mysqli_query($conn, "UPDATE BasicUser SET name = '$name' WHERE userID = '$userId';");
  mysqli_query($conn, "UPDATE BasicUser SET address = '$address' WHERE userID = '$userId';");
  mysqli_query($conn, "UPDATE BasicUser SET email = '$email' WHERE userID = '$userId';");
  
  $result->status = "success";

  //{"status": "success", "boardId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>