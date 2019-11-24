<?php
require_once("common/sessionStarter.php");


"SELECT * FROM users WHERE usernam=:username"

$result;

if(password_verify($_POST["password"], $result["password"])) {

$_SESSION["username"] = $result["username"];
$_SESSION["user_id"] = $result["id"];
header("Location: index.php?login=success");
}


?>