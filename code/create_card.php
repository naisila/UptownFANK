<?php
/**
 * Creating card 
 * @author Kunduz Efronova
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------

  $name = $_POST['name'];
  $priority = $_POST['priority'];
  $description = $_POST['description'];
  $dueDate = $_POST['dueDate'];
  $archived = $_POST['archived'];
  $finished = $_POST['finished'];
  $listId = $_POST['listId'];
 
  $name = (string) $name;
  $finished = (string) $finished;
  $archived = (string) $archived;
  $description = (string) $description;
  $priority = (string) $priority;
  $listId = (string) $listId;
  $dueDate = (string) $dueDate;

  $reg_query = "INSERT INTO List(name, priority, description, dueDate, listID, archived, finished) VALUES ( '$name', '$priority', '$description', '$dueDate', '$listId', '$archived', '$finished');";

  if(mysqli_query($conn, $reg_query))
  {
    $cardId = mysqli_insert_id($conn);
    $result->status = "success";
    $result->cardId = $cardId;
  }
  else
  {
    $result->status = "fail";
    $result->cardId = "";
  }

  //{"status": "success", "boardID": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>