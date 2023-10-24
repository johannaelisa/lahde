<?php
include "header.php";
include_once "handler.php";
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

<div class="container">
    <div class="hero" href="index.php">
        <h3>OLET OSA LÄHDETTÄ</h3>
        <div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
       <div class="">
        <p>Viimeistele rekisteröinti vahvistamalla sähköpostiosoitteesi </p>
       </div>
        </div>
        <div class="hero_overlay"></div>
        <img src="kuvat/learn.webp" alt="Lähde">
    </div>

        <p>Viimeistele rekisteröinti vahvistamalla sähköpostiosoitteesi </p>
    </div>
</body>
</html>