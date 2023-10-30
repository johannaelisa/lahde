<?php
include "header.php";
include_once "handler.php";
$active = basename($_SERVER['PHP_SELF'], ".php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
} else {
    $errors = [];
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
<div class="signup_container">
    <div class="form_content">
    <h3>LUO TUNNUS</h3>
    <form action="handler.php" method="POST" class="sm-6" class="sm-6 needs-validation" novalidate>
        <!-- Yritys-->
        <div class="col-md-12" style="padding-bottom: 15px;">
            <label for="organizer" class="form-label">Tapahtumanjärjestäjä</label>
            <input type="text" class="form-control" name="organizer" id="organizer" placeholder="Yritys tai yhteisö" autofocus required> 
            <div class="alert alert-danger d-none" role="alert" id="organizer-error"></div>
        </div>
            <!-- Y-tunnus-->
        <div class="col-md-12" style="padding-bottom: 15px;">
            <label for="businessid" class="form-label">Y-tunnus (jos yritys tai yhteisö)</label>
            <input type="text" class="form-control" name="businessid" id="businessid" placeholder="1234567-8" autofocus> 
            <div class="alert alert-danger d-none" role="alert" id="businessid-error"></div>
        </div>
    
        <!-- Puhelinnumero-->
        <div class="col-12" style="padding-bottom: 15px;">
            <label for="phone" class="form-label">Puhelinnumero</label>
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="+358 XX XXX XXXX" required>
            <div class="alert alert-danger" role="alert" id="phone-error"></div>
        </div>

        <!-- Email ja salasana -->
        <div class="col-12" style="padding-bottom: 15px;">
            <label for="email" class="form-label">Sähköposti</label>
            <input type="email" id="email" name="email" class="form-control" required>
            <div class="alert alert-danger" role="alert" id="email-error"></div>
        </div>
        <div class="col-12" style="padding-bottom: 15px;">
            <label for="password1" class="form-label">Salasana</label>
            <input type="password"  id="password1" name="password1" class="form-control" required>
            <div class="alert alert-danger" role="alert" id="password1-error"></div>
        </div>
        <div class="col-12" style="padding-bottom: 10px;">
            <label for="password2" class="form-label">Toista salasana</label>
            <input type="password"  id="password2" name="password2" class="form-control" required>
            <div class="alert alert-danger" role="alert" id="password2-error"></div>
        </div>
        <div class="col-g-3" style="padding-bottom: 15px;"> 
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="accept_decline" value="accept" id="accept">
                <label class="form-check-label" for="accept">
                    Olen lukenut ja hyväksyn liittymisehdot
                </label>
            </div>
            <div class="alert alert-danger" role="alert" id="accept_decline-error"></div>
        </div>

        <br>
        <button type="submit" name="signUpFrom" class="btn btn-dark">Lähetä</button>
    </form>
    </div>
</div>    
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    function setErrorMessage(fieldName, errorMessage) {
        var errorDiv = document.getElementById(fieldName + "-error");
        if (errorDiv) {
            if (errorMessage) {
                errorDiv.textContent = errorMessage;
                errorDiv.classList.remove('d-none'); 
            } else {
                errorDiv.textContent = "";
                errorDiv.classList.add('d-none');
            }
        }
    }
    setErrorMessage("organizer", "<?php echo !empty($errors['organizer']) ? $errors['organizer'] : ''; ?>");
    setErrorMessage("businessid", "<?php echo !empty($errors['businessid']) ? $errors['businessid'] : ''; ?>");
    setErrorMessage("phone", "<?php echo !empty($errors['phone']) ? $errors['phone'] : ''; ?>");
    setErrorMessage("email", "<?php echo !empty($errors['email']) ? $errors['email'] : ''; ?>");
    setErrorMessage("password1", "<?php echo !empty($errors['password1']) ? $errors['password1'] : ''; ?>");
    setErrorMessage("password2", "<?php echo !empty($errors['password2']) ? $errors['password2'] : ''; ?>");
    setErrorMessage("accept_decline", "<?php echo !empty($errors['accept_decline']) ? $errors['accept_decline'] : ''; ?>");
});
</script>
    
</body>
</html>
