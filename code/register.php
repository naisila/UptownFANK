<?php
  include_once('utils/config.php');

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $organization = $_POST['organization'];

  $name = mysqli_real_escape_string($conn, $name);
  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);
  $address = mysqli_real_escape_string($conn, $address);
  $phone = mysqli_real_escape_string($conn, $phone);
  $organization = mysqli_real_escape_string($conn, $organization);

  $name = (string) $name;
  $email = (string) $email;
  $password = (string) $password;
  $address = (string) $address;
  $phone = (string) $phone;
  $organization = (string) $organization;

  $reg_query = "INSERT INTO BasicUser(name, email, password, address) VALUES ( '$name', '$email', '$password', '$address');";


  $reg_result = mysqli_query($conn, $reg_query);
  $user_id = mysqli_insert_id($conn);
  $row = mysqli_fetch_array($reg_result);


  if($row[0] > 0)
  {
    $result->status = "success";

    //not a superuser
    if(empty($organization))
    {
    }
    //superuser
    else
    {
      $superuser = "INSERT INTO SuperUser(userID, organization) VALUES ()"
      echo "Please set a password";
    }
  }
  else
  {
    $result->status = "fail";
    $result->userID = "";
  }

  $json_res = json_encode($result);
  echo $json_res;

?>