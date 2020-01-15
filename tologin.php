<?php
include('includes/db.php');
session_start();
$data = [];


if (trim(isset($_POST['email'])) && trim(!empty($_POST['email'])) && trim(is_string($_POST['email']))  &&
 trim(isset($_POST['pass'])) && trim(is_string($_POST['pass'])) && trim(!empty($_POST['pass']))) {
    $email = $_POST['email'];
    $pass = "il".md5($_POST['pass'])."qar";
    

    
    $sql = "SELECT id from users WHERE email = '$email' AND `password` = '$pass'";
    $stmt = $conn->query($sql)->fetch();
    if (isset($stmt['id'])) {
        $_SESSION['id'] = $stmt['id'];
        echo json_encode(['status'=>'success']);
    }else{
        echo json_encode(['status'=>'error']);
    }
}


?>