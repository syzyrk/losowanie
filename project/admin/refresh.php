<?php
include "../db_conn.php";
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>
<table border=1>
    <tbody id="userTable">
<?php
      while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          $index = 0;
          foreach ($row as $key => $value) {
              $index++;
              if ($index == 1){
                  $id = $value;
                  echo '<td><input type="checkbox" value="'.$id.'"></td>';
              }
              if ($index > 1 && $index <= 3) {
                echo '<td><a href="#" onclick="userPage('."'".$id."'".');">'. $value .'</a></td>';
              }
          }
          echo '</tr>';
      }
    ?>
</tbody>
  </table>