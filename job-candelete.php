<?php 
include_once 'includes/db.php';
$getid = $_POST['getid'];
if (trim(isset($getid)) && trim(!empty($getid)) && trim(is_string($getid))) {
    $sql = "DELETE FROM `apply` WHERE appid= ? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$getid]);
    $res = ["res" => true];
    echo json_encode($res);
}



?>