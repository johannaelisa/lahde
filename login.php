<?php
include "header.php";
$active = basename($_SERVER['PHP_SELF'], ".php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="kuvat/lahde.webp" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      LÄHDE
    </a>
  </div>
</nav>

<div class="container-login">
<div class="container-background">
    <div class="form_content">
    <h3>KIRJAUDU</h3>
    <form action="handler.php" method="post" class="md-12" novalidate>
    <div class="col-12">
        <label for="login_email" class="form-label">Sähköposti</label>
        <input type="email" id="login_email" name="login_email" class="form-control" autofocus>
        <div id="login_email-error"></div>
    </div>
    <div class="col-12">
        <label for="login_password" class="form-label">Salasana</label>
        <input type="password"  id="login_password" name="login_password" class="form-control">
        <div id="login_password-error"></div>
    </div>

    <div class="col-g-3">
        <div class="form-check">
        <input class="form-check-input" name="remember_me" id="remember_me" type="checkbox" value="">
        <label class="form-check-label" for="flexCheckDefault">
            Muista minut
        </label>
    </div>
    <br>
    <button type="submit" name="login" class="btn btn-dark">Kirjaudu</button>
    <br>
    
    </div>
    <br>

    <p><a href="forgotpassword.php" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Unohtuiko salasana?</a></p>
    <p><a href="signup.php" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Uusi ilmoittaja</a></p>
    </form>
</div>
</div>
</div>
</body>
</html>
