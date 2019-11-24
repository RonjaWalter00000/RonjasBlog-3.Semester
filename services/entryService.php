<?php
require_once("common/sessionStarter.php");
require_once("db/pdo.php");

$result = array();
$result["success"] = false;

if(true) { //isset($_SESSION["user_id"])) 
    if(connectDatabase()) {
        if(isset($_POST["heading"]) && isset($_POST["location"]) && isset($_POST["text"])) {
            if((strlen(trim($_POST["heading"])) > 0) && (strlen(trim($_POST["location"])) > 0)&& (strlen(trim($_POST["text"])) > 0)) {
                $heading = $_POST["heading"];
                $location = $_POST["location"];
                $text = $_POST["text"];

                $stmt = $CONNECTION->prepare("INSERT INTO blogcomment(heading, location,text,blogid) VALUES(:heading,:location, :text)");
                $stmt->bindParam(":heading", $heading);
                $stmt->bindParam(":location", $location);
                $stmt->bindParam(":text", $text);

                $stmtResult = $stmt->execute();

                if($stmtResult) {
                    $result["success"] = true;
                }
            } else {
                $result["message"] = "One or more parameters with zero length!";
            }
        } else {
            $result["message"] = "Not all parameters set!";
        }
    } else {
        $result["message"] = "Connection error!";
    }
} else {
    $result["message"] = "Not logged in!";
}


echo json_encode($result);

?>