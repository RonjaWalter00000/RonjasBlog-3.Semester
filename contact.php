<?php
require_once("common/sessionStarter.php");
require_once("db/pdo.php");

if(isset($_GET["login"])) {
    ?>
    <div class="loginMessage">Login Erfolgreich!</div>
    <?php
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="jquery.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<!-- NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="index.php">DHBW BLOG</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Blog</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="contact.php">Kontakt <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>


<div class="main-wrapper">
<!-- Kontaktfeld -->
<h1 class="mt-4 ml-4"> Was möchtest du uns mitteilen?</h1>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-8">
            <form action="services/contactService.php" method="POST" onsubmit="return sendMessage()">
                <div class="form-group">
                    <label class="mt-4 ml-2"for="message_name">Vor- und Nachname</label>
                    <input class="form-control" type="text" name="name" required id="message_name" placeholder="Max Mustermann">

                    <label class="mt-4 ml-2" for="message_email">E-Mail Adresse</label>
                    <input class="form-control" type="email" name="email" required id="message_email" placeholder="name@example.com">

                    <label class="mt-4 ml-2" for="message_text">Deine Nachricht</label>
                    <textarea class="form-control" rows="6" name="message" required id="message_text" placeholder="Dein Text hier.."></textarea>

                    <button class="btn btn-dark mt-4 ml-2" type="submit">Absenden</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
      <div class="col-8">
        <div class="contact success">Nachricht wurde erfolgreich übermittelt.</div>
        <div class="contact error">Es ist ein Fehler beim übermitteln der Nachricht aufgetreten.</div>
      </div>
    </div>
</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>