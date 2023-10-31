<?php
include "header.php";
$active = basename($_SERVER['PHP_SELF'], ".php");
error_reporting(E_ALL);
ini_set('display_errors', 0); //tähän ini_set('display_errors', 0), kun Azuressa, jottei näytä virheitä käyttäjälle eli virheet tallennetaan tiedostoon
?>

<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
    <img src="https://lahde.s3.eu-north-1.amazonaws.com/lahde.webp?response-content-disposition=inline&amp;X-Amz-Security-Token=IQoJb3JpZ2luX2VjEL%2F%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCmV1LW5vcnRoLTEiRzBFAiEAzdyxegeQNTqtI4Mzmf1pmJDeXHYFMRUWdnXJpVMxeEACIG5rj%2FCYFrtQmuapggAoZt32PMaXzcSQdetuv7Wu2F6wKu0CCOn%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEQABoMNDgyNDAzN79k3MDQwIgxw4z376CYyrr2gsk0qwQJOhxx%2FN3Vywribtv8zBPqIZD8MNftnblhMWlN%2FPg6ilCS1IiXNUse6OQLYy1SznOPcC1GqQaasAWXTdxURAxcZLGcK%2FmQQ5P4OxjXL81xTV2JgkENxAM48yt3cLS1BHLDYIprlJFBUMUowzDrkjGN6XB0k1kXWbCewyPeqNsolGYaisdH8U8WmyVCBa8UVG8A55JWCiuNTi2T%2FKEKiTFL%2BdOketF%2BrlkfTPYoKD9r6gc%2BTYbuuc4wukrxSj79zhhAmtmsUpY42xelZSnpRFEH84dZdGzU43qjxYy0lj6Lzu5uOEf1RiD1xWFuIaFR7ub2UJ73RtYP2yexsIHpyFFHvgAIDcO8LNvI9bWOXfmnsx4%2B%2B8wC5W2RPEqKpjqTnpPuxOb82IjLhYhGfI%2BAAxf7kDbJw7eYNzilLgqpCpMTWpJ0w09iCqgY6swIvfC%2BMzvRDq5KwmxhJwUZsosLsYPC5Mh0sZIrVZTQb4sl2Y2Ccam8ChZdPso3wywAS9rZ8iN4WN5wWHKZG%2FrWZTmc3%2BJ2XB8%2BbXlKEI6RjRq%2BmnrIwk0udHjeWb%2BzBRwHxsftW3wlv1Me%2FjBiSxXMci4nnj6EYjIN7lukxOlQQspMUCcswcmSDsAQOWlybABepLWadjYyraVRQi0GRxMJeR2DnQhNqRwfQn3QENPCeBxcYjSd%2FYsY%2BI34T3Oqcxlg%2BwdQn5O%2BotHEYSA7MT5UPUpv5jbcxK15uRDFMoXb9Hpe2eH%2FlFoq2R4Tms7LvroP2HnPXKLoJ8MkBhVvO5urqlKQeaMYudCRp4%2Fs8sf9HILLu4%2BeY%2F51Mr%2Feij0X2erJzZmpdQFyKasFpSS3OvKBMbbM8&amp;X-Amz-Algorithm=AWS4-HMAC-SHA256&amp;X-Amz-Date=20231031T110528Z&amp;X-Amz-SignedHeaders=host&amp;X-Amz-Expires=300&amp;X-Amz-Credential=ASIAXAUMBZAYNNNETQGI%2F20231031%2Feu-north-1%2Fs3%2Faws4_request&amp;X-Amz-Signature=59d4b140a68f86a74fdbd5d48c6cc2f9e98bf190f1950d56aadf2f1be39641a8" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      LÄHDE
    </a>
    <div class="right-menu ml-auto">
      <a class="nav-link" href="login.php">Omat tapahtumat</a>
    </div>
  </div>
</nav>

<div class="container mt-0">
  <div class="btn-group d-flex flex-wrap" id="button-group" role="group" aria-label="Button group">
    <button class="btn btn-dark me-2 mb-2 rounded active" type="button" id="button_today" value="button_today">Tänään</button>
    <button class="btn btn-dark me-2 mb-2 rounded" type="button" id="button_tomorrow" value="button_tomorrow" >Huomenna</button>
    <button class="btn btn-dark me-2 mb-2 rounded" type="button" id="button_weekend" value="button_weekend" >Viikonloppuna</button>
    <button class="btn btn-dark me-2 mb-2 rounded" type="button" id="button_all"  value="button_all" >Kaikki päivät</button>
  </div>
  
  <div class="checkbox-container">
    <ul class="ks-cboxtags">
      <li><input type="checkbox" id="all" value="all" checked><label for="all">Ei rajausta</label></li>
      <li><input type="checkbox" id="nightlife" value="nightlife"><label for="nightlife">Bileet</label></li>
      <li><input type="checkbox" id="wellbeing" value="wellbeing"><label for="wellbeing">Liikunta ja hyvinvointi</label></li>
      <li><input type="checkbox" id="seeexperience" value="seeexperience"><label for="seeexperience">Näe ja koe</label></li>
      <li><input type="checkbox" id="eatdrink" value="eatdrink"><label for="eatdrink">Herkkuhetket</label></li>
      <li><input type="checkbox" id="create" value="create"><label for="create">Omin käsin</label></li>
      <li><input type="checkbox" id="learn" value="learn"><label for="learn">Opi ja keskustele</label></li>
      <li><input type="checkbox" id="spirituality" value="spirituality"><label for="spirituality">Hengellisyys</label></li>
      <li><input type="checkbox" id="act" value="beactive"><label for="act">Vaikuta</label></li>      
      <li><input type="checkbox" id="accessibility" value="accessibility"><label for="accessibility">Esteetön tila</label></li> 
    </ul>
  </div>

  <div class="content-container" id="content-container">
    <div id="json-data" style="display: none;"><?php include "db.php";?></div>
      <div id="event-list" >
        <!-- Tähän lisätään tapahtumat -->
      </div>
    </div>
  </div>
  
<!-- Buttonien toiminta-->
<script>function toggleCard(card) {card.classList.toggle('selected');} </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- Buttonien toiminta-->

<script>
$(document).ready(function() {

  $('button.btn.btn-dark[type="button"]').on('click', handleButtonClick);
  
  function handleButtonClick() {
    $('button.btn.btn-dark[type="button"]').removeClass('active');
    $(this).addClass('active');
    $('#event-list').empty();
    updateEvents();
  }

  $('input[type="checkbox"]').on('change', handleCheckboxChange);
  function handleCheckboxChange() {
    if ($(this).attr('id') === 'all') {
      $('input[type="checkbox"]').not(this).prop('checked', false);
      $('#all').prop('checked', true);
    } else {
      if ($(this).prop('checked') === true) {
      $('#all').prop('checked', false);
      }
    }
    if ($('input[type="checkbox"]:checked').length === 0) {
      $('#all').prop('checked', true);
    }
    updateEvents();
  }


  updateEvents();

  function getSelectedButton() {
    return $('button[type="button"].active').val();
  }

  function getSelectedCheckboxes() {
    var selectedCheckboxes = [];
    $('input[type="checkbox"]').each(function() {
      if ($(this).is(':checked')) {
        selectedCheckboxes.push($(this).val());
      }
    });
    return selectedCheckboxes;
  }

  function updateEvents() {
    var selectedButton = getSelectedButton();

    $.ajax({
      type: "GET",
      url: "db.php",
      dataType: "json",
      data: { date: selectedButton },
      success: function(data) {
        var events;
        if (selectedButton === "button_today") {
          events = data.jsonEventsToday;
        } else if (selectedButton === "button_tomorrow") {
          events = data.jsonEventsTomorrow;
        } else if (selectedButton === "button_weekend") {
          events = data.jsonEventsWeekend;
        } else if (selectedButton === "button_all") {
          events = data.jsonEventsAll;
        }
        var parsedEvents = JSON.parse(events);
        filterEvents(parsedEvents);
      },
      error: function(xhr, status, error) {
        console.error("Virhe hakiessa dataa PHP-skriptiltä.");
        console.error("Virhe AJAX-pyynnössä:", xhr.status, xhr.statusText);
        console.error("Tarkempi virheviesti:", error);
      }
    });
  }
  
  function filterEvents(events) {
    var events = events;
    var selectedCheckboxes = getSelectedCheckboxes();
    var filteredEvents = [];
    for (var i = 0; i < events.length; i++) {
      var event = events[i];
      var eventCategory = event.primary_category.split(',');
      if (selectedCheckboxes.includes('all') || eventCategory.some(cat => selectedCheckboxes.includes(cat))) {  
        filteredEvents.push(event);
      }
    displayEvents(filteredEvents);
    }
  }

  function displayEvents(events) {
      var eventList = $('#event-list');
      eventList.empty();

      for (var i = 0; i < events.length; i++) {
        var event = events[i];
        var eventName = event.name;
        var eventOrganizer = event.organizer;
        var eventTime = event.time_start;

        var eventDate = new Date(event.day);
        var today = new Date();
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);

        if (eventDate.toDateString() === today.toDateString()) {
            var formattedEventDate = "Tänään";
        } else if (eventDate.toDateString() === tomorrow.toDateString()) {
            var formattedEventDate = "Huomenna";
        } else {
          var eventDate = event.day;
            var formattedEventDate = eventDate.slice(8, 10) + '.' + eventDate.slice(5, 7) + '.' + eventDate.slice(0, 4);
        }

        var eventType = event.primary_category;
        
        var keywordTranslations = {
          nightlife: "bileet ja yöelämä",
          wellbeing: "liikunta ja hyvinvointi",
          seeexperience: "näe ja koe",
          eatdrink: "herkkuhetket",
          create: "omin käsin",
          learn: "opi ja keskustele",
          spirituality: "hengelliset tapahtumat",
          beactive: "vaikuta",
          accessibility: "esteetön tila"
        };
        var eventKeywords = event.category;
        var formattedKeywords = event.category.split(',');
        var translatedKeywords = formattedKeywords.map(function(keyword) {
          return keywordTranslations[keyword] || keyword;
        });
        eventKeywords = translatedKeywords.join(', ');
        var eventDescription = event.description;
        include "images.js";
        var imagePath = imageUrl[eventType];
        if (imagePath === undefined) {
          imagePath = "https://lahde.s3.eu-north-1.amazonaws.com/lahde2.webp?response-content-disposition=inline&X-Amz-Security-Token=IQoJb3JpZ2luX2VjEL%2F%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEaCmV1LW5vcnRoLTEiRzBFAiEAzdyxegeQNTqtI4Mzmf1pmJDeXHYFMRUWdnXJpVMxeEACIG5rj%2FCYFrtQmuapggAoZt32PMaXzcSQdetuv7Wu2F6wKu0CCOn%2F%2F%2F%2F%2F%2F%2F%2F%2F%2FwEQABoMNDgyNDAzNzk3MDQwIgxw4z376CYyrr2gsk0qwQJOhxx%2FN3Vywribtv8zBPqIZD8MNftnblhMWlN%2FPg6ilCS1IiXNUse6OQLYy1SznOPcC1GqQaasAWXTdxURAxcZLGcK%2FmQQ5P4OxjXL81xTV2JgkENxAM48yt3cLS1BHLDYIprlJFBUMUowzDrkjGN6XB0k1kXWbCewyPeqNsolGYaisdH8U8WmyVCBa8UVG8A55JWCiuNTi2T%2FKEKiTFL%2BdOketF%2BrlkfTPYoKD9r6gc%2BTYbuuc4wukrxSj79zhhAmtmsUpY42xelZSnpRFEH84dZdGzU43qjxYy0lj6Lzu5uOEf1RiD1xWFuIaFR7ub2UJ73RtYP2yexsIHpyFFHvgAIDcO8LNvI9bWOXfmnsx4%2B%2B8wC5W2RPEqKpjqTnpPuxOb82IjLhYhGfI%2BAAxf7kDbJw7eYNzilLgqpCpMTWpJ0w09iCqgY6swIvfC%2BMzvRDq5KwmxhJwUZsosLsYPC5Mh0sZIrVZTQb4sl2Y2Ccam8ChZdPso3wywAS9rZ8iN4WN5wWHKZG%2FrWZTmc3%2BJ2XB8%2BbXlKEI6RjRq%2BmnrIwk0udHjeWb%2BzBRwHxsftW3wlv1Me%2FjBiSxXMci4nnj6EYjIN7lukxOlQQspMUCcswcmSDsAQOWlybABepLWadjYyraVRQi0GRxMJeR2DnQhNqRwfQn3QENPCeBxcYjSd%2FYsY%2BI34T3Oqcxlg%2BwdQn5O%2BotHEYSA7MT5UPUpv5jbcxK15uRDFMoXb9Hpe2eH%2FlFoq2R4Tms7LvroP2HnPXKLoJ8MkBhVvO5urqlKQeaMYudCRp4%2Fs8sf9HILLu4%2BeY%2F51Mr%2Feij0X2erJzZmpdQFyKasFpSS3OvKBMbbM8&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Date=20231031T110524Z&X-Amz-SignedHeaders=host&X-Amz-Expires=300&X-Amz-Credential=ASIAXAUMBZAYNNNETQGI%2F20231031%2Feu-north-1%2Fs3%2Faws4_request&X-Amz-Signature=c929d645a36728486a7cb37f65d3be3505b2709c1d4bece624461600a0e482a6";
        }

        var formattedEventTime = eventTime.slice(0, 5);
        
        var eventCard = $('<div class="card mb-3" id="mainEventCard"">');
        var cardBody = $('<div class="row g-0">');
        cardBody.append('<div class="col-md-3"><img src="' + imagePath + '" class="img" alt="..."></div>');
        var cardBodyRight = $('<div class="col-md-8">');
        cardBodyRight.append('<div class="card-body">');
        cardBodyRight.find('.card-body').append($('<h5 class="card-title">' + eventName + '</h5>'));
        cardBodyRight.find('.card-body').append($('<p class="card-text">' + formattedEventDate + ' klo ' + formattedEventTime + '</p>'));
        cardBodyRight.find('.card-body').append($('<p class="card-text">Kuvaus: ' + eventDescription + '</p>'));
        cardBodyRight.find('.card-body').append($('<p class="card-text">Järjestäjä: ' + eventOrganizer + '</p>'));
        cardBodyRight.find('.card-body').append($('<p class="card-text"><small class="text-muted">Avainsanat: ' + eventKeywords + '</small></p>'));
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
