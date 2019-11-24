<?php
require_once("db/pdo.php");
$id;
$result;
$comments;
if(isset($_GET["id"])) {
    $id = $_GET["id"];

    if(connectDatabase()) {
        $stmt = $CONNECTION->prepare("SELECT * FROM blogentry WHERE id=:id LIMIT 1");
        $stmt->bindParam(":id", $id);
        if($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$result) {
                header("Location: index.php?error=notFound");
            }
        
        $stmt = $CONNECTION->prepare("SELECT * FROM blogcomments WHERE blogid=:id");
        $stmt->bindParam(":id", $id);
        if($stmt->execute()) {
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!$result) {
                header("Location: index.php?error=notFound");
            }
        }
    } else {
        header("Location: index.php?error=unknown");
    }
}
} else {
    header("Location: index.php?error=noIdSet");
}

$tmp = explode(" ", $result["entrydate"]);
$tmp = explode("-", $tmp[0]);
$dateFormatted = $tmp[2].".".$tmp[1].".".$tmp[0];
                            


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo $result["heading"] ?></title>
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
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="contact.php">Kontakt </a>
      </li>
    </ul>
    <div class="d-flex align-content-end  flex-column">
        <a class="align-left nav-link" href="login.php">Login </a>
    </div>
  </div>
</nav>

<div class="main-wrapper">
    <div class="entry">
        <h1 class="title"><?php echo $result["heading"] ?></h1>
        <p class="info"><?php echo $dateFormatted ?> <?php echo $result["location"] ?></p>
        <div class="img">
            <img src="img/Studium.jpg" alt="Studenten">
        </div>
        <p class="text"><?php echo $result["text"] ?></p>
    </div>


    <h3>Kommentare</h3>
    <div class="comment-wrapper">
    <?php
        foreach($comments as $comm) {
        $tmp = explode(" ", $comm["commentDate"]);
        $tmp = explode("-", $tmp[0]);
        $commDateFormatted = $tmp[2].".".$tmp[1].".".$tmp[0];

        ?>
            <div class="comment">
                <div class="info"><span class="name"><?php echo $comm["name"] ?></span> <span class="date"><?php echo $commDateFormatted ?></span></div>
                <p class="text"><?php echo $comm["text"] ?></p>
            </div>
        <?php
        }
    ?>        
    </div>

    <h4 class="top-margin">Neuen Kommentar verfassen:</h4>
    <form action="services/commentService.php" method="POST">
        <input type="hidden" name="entryId" value="<?php echo $result["id"] ?>">
    <div class="form-group">
        <label for="comment_name">Dein Name</label>
        <input name="name" type="text" class="form-control" id="comment_name" placeholder="Max Mustermann">
    </div>
    <div class="form-group">
        <label for="comment_text">Kommentar:</label>
        <textarea name="text"  class="form-control" id="comment_text" rows="3"></textarea>
    </div>
    <button class="btn btn-dark mt-4 ml-2" type="submit">Absenden</button>
    </form>

</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>