@extends('fzverzeichnis.basis')

@section('kopf')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

@endsection

@section('inhalt')

<div class="container">
<h1 class="mt-5">Erfassung vergangener Aktivität</h1>

@if ($errors->any())
<div class="mt-4">
    <div class="alert alert-danger">

            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach

    </div>
  </div>
@endif
@if (session('status'))
<div class="mt-4">
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          </div>

@endif
<p></br></p>
<div class="row">



  <div class="col-lg-6">



    <form method="POST" action="ersterfassung/add">
      @csrf

      <input id="lat" name="lat" class="form-control" type="text">
      <input id="lng" name="lng" class="form-control" type="text">

      <div class="mb-3">
        <label class="form-label" for="bezeichnung">Bezeichnung:</label>
        <input id="bezeichnung" name="bezeichnung" class="form-control" type="text" required>
      </div>
      </br>

      <div class="mb-3">
        <label class="form-label" for="traegerschaft">Trägerschaft:</label>
        <input id="traegerschaft" name="traegerschaft" class="form-control" type="text" required>
      </div>
      </br>

      <div class="mb-3">
        <label class="form-label" for="email">allgemeine E-Mail-Adresse</label>
        <input id="email" name="email" class="form-control" type="email" required>
      </div>
      </br>

      <div class="mb-3">
        <label class="form-label" for="adresse1">Strasse</label>
        <input id="strasse" name="strasse" class="form-control" type="text" required>
      </div>
      </br>

      <div class="mb-3">
        <label class="form-label" for="adresse1">Adresszusatz</label>
        <input id="adresszusatz" name="adresszusatz" class="form-control" type="text" required>
      </div>
      </br>

      <div class="row mb-3">
        <div class="col-3">
          <label class="form-label" for="date">PLZ</label>
        <input id="plz" name="plz" class="form-control" type="text" onblur="validateInput()" required>
        <script>
          function validateInput() {
            var input = document.getElementById('plz');
            var value = input.value;

            if (!/^\d{4}$/.test(value)) {
              alert('Bitte korrekte PLZ angeben.');
              input.value = ''; // Setze den Wert zurück
            }
          }
        </script>
      </div>
      <div class="col-9">
        <label class="form-label" for="date">Ort</label>
      <input id="ort" name="ort" class="form-control" type="text" onblur="geocodeAddress()" required>
    </div>
      </div>
      </br>

      <div class="mb-3">
        <label class="form-label" for="map">Ort auf der Karte prüfen, ggf. Marker neu setzen (<a class="form-link" href="javascript:geocodeAddressLink()">Marker nochmals anhand Adresse setzen</a>)</label>
        <div id="map" style="width: 100%; height: 200px;"></div>
      </div>
      </br>




      <div class="col-12">
        <button class="btn btn-primary" type="submit">Erfassen</button>
      </div></br>
    </form>


  </div>
</div>

</div>
@endsection


@section('fuss')

<script>

  const map = L.map('map').setView([46.897964201524914,8.238147321559321], 7);

  const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 17,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

var geocodingCompleted = false; // Variable zur Überprüfung des Geokodierungsstatus
 var marker;

 map.on('click', function (e) {
   if (geocodingCompleted) {
  if (marker) { // check
   map.removeLayer(marker); // remove old layers
  }
 marker = new L.Marker(e.latlng).addTo(map); // set New Layer
 map.setView(e.latlng);
 document.getElementById("lat").value = e.latlng.lat;
 document.getElementById("lng").value = e.latlng.lng;
 markerVerschoben = false; // Geokodierung abgeschlossen
  }
      });
      var markerVerschoben = true;

      function geocodeAddress() {
        // Adressdaten abrufen
        var street = document.getElementById("strasse").value;
        var postalCode = document.getElementById("plz").value;
        var city = document.getElementById("ort").value;


        // Überprüfen, ob alle drei Felder ausgefüllt sind
        if (street && postalCode && city && markerVerschoben) {
          // Adressdaten zu einer vollständigen Adresse kombinieren
          var address = street + ", " + postalCode + " " + city;

          // API-Anfrage an Nominatim senden
          fetch("https://nominatim.openstreetmap.org/search?q=" + address + "&format=json&addressdetails=1&limit=1")
            .then(response => response.json())
            .then(data => {
              // Latitude und Longitude aus der API-Antwort extrahieren
              var latitude = data[0].lat;
              var longitude = data[0].lon;

              // Koordinaten in die entsprechenden Input-Felder einfügen
              document.getElementById("lat").value = latitude;
              document.getElementById("lng").value = longitude;
              if (marker) { // check
               map.removeLayer(marker); // remove old layers
              }
             marker = new L.Marker([latitude,longitude]).addTo(map); // set New Layer
             map.setView([latitude,longitude],17);
             geocodingCompleted = true; // Geokodierung abgeschlossen
            })
            .catch(error => console.error('Fehler bei der Geokodierung:', error));
        }
      }

      function geocodeAddressLink() {
        // Adressdaten abrufen
        var street = document.getElementById("strasse").value;
        var postalCode = document.getElementById("plz").value;
        var city = document.getElementById("ort").value;


        // Überprüfen, ob alle drei Felder ausgefüllt sind
          // Adressdaten zu einer vollständigen Adresse kombinieren
          var address = street + ", " + postalCode + " " + city;

          // API-Anfrage an Nominatim senden
          fetch("https://nominatim.openstreetmap.org/search?q=" + address + "&format=json&addressdetails=1&limit=1")
            .then(response => response.json())
            .then(data => {
              // Latitude und Longitude aus der API-Antwort extrahieren
              var latitude = data[0].lat;
              var longitude = data[0].lon;

              // Koordinaten in die entsprechenden Input-Felder einfügen
              document.getElementById("lat").value = latitude;
              document.getElementById("lng").value = longitude;
              if (marker) { // check
               map.removeLayer(marker); // remove old layers
              }
             marker = new L.Marker([latitude,longitude]).addTo(map); // set New Layer
             map.setView([latitude,longitude],17);
             geocodingCompleted = true; // Geokodierung abgeschlossen
            })
            .catch(error => console.error('Fehler bei der Geokodierung:', error));
      }

</script>
@endsection
