<h2>
<?php
/* templ/user_upload.php */
  include_once "class/autoload.php";
  echo "Willkommen ".Controller::getUserName(); //Username




 ?>
</h2>
<h3> Dateien hochladen </h3>
<form method="post" action="index.php" enctype="multipart/form-data">
  <input type="hidden" name="upload">
  <input type="file" name="userfile" placeholder="Datei auswählen" required><br>
  <input type ="submit" value="upload">
</form>
