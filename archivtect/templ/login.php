
<!--
get:
      - Querystring in Adresszeile vom Browser
      - max. Länge 1024(2048)
      - bookmarkbar
      - Login, Anfrageformulare, Shop

post:
      - Querystring nicht zu sehen
      - max. Grzbdeubstellung 8MB erweiterbar je nach System upload
      - www.amazon.de? (domain + seitenname)
      - upload Filme, Grafiken, CMS

-->

<?php

if (!isset($_SESSION["user"])){ // User ist nicht angemeldet
    echo '

<form method = "get">
LOGIN:<br><br>
<input type="email" name="mail" placeholder="email" required><br>
<input type="password" name="pass" placeholder="Passwort" required><br><br>
<input type="submit" value="anmelden"><br><br>
</form>
<a href="?register=true">Registrieren</a><br>
';

}else{
  echo '<a href="?logout=true">logout</a><br>';
}

?>
