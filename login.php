<?php
  
  require_once("includes/config.php");
  require_once("includes/dbConn.php");

?>
<!DOCTYPE html>
<html lang="da">
  <head>
    <meta charset="UTF-8">
    <title>LOGIN - Interactive Diving Map</title>

    <link rel="icon" type="image/png" href="Resources/ui/favico.png">

    <style>
      * {box-sizing:border-box;}
      html, body {
        margin:0;padding:0;
        font-size:18px;
        font-family:"Helvetica", sans-serif;
        overflow-x:hidden;
        background:#2061b3;
      }

      .wrapper {
        min-height:100vh;
        display:flex;
        align-items:center;
        justify-content:center;
      }

      .login {
        background:#fff;
        padding:20px;
      }

      input, label {display:block;}
      label {padding-bottom:2px;}
      input {
        margin-bottom:10px;
        padding:6px;
        border:1px solid #2061b3;
      }
      input[type="submit"]{
        cursor:pointer;
        border:none;
        background:#2061b3;
        color:#fff;
      }
      input[type="submit"]:hover {
        background:#4386db;
      }

      input, input[type="submit"]{
        width:300px;
      }

      .error {
        color:firebrick;
        border:2px solid;
        padding:6px;
        margin:6px 0 12px 0;
      }

    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="login">
        <h1>
          Login
        </h1>
        <form method="post" action="code/doLogin.php">
        <?php

          if(isset($_GET['status'])){
            switch ($_GET['status']){
              case 'err1':
                echo '<p class="error">Du skal udfylde login formen korrekt!</p>';
                break;
              case 'err2':
                echo '<p class="error">Du mangler brugernavn eller password!</p>';
                break;
              case 'err3':
                echo '<p class="error">Forkert brugernavn eller password!</p>';
                break;
              case 'err4':
                echo '<p class="error">Du skal logge ind for at se denne side!</p>';
                break;
            }
          }
        ?>
          <div class="form-row">
            <label for="username">Brugernavn</label>
            <input type="text" id="username" name="username" required>
          </div>
          <div class="form-row">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
          </div>
          <div class="form-row">
            <input type="submit" name="submit" value="Insend">
          </div>
        </form>
      </div>
    </div>
  </body>
</html>