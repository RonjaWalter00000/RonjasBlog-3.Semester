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
    <title>Der DHBW Blog</title>
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
        <a class="nav-link active" href="index.php">Blog <span class="sr-only">(current)</span></a>
      <li class="nav-item ">
        <a class="nav-link" href="contact.php">Kontakt </a>
      </li>
    </ul>
    <div class="d-flex align-content-end  flex-column">
        <a class="align-left nav-link" href="login.php">Login </a>
    </div>
  </div>
</nav>

<!-- Kontaktfeld
<h1> Was möchtest du uns mitteilen?</h1>
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
</div> -->


<div class="main-wrapper">
    <h1 class="mt-4">Der DHBW Blog</h1>
    <div class="container-fluid mt-4">
        <div class="row">
        <div class="col-sm-6">
            <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Lernen Sie uns kennen</h5>
                <p class="card-text">Dieser Link führt Sie zu der About Seite</p>
                <a href="about.php" class="btn btn-primary">About</a>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Kontaktieren Sie uns</h5>
                <p class="card-text">Dieser Link führt Sie zu dem Kontaktfeld</p>
                <a href="contact.php" class="btn btn-primary">Kontakt</a>
            </div>
            </div>
        </div>
        </div>
            <?php
                if(connectDatabase()) {
                    $stmt = $CONNECTION->prepare("SELECT * FROM blogentry ORDER BY entrydate DESC LIMIT 3");
                    if($stmt->execute()) {
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach($result as $entry) {
                            $tmp = explode(" ", $entry["entrydate"]);
                            $tmp = explode("-", $tmp[0]);
                            $dateFormatted = $tmp[2].".".$tmp[1].".".$tmp[0];
                            ?>
                                <div class="col-sm-8">
                                    <div class="card mb-3 mt-4">
                                        <img src="img/Studium.jpg" class="card-img-top" alt="Studenten">
                                        <div class="card-body">
                                            <p class="card-text"><small class="text-muted"><?php echo $dateFormatted ?></small><small class="text-muted"> <?php echo $entry["location"] ?></small></p>
                                            <h5 class="card-title"><?php echo $entry["heading"] ?></h5>
                                           <!--<p class="card-text"><?php // echo $entry["text"] ?></p> -->
                                            <a href="details.php?id=<?php echo $entry["id"] ?>" class="btn btn-dark">Zum Artikel</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                }
            ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>