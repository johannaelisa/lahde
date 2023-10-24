<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connect.php";

$eventsToday = array();
$eventsTomorrow = array();
$eventsWeekend = array();
$eventsAll = array();

date_default_timezone_set('Europe/Helsinki');
$today = date("Y-m-d");
$time_now = date("H:i:s");

$sql = "SELECT * FROM eventdb ORDER BY day ASC, time_start ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    $ID = $row['ID'];
    $name = $row['name'];
    $organizer = $row['organizer'];
    $day = $row['day'];
    $time_start = $row['time_start'];
    $primary_category = $row['primary_category'];
    $category = $row['category'];
    $description = $row['description'];
    $dayOfWeek = date('N', strtotime($row['day']));

    if ($row['day'] >= $today && ($row['day'] > $today || $row['time_start'] >= $time_now)) {
        $eventsAll[] = $row;

        if ($row['day'] == $today) {
            $eventsToday[] = $row;
        } else if ($row['day'] == date('Y-m-d', strtotime('tomorrow'))) {
            $eventsTomorrow[] = $row;
        } else if ($dayOfWeek == 5) {
            $eventsWeekend[] = $row;
        } else if ($dayOfWeek == 6) {
        $eventsWeekend[] = $row;
        } else if ($dayOfWeek == 7) {
        $eventsWeekend[] = $row;
        }

    } else if ($row['day'] < $today){
        $archive = "INSERT INTO arkisto (name, day, organizer, time_start, primary_category, category, description) VALUES ('$name', '$day', '$organizer', '$time_start', '$primary_category', '$category', '$description')";
        try {
            $conn->query($archive);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        $delete = "DELETE FROM eventdb WHERE id = '$ID'";
        try {
            $conn->query($delete);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

     }

}
} 


$jsonEventsToday = json_encode($eventsToday);
$jsonEventsTomorrow = json_encode($eventsTomorrow);
$jsonEventsWeekend = json_encode($eventsWeekend);
$jsonEventsAll = json_encode($eventsAll);

echo json_encode(array(
"jsonEventsToday" => $jsonEventsToday,
"jsonEventsTomorrow" => $jsonEventsTomorrow,
"jsonEventsWeekend" => $jsonEventsWeekend,
"jsonEventsAll" => $jsonEventsAll
));


$conn->close();
?>
