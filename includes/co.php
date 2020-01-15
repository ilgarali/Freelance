<?php 
include_once 'db.php';



if (isset($_SESSION['id'])) {
    $sessid = $_SESSION['id'];
$sql = "SELECT `type` FROM users WHERE `id`=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$sessid]);
$data=$stmt->fetch();

if ($data['type'] != 0) {
    header('Location:/index.php');
}


  }


?>