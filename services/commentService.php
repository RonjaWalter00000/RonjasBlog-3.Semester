<?php
require_once("../common/sessionStarter.php");
require_once("../db/pdo.php");

$result = array();
$result["success"] = false;

if(true) { //isset($_SESSION["user_id"])) 
    if(connectDatabase()) {
        if(isset($_POST["name"]) && isset($_POST["text"]) && isset($_POST["entryId"])) {
            if((strlen(trim($_POST["text"])) > 0) && (strlen(trim($_POST["name"])) > 0)) {
                $text = $_POST["text"];
                $name = $_POST["name"];

                if(checkIfEntryExists($_POST["entryId"])) {
                    $stmt = $CONNECTION->prepare("INSERT INTO blogcomments(name, text, blogid) VALUES(:name, :text, :id)");
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":text", $text);
                    $stmt->bindParam(":id", $_POST["entryId"]);

                    $stmtResult = $stmt->execute();

                    if($stmtResult) {
                        header("Location: ../details.php?id=".$_POST["entryId"]);
                    }
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



function checkIfEntryExists($id) {
    global $CONNECTION;
    $stmt = $CONNECTION->prepare("SELECT COUNT(*) FROM blogentry WHERE id=:id");
    $stmt->bindParam(":id", $id);

    if($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(count($result) == 1) {
            return true;
        } else {return false;}
    } else {
        return false;
    }

}
?>