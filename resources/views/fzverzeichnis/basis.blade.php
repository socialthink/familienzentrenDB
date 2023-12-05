
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Grundgerüst</title>

  <!-- Bootstrap CSS (entweder von einem CDN oder lokal heruntergeladen) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Optionales eigenes CSS -->
  <!-- <link rel="stylesheet" href="styles.css"> -->

  <style>
  /* Gemeinsame Stile für alle Formularfelder */
  input[type="text"],
  input[type="email"],
  input[type="password"],
  input[type="number"],
  textarea,
  select {
    width: 100%;
    padding: 10px;
    padding-left: 0px;
    margin-bottom: 15px;
    display: inline-block;
    border: none; /* Kein Rahmen an den Seiten */
    border-bottom: 1px solid #ccc; /* Nur ein unterer Rand */
    box-sizing: border-box;
    border-radius: 0; /* Abgerundete Ecken entfernen */
  }

  /* Stil für den Fokus (bei Klick) */
  input[type="text"]:focus,
  input[type="email"]:focus,
  input[type="password"]:focus,
  textarea:focus,
  select:focus {
    border-color: #007bff; /* Farbe ändern, wenn das Feld den Fokus erhält */
    outline: none; /* Entfernen des Standard-Fokus-Rahmens */
  }

  label.form-label {
    font-size: 0.9rem; /* Kleinere Schriftgröße für das Label */
    color: #999; /* Leichtes Grau für die Schriftfarbe */
  }
  a.form-link {
  color: #999; /* Leichtes Grau für den Link */
}

/* Stil für den Link, wenn er gehovered wird */


  </style>

  @yield('kopf')

</head>
<body>

  <div class="container">

@yield('inhalt')

  </div>

  <!-- Bootstrap JavaScript-Bibliothek (entweder von einem CDN oder lokal heruntergeladen) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Optionale eigene JavaScript-Dateien -->
  <!-- <script src="scripts.js"></script> -->
  @yield('fuss')
</body>
</html>
