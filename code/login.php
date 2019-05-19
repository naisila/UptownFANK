<?php
  include('utils/config.php');

  $email = $_POST['email'];
  $password = $_POST['password'];

  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);

  $email = (string) $email;
  $password = (string) $password;

  $reg_query = "SELECT userID FROM BasicUser WHERE email = '$email' AND password = '$password';";
  $res = mysqli_query($conn, $reg_query);


  //$reg_result = mysqli_query($conn, $reg_query);
  
  //$row = mysqli_fetch_array($reg_result);


  if($res)
  {
    $user_id = $res->fetch_assoc()["userID"];
    $result->status = "success";
    $result->userID = $user_id;
  }
  else
  {
    $result->status = "fail";
    $result->userID = "";
  }

  //{"status": "success", "userID": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>