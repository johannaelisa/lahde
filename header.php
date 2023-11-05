<!DOCTYPE html>
<html lang="fi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://kit.fontawesome.com/87283090d5.js" crossorigin="anonymous"></script>
  <script src="navbar.js"></script>
  <script src="signup_validation.js"></script>
  <!--<link rel="stylesheet" type="text/css" href="reset.css">-->
  <link rel="stylesheet" type="text/css" href="style_main.css">
  <link rel="stylesheet" type="text/css" href="style_button.css">
  <link rel="stylesheet" type="text/css" href="style_checkbox.css">
  <link rel="stylesheet" type="text/css" href="style_memberpage.css">
  <link rel="stylesheet" type="text/css" href="style_login.css">
  <link rel="stylesheet" type="text/css" href="style_signup.css">
  <link rel="stylesheet" type="text/css" href="style_hero.css">
  <title><?= $title ?? 'Lähde'; ?></title>
</head>

<body>
<?php
if (isset($css)) echo "<link rel='stylesheet' href='$css'>";
$title = 'Lähde';
?>