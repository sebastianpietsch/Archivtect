<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>OOP_1.php OOP Einführung</title>
  </head>

  <body>
    <?php
      // zu speichern in: C:XAMPP/htdocs/archivtect/oop/oop_1.php
      // Aufruf: localhost:8080/archivtect/oop/oop_1.php

      //OOP Grundlage eines Objekts ist der Bauplan
      // Klasse (Bauplan eines Objektes)
      // 1. Buchstabe = GroßBuchstabe

      class MyClass {


        // Attribut (öffentlich zugänglich)
        public $mytext = "inner"; //Initialisierung/Deklarierung
        static $mytext2 = "static"; //hat in allen Objekten den gleichen Wert

        function __construct($ini) { //wenn Objekt gebildet wird, wird der Konstruktor ausfgeführt
          $this->mytext = $ini; // Initialisierungswert
        }


        //Methoden innerhalb einer Klasse (Objekt)
        // getter (geben Werte zurück)
        function getToDisplay () {
          return $this->mytext;
          // return __METHOD__  magische Konstante, gibt Funktionsnamen zurück
        }
        // setter setzen Werte
        function setText($in) {
          $this->mytext = $in; //Attribut der KLasse mit übergebenen Parameter der Methode belegt
        }


      }

      //instanz des Objektes MyClass(Kopie)

      $info1 = new MyClass("inner"); //neues Objekt der Klasse MyClass erstellen


      echo $info1->mytext; //Attributes einer Instanz eines Objekts auslesen
      echo "<br>";
      echo "<br>";

      echo MyClass::$mytext2; // Attribut der Klasse auslesen
      echo "<br>";
      echo "<br>";

      echo $info1->getToDisplay(); //Methode aus Instanz aufrufen
      echo "<br>";
      echo "<br>";

      $info1->setText("neu"); // setzen eines Attributs über eine Methoden
      echo $info1->getToDisplay(); //Methodenaufruf
      echo "<br>";
      echo "<br>";

      $info2 = new MyClass("Nr 2");
      echo $info2->getToDisplay();

      ?>
  </body>
</html>
