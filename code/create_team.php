<?php
/**
 * Create Team Procedure
 * @author Naisila Puka
 * @version 19/05/2019
 */

  include('utils/config.php');

  $name = $_POST['name'];
  $userId = $_POST['userId'];
  $affiliation = $_POST['affiliation'];
  $teamKey = $_POST['key'];

  $name = (string) $name;
  $userId = (string) $userId;
  $affiliation = (string) $affiliation;
  $teamKey = (string) $teamKey;

  $reg_query = "INSERT INTO Team(name, supervisor, affiliation, teamKey) VALUES ( '$name', '$userId', '$affiliation', '$teamKey');";


  if(mysqli_query($conn, $reg_query))
  {
    $teamId = mysqli_insert_id($conn);
    $result->status = "success";
    $result->teamId = $teamId;
    $query = "INSERT INTO Member(userID, teamID) VALUES('$userId', '$teamId');";
    mysqli_query($conn, $query)
  }
  else
  {
    $result->status = "fail";
    $result->teamId = "";
  }

  //{"status": "success", "teamId": "12345"}

  $json_res = json_encode($result);
  echo $json_res;
?>