<?php
/*
    Define username and password
    for HTTP authentication.
 */

  define('USER_LOGIN','user');

  define('USER_PASSWORD','pass');


  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])

      || ($_SERVER['PHP_AUTH_USER'] != USER_LOGIN)

      || ($_SERVER['PHP_AUTH_PW'] != USER_PASSWORD)) {

    header('HTTP/1.1 401 Unauthorized');

    header('WWW-Authenticate: Basic realm="Our Blog"');

    exit("Access Denied: Username and password required.");

  }

   

?>