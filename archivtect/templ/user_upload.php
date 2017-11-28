<h2>
<?php
/* templ/user_upload.php */
  include_once "class/autoload.php";
  echo "Willkommen ".Controller::getUserName(); //Username




 ?>
</h2>
<h3> Dateien hochladen </h3>
<?php
echo $data;
 ?>
<form method="post" action="index.php" enctype="multipart/form-data">
  <input type="hidden" name="upload">
  <textarea placeholder="Suchworte angeben mit Komma" name="keys"></textarea><br>
  <input type="checkbox" name="online" checked> Für andere freigeben <br><br>
  <input type="file" name="userfile" required><br>
  <input type ="submit" value="upload">
</form>
