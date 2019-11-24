<?php
require_once("../common/sessionStarter.php");
require_once("../db/pdo.php");

$result = array();
$result["success"] = false;

if(true) { //isset($_SESSION["user_id"])) 
    if(connectDatabase()) {
        if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])) {
            if((strlen(trim($_POST["name"])) > 0) && (strlen(trim($_POST["email"])) > 0) && (strlen(trim($_POST["message"])) > 0)) {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $message = $_POST["message"];

                $stmt = $CONNECTION->prepare("INSERT INTO messages(name, email, message) VALUES(:name, :email, :message)");
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":message", $message);

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