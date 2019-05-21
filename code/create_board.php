<?php
/**
 * Create Board Procedure
 * @author Naisila Puka
 * @version 20/05/2019
 */

  include('utils/config.php');

  //Give me inputs as in these POST functions
  //-----------
  $name = $_POST['name'];
  $description = $_POST['description'];
  $priority = $_POST['priority'];
  $color = $_POST['color'];
  $requirements = $_POST['requirements'];

  // Caution: DATETIME IS IN THIS FORMAT '2000-12-31 23:59:59'
  $estimatedTime = $_POST['estimatedTime'];
  $ownerId = $_POST['userId'];
  $teamId = $_POST['teamId'];
  //-----------

  $name = (string) $name;
  $description = (string) $description;
  $priority = (string) $priority;
  $color = (string) $color;
  $requirements = (string) $requirements;
  $estimatedTime = (string) $estimatedTime;
  $ownerId = (string) $ownerId;
  $teamId = (string) $teamId;

  $reg_query = "INSERT INTO Board(name, description, priority, color, requirements, estimatedTime, ownerID) VALUES ( '$name', '$description', '$priority', '$color', '$requirements', '$estimatedTime', '$ownerId');";

  if(mysqli_query($conn, $reg_query))
  {
    $boardId = mysqli_insert_id($conn);
    $result->status = "success";
    $result->boardId = $boardId;

    //insert into works on
    //$query = "INSERT INTO WorksOn(boardID, teamID) VALUES ('$boardId', '$teamId');";
    //mysqli_query($conn, $query);
  }
  else
  {
    $result->status = "fail";
    $result->boardId = "";
  }

  //{"status": "success", "boardId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>