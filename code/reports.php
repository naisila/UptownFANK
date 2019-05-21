<?php

    include('utils/config.php');

    mysqli_query($conn, 'DROP TABLE IF EXISTS membersNo;');
    mysqli_query($conn, 'CREATE TABLE membersNo AS SELECT teamID, COUNT(userID) as memberCount FROM Member GROUP BY teamID;');

    $result = mysqli_query($conn,'SELECT t.name, B.name as supervisor, m.memberCount FROM Team t NATURAL JOIN membersNo m JOIN BasicUser B ON B.userID = t.supervisor WHERE m.memberCount >= ALL (SELECT memberCount FROM membersNo);');

    echo'<br>';
    echo'This report shows The team with the largest number of members, along with its supervisor and
the number of members:';
    echo'<br>';
    echo '<table border="1">
        <tr>
          <th>Team Name</th>
          <th>Team Supervisor</th>
        <th>Number of Members</th>
        </tr>';

                                              while($row = mysqli_fetch_array($result))
                                              {
                                              echo '<tr>';
                                              echo '<td>' . $row["name"] . '</td>';
                                              echo '<td>' . $row["supervisor"] . '</td>';
                                              echo '<td>' . $row["memberCount"] . '</td>';
                                              echo '</tr>';
                                              }
                                              echo '</table>';

    $result = mysqli_query($conn, 'SELECT u.name, u.email FROM BasicUser u WHERE NOT EXISTS(
SELECT t.teamID FROM Team t WHERE t.supervisor = 1 AND t.teamID NOT IN
(SELECT m.teamID FROM Member m WHERE m.userID = u.userID));');
    echo'<br>';
    echo'This report shows users who are part of all projects supervised by a particular user:';
    echo'<br>';
    echo '<table border="1">
        <tr>
          <th>User Name</th>
          <th>User Email</th>
        </tr>';

                                              while($row = mysqli_fetch_array($result))
                                              {
                                              echo '<tr>';
                                              echo '<td>' . $row["name"] . '</td>';
                                              echo '<td>' . $row["email"] . '</td>';
                                              echo '</tr>';
                                              }
                                              echo '</table>';
?>