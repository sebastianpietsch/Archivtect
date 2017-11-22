<?php
// Datenbankergebnisse als Array liefern

class Service{

  private static $myPDO;

  private static function connectDB() {
      $host = "localhost";
      $db_name = "db_archivtect";
      $user = "root";
      $pass = "";

      SELF::$myPDO = new PDO ("mysql:host=".$host,$user,$pass);

      try{
        SELF::$myPDO->query("USE ".$db_name);
        SELF::$myPDO->exec('SET NAMES utf8; SET CHARACTER SET UTF8');
      } catch (PDOException $e) {
        exit ("Error: ".$e->getMessage());
      }

  }

  // Methode zur Anfrage an DB
  public static function getOne ($sql) { //gib 1 Wert zurück
    SELF::connectDB(); // DB verbinden
    $res = SELF::$myPDO->query($sql); // DB Anfrage starten
    return $res->fetchColumn(); //1 String zurück
  }

  public static function setExec ($sql) {
    SELF::connectDB(); // DB verbinden
    SELF::$myPDO->exec($sql); // ausführen
    return SELF::$myPDO->lastInsertID(); //aktuelle ID
  }

    function getFetchAll(){
    return "DB-Ergebnis = Erfolgreich";
    }

}

 ?>
