<?php

// Automatisches laden von benötigten Klassen

class Model{

    public static function getPassOk ($mail,$pass) {
      $sql =  "SELECT T1.id
              FROM tb_user T1, tb_password T2
              WHERE T1.email='{$mail}' and T2.hash ='{$pass}'
              AND T1.id_pass = T2.id
              ";

      return Service::getOne ($sql);
    }

    public static function getSalt ($mail) {
      $sql = "SELECT T2.salt
              FROM tb_user T1, tb_salt T2
              WHERE T1.email = '{$mail}' AND T1.id_pass = T2.id_pass
              ";

      return Service::getOne($sql);
    }

    public static function setRegister($name, $mail, $pass, $sex) {
      $salt = ''; //leer

      for($i=1; $i<=10; $i++){ //schleife
      $salt .= rand(0,9); //
      }

      $hash = hash("sha512", $pass.$salt); // Hash erzeugen aus Passwort und Salt
      $sql = "INSERT INTO tb_password
              (hash) VALUES
              ('{$hash}')";

      $id = Service::setExec($sql);

      $sql = "INSERT INTO tb_salt
              (salt, id_pass) VALUES ('$salt', {$id})";

      Service::setExec($sql);

      $sql = "INSERT INTO tb_user
              (name, email, sex, id_pass)
              VALUES ('{$name}','{$mail}','{$sex}',{$id})";

      return Service::setExec($sql); //user ID

    }


    public static function getUserNameFromId($id){
      $sql = "SELECT name FROM tb_user WHERE
              id = {$id}";
      return Service::getOne($sql);
    }


    ########### schreiben in Archivdatei ##############
    public static function setArchiv($a, $b, $c, $d){
      $sql = "INSERT INTO tb_archiv (id_user,name,path,online)
              VALUES ({$a},'{$b}','{$c}',{$d})";

              return Service::setExec($sql);
    }

    public static function setKeys($key) {
      $sql = "INSERT INTO tb_key(search)
              VALUES ('{$key}')";

            return Service::setExec($sql);
    }


}
?>
