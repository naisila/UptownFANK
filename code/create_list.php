<?php
/**
 * Creating list
 * @author Kunduz Efronova
 * @version 19/05/2019
 */

  include('utils/config.php');

  $name = $_POST['name'];

  //Should be either 'True' or 'False'
  $finishedStatus = $_POST['finishedStatus'];
  $color = $_POST['color'];
  $description = $_POST['description'];
  $activity = $_POST['activity'];
  $boardId = $_POST['boardId'];
 
  $name = (string) $name;
  $finishedStatus = (string) $finishedStatus;
  $color = (string) $color;
  $description = (string) $description;
  $activity = (string) $activity;
  $boardId = (string) $boardId;

  $reg_query = "INSERT INTO List(name, finishedStatus, color, description, activity, boardID) VALUES ( '$name', '$finishedStaus', '$color', '$description', '$activity', '$boardId');";


  if(mysqli_query($conn, $reg_query))
  {
    $listId = mysqli_insert_id($conn);
    $result->status = "success";
    $result->listId = $listId;
  }
  else
  {
    $result->status = "fail";
    $result->listId = "";
  }

  //output in the form
  //{"status": "success", "listId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>