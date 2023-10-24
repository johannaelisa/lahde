<?php
include "header.php";
$active = basename($_SERVER['PHP_SELF'], ".php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_GET['signup_token']) && isset($_GET['email'])) {
  $signup_token = $_GET['signup_token'];
  $email = $_GET['email'];

  // Tee tarvittavat toimet käyttäen $signup_token- ja $email-muuttujia
} else {
  // Ohjaus virhesivulle
}
?>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="kuvat/lahde.webp" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      LÄHDE
    </a>
  </div>
</nav>

<div class="container">
    <div class="login_container">
        <div class="form_content">
        <h3>Vahvista sähköpostiosoite</h3>
        <form action="handler.php" method="post" class="sm-6" novalidate>
          <input type="hidden" name="signup_token" value="<?php echo $signup_token; ?>">
          <input type="hidden" name="email" value="<?php echo $email; ?>">
          <div class="col-12">
            <label for="login_email" class="form-label">Sähköposti</label>
            <input type="email" id="login_email" name="login_email" class="form-control" autofocus>
            <div id="login_email-error"></div>
          </div>
        <button type="submit" name="verify_signup" class="btn btn-dark">Vahvista</button>
        </form>
        </div>
    </div>
</div>
</body>
</html>
