<?php
include "header.php";
$active = basename($_SERVER['PHP_SELF'], ".php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$user_id = $_SESSION['user_id'];
echo $user_id;
$organizer = $_SESSION['organizer'];
echo $organizer;
$role = $_SESSION['role'];
?>

<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="kuvat/lahde.webp" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      LÄHDE
    </a>
    <div class="right-menu ml-auto">
      <a class="nav-link" href="#">Kirjaudu ulos</a>
    </div>
  </div>
</nav>

<div class="container mt-0">
  <h2>Omat tapahtumat</h2>
  <!-- MemberPage sisältölohko-->
  <div class="row row-cols-2" id="row">
    <!-- Vasen lohko-->
    <div class="col-md-8" id="addEvent">
    <h5>LISÄÄ UUSI TAPAHTUMA</h5>
    <!-- Lomake-->
    <form action="handler_member.php" method="post" class="sm-6" novalidate>
      <!-- Tapahtuman nimi-->
      <div class="col-md-12">
          <input type="text" class="form-control mb-2" name="name" id="name" placeholder="Tapahtuman nimi" autofocus required> 
          <div class="alert alert-danger d-none" role="alert" id="name-error"></div>
      </div>
      <!-- Tapahtuman järjestäjä-->
      <div class="col-md-12" ms-0>
          <input type="text" readonly class="form-control bg-transparent" name="organizer" id="organizer" value="<?php echo $organizer; ?>" placeholder="Järjestäjä: <?php echo $organizer; ?>" style="border: none; background-color: transparent;"> 
          <br>
      </div>

      <!-- Päivämäärä ja aika-->
      <div class="row">
      <h6>Tapahtuman perustiedot</h6>
      <div class="col-4">
        <select class="form-select mb-3" aria-label="Default select example" name="dateSelect" id="dateSelect"></select>
      </div>
      <div class="col-3">
        <select class="form-select mb-3" aria-label="Valitse tunti" name="hourSelect" id="hourSelect" data-style=""></select>
      </div>
      <div class="col-3">
        <select class="form-select mb-3" aria-label="Valitse minuutti" name="minuteSelect" id="minuteSelect" data-style=""></select>
      </div>
    </div>
    
    <!-- Tapahtumatyyppo-->
    <div class="col-8">
      <select class="form-select mb-3" name="primary_category" id="primary_category" >
        <option selected>Tapahtumatyyppi</option>
        <option value="eatdrink">Herkkuhetki</option>
        <option value="nightlife">Bileet ja yöelämä</option>
        <option value="wellbeing">Liikunta ja hyvinvointi</option>
        <option value="spirituality">Hengelliset tapahtumat</option>
        <option value="seeexperience">Näe ja koe: kultuuri, pelit, elämykset, ym.</option>
        <option value="learn">Opi ja keskustele: luennot, lukupiiri, ym.</option>
        <option value="create">Omin käsin: kädentaidot, taide, rakentaminen, ym.</option>
        <option value="beactive">Vaikuta: mielenilmaukset, aatteellinen toiminta, ym.</option>
      </select>
      <div class="alert alert-danger d-none" role="alert" id="primary_category-error"></div>
    </div>
    <!--Kuvaus-->
    <div class="col-12">
      <textarea class="form-control mb-3" name ="description" id="description" rows="3" placeholder="Tapahtuman kuvaus"></textarea>
    </div>
    <!-- Esteettömyystieto-->
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="accessibility" id="accessibility">
      <label class="form-check-label mb-4" for="accessibility">
        Esteetön tila
      </label>
    </div>
    <!-- Avainsanat-->
    <label for="checkbox" class="form-label">Avainsanat</label>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="eatdrink" id="eatdrink">
      <label class="form-check-label" for="eatdrink">
        Syö ja juo
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="nightlife" id="nightlife">
      <label class="form-check-label" for="nightlife">
        Bileet ja yöelämä
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="wellbeing" id="wellbeing">
      <label class="form-check-label" for="wellbeing">
        Liikunta ja hyvinvointi
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="spirituality" id="spirituality">
      <label class="form-check-label" for="spirituality">
        Hengelliset tapahtumat
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="seeexperience" id="seeexperience">
      <label class="form-check-label" for="seeexperience">
        Näe ja koe: kultuuri, pelit, elämykset, ym.
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="learn" id="learn">
      <label class="form-check-label" for="learn">
        Opi ja keskustele: luennot, lukupiiri, ym.
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="create" id="create">
      <label class="form-check-label" for="create">
        Omin käsin: kädentaidot, taide, rakentaminen, ym.
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="act" id="act">
      <label class="form-check-label" for="act">
        Vaikuta: mielenilmaukset, aatteellinen toiminta, ym.
      </label>
    </div>
    <!-- Nimi-->
    <div class="col-g-3" style="padding-bottom: 15px;"> 
    <label for="accept_decline" class="form-label">Vastuut ja velvollisuudet</label>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="accept_decline" value="accept" id="accept">
          <label class="form-check-label" for="accept">
              Vastaan tapahtuman turvallisuudesta ja viranomaisilmoituksista
          </label>
      </div>
      <div class="alert alert-danger" role="alert" id="accept_decline-error"></div>
    </div>
    
  
  <button type="submit" name="submit_event" class="btn btn-dark">Lähetä</button>

  </form>
  </div>
  <div class="col-md-4" id="myEvents">
      <div id="json-data" style="display: none;"><?php include "db_member.php";?></div>
        <div id="myEventList" ><!-- Tähän tulostuu tapahtumat --></div>
    </div>
</div>
</div>


  
  
<!-- Buttonien toiminta-->
<script>function toggleCard(card) {card.classList.toggle('selected');} </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- Buttonien toiminta-->

<!-- Päivämäärien haku-->
<script>
  var dateSelect = document.getElementById("dateSelect");

  var currentDate = new Date();

  for (var i = 0; i < 365; i++) {
    var option = document.createElement("option");
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1;
    var year = currentDate.getFullYear();

    var formattedDate = day + "." + month + "." + year;

    option.value = formattedDate;
    option.text = formattedDate;

    dateSelect.appendChild(option);

    currentDate.setDate(currentDate.getDate() + 1);
  }
</script>

<!-- Tuntien ja minuuttien haku-->
<script>
  var hourSelect = document.getElementById("hourSelect");
  var minuteSelect = document.getElementById("minuteSelect");

  for (var hour = 0; hour < 24; hour++) {
    var option = document.createElement("option");
    option.value = hour;
    option.text = hour < 10 ? "0" + hour : hour;

    hourSelect.appendChild(option);
  }

  for (var minute = 0; minute < 60; minute++) {
    var option = document.createElement("option");
    option.value = minute;
    option.text = minute < 10 ? "0" + minute : minute;

    minuteSelect.appendChild(option);
  }
</script>

<script>
    function setErrorMessage(fieldName, errorMessage) {
        var errorDiv = document.getElementById(fieldName + "-error");
        if (errorDiv && errorMessage) {
            errorDiv.textContent = errorMessage;
            errorDiv.classList.remove('d-none'); 
        } else if (errorDiv) {
            errorDiv.textContent = "";
            errorDiv.classList.add('d-none');
        }
    }

    setErrorMessage("name", "<?php echo isset($errors['name']) ? $errors['name'] : ''; ?>");
    setErrorMessage("primary_category", "<?php echo isset($errors['primary_category']) ? $errors['primary_category'] : ''; ?>");
    setErrorMessage("accept_decline", "<?php echo isset($errors['accept_decline']) ? $errors['accept_decline'] : ''; ?>");

</script>

<script>
$(document).ready(function() {
  updateEvents();
  function updateEvents() {
    $.ajax({
      type: "GET",
      url: "db_member.php",
      dataType: "json",
      success: function(data) {
        var events = data.jsonEventsAll;
        
        var parsedEvents = JSON.parse(events);
        displayEvents(parsedEvents);
      },
      error: function(xhr, status, error) {
        console.error("Virhe hakiessa dataa PHP-skriptiltä.");
        console.error("Virhe AJAX-pyynnössä:", xhr.status, xhr.statusText);
        console.error("Tarkempi virheviesti:", error);
      }
    });
  }
  
  function displayEvents(events) {
      var eventList = $('#myEventList');
      eventList.empty();

      for (var i = 0; i < events.length; i++) {
        var event = events[i];
        var eventName = event.name;
        var eventTime = event.time_start;
        var eventDate = event.day;
        var formattedEventDate = eventDate.slice(8, 10) + '.' + eventDate.slice(5, 7) + '.' + eventDate.slice(0, 4);
        var keywordTranslations = {
          nightlife: "bileet ja yöelämä",
          wellbeing: "liikunta ja hyvinvointi",
          seeexperience: "näe ja koe",
          eatdrink: "herkkuhetket",
          create: "omin käsin",
          learn: "opi ja keskustele",
          spirituality: "hengelliset tapahtumat",
          beactive: "vaikuta",
          accessibility: "saavutettavuus"
        };
        var eventType = event.primary_category;
        var translatedType = keywordTranslations[eventType] || eventType;
        translatedType = translatedType.charAt(0).toUpperCase() + translatedType.slice(1);

        var eventKeywords = event.category;
        var formattedKeywords = event.category.split(',');
        var translatedKeywords = formattedKeywords.map(function(keyword) {
          return keywordTranslations[keyword] || keyword;
        });
        eventKeywords = translatedKeywords.join(', ');
        
        var eventDescription = event.description;

        var imagePath = 'kuvat/' + eventType + '.webp';
        var formattedEventTime = eventTime.slice(0, 5);
        
        
        var eventCard = $('<div class="card mb-12" id="eventCard">');
        var cardBody = $('<div class="row g-0">');
        cardBody.append('<div class="col-md-12"><img src="' + imagePath + '" class="img" alt="..."></div>');
        var cardBodyRight = $('<div class="col-md-12">');
        cardBodyRight.append('<div class="card-body">');
        cardBodyRight.find('.card-body').append($('<h5 class="card-title">' + eventName + '</h5>'));
        cardBodyRight.find('.card-body').append($('<p class="card-text">' + formattedEventDate + ' klo ' + formattedEventTime + '</p>'));
        cardBodyRight.find('.card-body').append($('<p class="card-text">' + eventDescription + '</p>'));
        cardBodyRight.find('.card-body').append($('<p class="card-text"><small class="text-muted">' + translatedType + '</small></p>'));
        cardBodyRight.find('.card-body').append($('<p class="card-text"><small class="text-muted">Avainsanat: ' + eventKeywords + '</small></p>'));
        cardBodyRight.find('.card-body').append($('<p class="card-text"><small class="text-muted"></p>'));
        cardBodyRight.find('.card-body').append($('<button type="button" class="btn btn-dark">Päivitä</button>'));
        cardBodyRight.find('.card-body').append('</div>');
        cardBody.append(cardBodyRight);

        eventCard.append(cardBody);

        eventList.append(eventCard);
      }
    }
});

</script>


</body>
</html>
