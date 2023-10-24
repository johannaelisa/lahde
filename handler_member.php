<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("connect.php");



if (isset($_POST['submit_event'])) {
    $fields_to_check = ["name", "primary_category", "accept_decline" ];
    $errors = [];

    foreach ($fields_to_check as $field) {
        $value = isset($_POST[$field]) ? $_POST[$field] : '';
        $cleanedValue = trim($value);
        switch ($field) {
            case "name":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Nimi vaaditaan";
                    echo "Nimi vaaditaan";
                } elseif (!preg_match("/^[a-zA-ZäöåÄÖÅ\s-]+$/", $cleanedValue)) {
                    $errors[$field] = "Kirjoita oikea nimi";
                }
                break;
            case "primary_category":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Valitse pääkategoria";
                }
                break;
            case "accept_decline":
                if (empty($cleanedValue)) {
                    $errors[$field] = "Hyväksy ehdot";
                }
                break;
            default:
                break;
        }
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: memberpage.php");
    }
}


if (isset($_POST['submit_event'], $_POST['accept_decline'])) {
    $name = $conn->real_escape_string(strip_tags($_POST['name']));
    $organizer = $_POST['organizer'];

    $day_raw = $_POST['dateSelect'];
    $timestamp = strtotime($day_raw);
    $day = date("Y-m-d", $timestamp);
    
    $hour = $_POST['hourSelect'];
    $minute = $_POST['minuteSelect'];
    $time_start = $hour . ":" . $minute. ":00" ;
    echo $time_start;
    
    $description = $conn->real_escape_string(strip_tags($_POST['description']));

    echo $description;
    $primary_category = $_POST['primary_category'];
    echo $primary_category;

    $selectedValues = [];

    if (isset($_POST['accessibility'])) {
        $selectedValues[] = 'accessibility';
    }

    if (isset($_POST['eatdrink'])) {
        $selectedValues[] = 'eatdrink';
    }

    if (isset($_POST['nightlife'])) {
        $selectedValues[] = 'nightlife';
    }

    if (isset($_POST['wellbeing'])) {
        $selectedValues[] = 'wellbeing';
    }

    if (isset($_POST['spirituality'])) {
        $selectedValues[] = 'spirituality';
    }

    if (isset($_POST['seeexperience'])) {
        $selectedValues[] = 'seeexperience';
    }

    if (isset($_POST['learn'])) {
        $selectedValues[] = 'learn';
    }

    if (isset($_POST['create'])) {
        $selectedValues[] = 'create';
    }

    if (isset($_POST['act'])) {
        $selectedValues[] = 'act';
    }

    $category = implode(',', $selectedValues);
    echo $category;

    $query = "INSERT INTO eventdb (name, organizer, day, time_start, primary_category, category, description)
            VALUES ('$name', '$organizer', '$day', '$time_start', '$primary_category', '$category', '$description')";

    if ($conn->query($query) === TRUE) {
        header("Location: memberpage.php");
    } else {
        echo "Tietojen tallentaminen epäonnistui.";
    }
    $conn->close();

}






?>