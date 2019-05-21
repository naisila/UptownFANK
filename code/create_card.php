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

  //Caution: DATETIME IS IN THIS FORMAT '2000-12-31 23:59:59'
  $dueDate = $_POST['dueDate'];

  //SHOULD BE EITHER 'True' or 'False'
  $archived = $_POST['archived'];

  //SHOULD BE EITHER 'True' or 'False'
  $finished = $_POST['finished'];
  $listId = $_POST['listId'];
  //-----------

  $name = (string) $name;
  $finished = (string) $finished;
  $archived = (string) $archived;
  $description = (string) $description;
  $priority = (string) $priority;
  $listId = (string) $listId;
  $dueDate = (string) $dueDate;

  $reg_query = "INSERT INTO Card(name, priority, description, dueDate, listID, archived, finished) VALUES ( '$name', '$priority', '$description', '$dueDate', '$listId', '$archived', '$finished');";

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

  //output in the form
  //{"status": "success", "cardId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>