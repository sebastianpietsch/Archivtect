<?php

// Automatisches laden von benötigten Klassen

class Controller {

  private $request;
  private $tpl ="start"; //starttemplate
  private const UPATH ="upload/";  //Uploadpfad
  private $data = ""; //
  // Initialisierung - Erster Aufruf in dem Programm
  // Der Constructor wird aufgerufen vom Controller
  function __construct(){
    session_start();
      $this->request = $_REQUEST;// Eingang
      // Test auf query string name
      switch(key($this->request)){
          case 'mail' ; case 'pass': $this->setLogin();
          break;
          case 'logout': $this->setLogout();
          break;
          case 'register': $this->tpl = "register";
          break;
          case 'savereg': $this->setRegister();
          break;
          case 'upload': $this->setUpload();
          break;
          default: ;
      }



      $view = new View(); // Rückgabe an Screen
      $view->setTemplate($this->tpl); //Login
      $view->setLayout($this->data);
      $view->toDisplay();
  }

  // LOGIN
      private function setLogin(){
      $salt = Model::getSalt($this->request['mail']);
      $hash = hash('sha512', $this->request['pass'].$salt);
      $data = Model::getPassOk($this->request['mail'], $hash);

        if($data) { //id muss vorhanden sein also User vorhanden
          $_SESSION['user'] = $data;
          $this->tpl = "user_upload";
        };
      }

      public function getUserName() {
         $data = Model::getUserNameFromId($_SESSION['user']);
         return $data;
      }

      private function setUpload(){
        $datei = $_FILES['userfile']['name'];
        $uploadfile = SELF::UPATH.$datei;
        ################# Größe einschränken #######################



        ##################### mime typen erkennen###################
        $zugelassen = array('image/jpeg','image/png','image/gif','application/pdf','video/mpeg');
        if(!in_array($_FILES['userfile']['type'],$zugelassen)){
          $this->data = "Ihre Datei ist nicht zugelassen";
        }
        ################# Upload starten ##########################
        if($this->data ==""){
          if(move_uploaded_file($_FILES['userfile']
                                ['tmp_name'],$uploadfile)){
            $this->data = "Ihre Datei wurde hochgeladen!";
          } else {
            $this->data = "Upload ist fehlgeschlagen";
            switch ($_FILES['userfile']['error']) {
              case 1: $this->data = "Server läßt diese Größe nicht zu";
                break;
              case 2: $this->data = "Datei zu groß";
                break;
              case 3: $this->data = "Datei unvollständig beim Server angekommen";
                break;
              case 4: $this->data = "Es wurde keine Datei hochgeladen";
                break;
              case 6: $this->data = "Kein temporäres Verzeichnis";
                break;
              case 7: $this->data = "Schreibschutz im Zielverzeichnis";
                break;
              case 7: $this->data = "Eine PHP Erweiterung verhindert das speichern";
                break;
              default: ;
            }
          }

        }//upload zugelassen
        $this->tpl = "user_upload";
      } // Methode Setupload

      // LOGOUT
      private function setLogout(){
          session_destroy(); // Session auflösen
          header("Location: index.php");
      }

      private function setRegister(){
          $data = Model::setRegister($this->request['rname'],
                              $this->request['rmail'],
                              $this->request['rpass'],
                              $this->request['rsex']);

        if($data != 0) {
          $this->tpl = "register_ok"; // Fehlerseite
        } else {
          $this->tpl = "register_no"; // Fehlerseite
        }
      }





  }
 ?>
