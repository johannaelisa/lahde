<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['signUpFrom'])) {
    $fields_to_check = ["organizer", "businessid", "phone", "email", "password1", "password2", "accept_decline" ];
    $errors = [];
    foreach ($fields_to_check as $field) {
        $value = isset($_POST[$field]) ? $_POST[$field] : '';
        $cleanedValue = trim($value);
        switch ($field) {  
            case "organizer":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Nimi vaaditaan.";
                } elseif (!preg_match("/^[a-zA-ZäöåÄÖÅ\s-]+$/", $cleanedValue)) {
                    $errors[$field] = "Kirjoita oikea nimi.";
                }
                break;
            case "businessid":
                if (!empty($cleanedValue) && !preg_match("/^[0-9]{7}-[0-9]{1}$/", $cleanedValue)) {
                    $errors[$field] = "Y-tunnuksessa on oltava seitsemän numeroa ja väliviiva ja yksi numero.";
                }
                break;
            case "phone":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Puhelinnumero vaaditaan.";
                } elseif (!preg_match("/^[0-9]{6,15}$/", $cleanedValue)) {
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
            case "accept_decline":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Hyväksy liittymisehdot.";
                }
                break;
            default:
                break;
        }
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: signup.php");
    }
}

if (isset($_POST['signUpFrom'], $_POST['accept_decline'])) {
    session_destroy();
    require_once("connect.php");
    require("mail.php");
    $organizer = $conn->real_escape_string(strip_tags($_POST['organizer']));
    $businessid = $conn->real_escape_string(strip_tags($_POST['businessid']));
    $phone = $conn->real_escape_string(strip_tags($_POST['phone']));
    $email = $conn->real_escape_string(strip_tags($_POST['email']));
    $salt = bin2hex(random_bytes(16));
    $rawPassword = $_POST['password1'];
    $preparedPassword = $salt . $rawPassword;
    $hashedPassword = password_hash($preparedPassword, PASSWORD_BCRYPT);
    $query = "INSERT INTO users (organizer, businessid, phone, email, password, salt)
            VALUES ('$organizer', '$businessid', '$phone', '$email', '$hashedPassword', '$salt')";

    if ($conn->query($query) === TRUE) {
        $signup_token = bin2hex(random_bytes(32));
        $status = "inactive";
        $expiration_time = date("Y-m-d H:i:s", strtotime("+1 days"));
        $query2 = "INSERT INTO signup_tokens (signup_email, signup_token, status, expiration_time)
        VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query2);
        $stmt->bind_param("ssss", $email, $signup_token, $status, $expiration_time);
        if ($stmt->execute()) {
            $confirmationLink = "https://kinnarijo.azurewebsites.net/signup_verification.php?signup_token=$signup_token&email=" . urlencode($email);
            $emailTo = $email;
            $msg = "Kiitos rekisteröitymisestäsi. Vahvista sähköpostiosoitteesi klikkaamalla alla olevaa linkkiä:\n\n";
            $msg.= "<a href='$confirmationLink'>$confirmationLink</a>";
            $subject = "Vahvista sähköpostiosoitteesi";
            posti($emailTo,$msg,$subject);
            if ($mail->send()) {
                header("Location: thankyou.php");
            } else {
                echo 'Sähköpostin lähetys epäonnistui: ' . $mail->ErrorInfo;
            }
        } else {
            echo "Tietojen tallentaminen epäonnistui.";
            }
        }
    $conn->close();
    }

if (isset($_POST['verify_signup'])) {
    require_once("connect.php");
    $signup_token = $_POST['signup_token'];
    $email = $_POST['email'];
    $query = "SELECT * FROM signup_tokens WHERE signup_token='$signup_token' AND signup_email='$email' AND status='inactive' AND expiration_time > NOW()";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        $query2 = "UPDATE signup_tokens SET status='active' WHERE signup_token='$signup_token'";
        if ($conn->query($query2) === TRUE) {
            $query3 = "UPDATE users SET is_active=1, role=1 WHERE email='$email'";
            if ($conn->query($query3) === TRUE) {
                header("Location: login.php");
            } else {
                echo "Tietojen tallentaminen epäonnistui.";
            }
        } else {
            echo "Tietojen tallentaminen epäonnistui.";
        }
    } else {
        echo "Tietojen tallentaminen epäonnistui.";
    }
    $conn->close();
}

if (isset($_POST['login'])) {
    require_once("connect.php");
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row['ID'];
        $organizer = $row['organizer'];
        $role = $row['role'];
        $salt = $row['salt'];
        $hashedPassword = $row['password'];
        $preparedPassword = $salt . $password;
        if (password_verify($preparedPassword, $hashedPassword)) {
            session_start();
            session_regenerate_id(); 
            $_SESSION['user_id'] = $id;
            $_SESSION['organizer'] = $organizer;
            $_SESSION['role'] = $role;
            if (isset($_POST['remember_me'])) {
                $remember_token = bin2hex(random_bytes(32));
                date_default_timezone_set('Europe/Helsinki');
                $expiration_time = date("Y-m-d H:i:s", strtotime("+30 days")); 
                $query2 = "INSERT INTO remember_tokens (user_id, token, expiration_time) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($query2);
                $stmt->bind_param("iss", $id, $remember_token, $expiration_time);
                $stmt->execute();
                $stmt->close();
            }
            header("Location: memberpage.php");
        } else {
            header("Location: login.php");
        }
    } else {
        header("Location: login.php");
    }
    $conn->close();
}
?>