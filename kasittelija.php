<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields_to_check = ["firstname", "lastname", "phone", "email", "password1", "password2", "language_id", "accept_decline" ];
    $errors = [];

    foreach ($fields_to_check as $field) {
        $value = isset($_POST[$field]) ? $_POST[$field] : '';
        if ($field === "language_id" || $field === "accept_decline") {
            continue;
        } else {
            $cleanedValue = strip_tags(trim($value));
        }
        switch ($field) {
            case "firstname":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Etunimi vaaditaan.";
                } elseif (!preg_match("/^[a-zA-ZäöåÄÖÅ\s-]+$/", $cleanedValue)) {
                    $errors[$field] = "Kirjoita oikea nimi.";
                }
                break;
            case "lastname":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Sukunimi vaaditaan.";
                } elseif (!preg_match("/^[a-zA-ZäöåÄÖÅ\s-]+$/", $cleanedValue)) {
                    $errors[$field] = "Kirjoita oikea nimi.";
                }
                break;
            case "phone":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Puhelinnumero vaaditaan.";
                } elseif (!preg_match("/^[0-9]{7,15}$/", $cleanedValue)) {
                    $errors[$field] = "Puhelinnumerossa on oltava vähintään kuusi merkkiä.";
                }
                break;
            case "email":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Sähköposti vaaditaan.";
                } elseif (!filter_var($cleanedValue, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = "Sähköpostiosoite ei ole kelvollinen.";
                }
                break;
            case "password1":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Anna salasana.";
                } elseif (strlen($cleanedValue) < 10) {
                    $errors[$field] = "Salasana on liian lyhyt.";
                }
                break;
            case "password2":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Anna salasana uudestaan.";
                } elseif (strlen($cleanedValue) < 10) {
                    $errors[$field] = "Salasana on liian lyhyt.";
                }
                break;
            default:
                break;
        }
    }
}

require_once("../../connection.php");

if (isset($_POST['accept_decline']) && isset($_POST['submit'])) {
    try {
    $accept_value = $_POST['accept_decline'];
    } catch (Exception $e) {
        echo 'Virhe: ' . $e->getMessage();
    }
    if ($accept_value === 'accept') {
        $firstname = $yhteys->real_escape_string(strip_tags($_POST['firstname']));
        $lastname = $yhteys->real_escape_string(strip_tags($_POST['lastname']));
        $phone = $yhteys->real_escape_string(strip_tags($_POST['phone']));
        $email = $yhteys->real_escape_string(strip_tags($_POST['email']));
        
        $salt = bin2hex(random_bytes(16));
        $rawPassword = $_POST['password1'];
        $preparedPassword = $salt . $rawPassword;
        $hashedPassword = password_hash($preparedPassword, PASSWORD_BCRYPT);

        $language_id = isset($_POST['language_id']) ? $yhteys->real_escape_string(strip_tags($_POST['language_id'])) : 1;
        $mailinglist = isset($_POST['mailinglist']) ? true : false;

        $button = $yhteys->real_escape_string(strip_tags($_POST['submit']));

        $query = "INSERT INTO users (firstname, lastname, phone, email, password, salt, language_id, mailinglist)
                VALUES ('$firstname', '$lastname', '$phone', '$email', '$hashedPassword', '$salt', '$language_id', '$mailinglist')";

        if ($yhteys->query($query)) {
            echo "Tiedot lisätty onnistuneesti.";
            echo '<script src="lintu.js"></script>';
            echo '<script>
            setTimeout(function() {
                window.location.href = "kiitos-sivu.php";
            }, ANIMAATION_KESTO_MILLISEKUNTEINA);
            </script>';
            exit; 
        } else {
            echo "Virhe tietoja lisätessä: " . $yhteys->error;
        }
        
    } 
    /*elseif ($accept_value !== 'accept') {
        echo "Hyväksy ehdot.";
    }*/
}

if (isset($_POST['login_email']) && isset($_POST['submit'])) {
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];
    try {
    $email = $yhteys->real_escape_string(strip_tags($email));
    $query = "SELECT ID, email, password, salt, language_id FROM users WHERE email = '$email'";
    $tulokset = $yhteys->query($query);
    } catch (Exception $e) {
        echo 'Virhe: ' . $e->getMessage();
    }

    if ($tulokset->num_rows == 1) {
        $rivi = $tulokset->fetch_assoc();
        
        $user_id = $rivi['ID'];
        $language_id = $rivi['language_id'];
        $storedSalt = $rivi['salt'];
        $storedHashedPassword = $rivi['password'];
    
        $rawLoginPassword = $_POST['login_password'];
        $preparedLoginPassword = $storedSalt . $rawLoginPassword;
    
        if (password_verify($preparedLoginPassword, $storedHashedPassword)) {
            $token = bin2hex(random_bytes(32));
            date_default_timezone_set('Europe/Helsinki');
            $expiration_time = date("Y-m-d H:i:s", strtotime("+30 days")); //
            $query = "INSERT INTO remember_tokens (user_id, token, expiration_time) VALUES (?, ?, ?)";
            setcookie('remember_me', $token, strtotime("+30 days"), "/", "", false, true);

            $stmt = $yhteys->prepare($query);
            $stmt->bind_param("iss", $user_id, $token, $expiration_time);
            $stmt->execute();
            $stmt->close();

            $_SESSION['ID'] = true;
            $_SESSION['language_id'] = $language_id;
            session_start();

            header("Location: member_page.php");
        } else {
            echo "Kirjautuminen epäonnistui.";
        }
    } else {
        echo "Tietoja ei löydy.";
 
    } 
}
$yhteys->close();
?>