<?php

// Automatisches laden von benötigten Klassen

class Controller {

  private $request;
  private $tpl ="start";
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
          default: ;
      }


      $data = "";
      $view = new View(); // Rückgabe an Screen
      $view->setTemplate($this->tpl); //Login
      $view->setLayout($data);
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
