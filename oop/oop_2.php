<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>OOP_2.php OOP Übung Buntes Rechteck</title>
  </head>

  <body>
    <?php

    Class Rechteck {

      private $hoehe;
      private $breite;
      private $farbe;
    


      function __construct($h, $b, $f) {
        $this->hoehe = $h;
        $this->breite = $b;
        $this->farbe = $f;
      }

      function toDisplay () {
        return '<div style="width:'.$this->breite.
                  'px;height:'.$this->hoehe.
                      'px;background-color:'.$this->farbe.';"></div>';
      }

      function setHoehe($ho) {
        $this->hoehe = $ho;
      }

      function setBreite($br) {
        $this->breite = $br;
      }

      function setFarbe($fa) {
        $this->farbe = $fa;
      }
    }

    $rec1 = new Rechteck(100, 200, "lightblue");
    echo $rec1->toDisplay();
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";


    $rec2 = new Rechteck(200, 400, "green");
    $rec2->setFarbe("red");
    echo $rec2->toDisplay();

    ?>

  </body>
  </html>
