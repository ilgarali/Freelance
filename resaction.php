<?php 
session_start();
include('includes/db.php');
include_once 'includes/fr.php';
$delid = $_POST['id'];
if (trim(isset($delid)) && trim((is_string($delid))) && trim(!empty($delid)) && $_SESSION['id']) {
    $sql = "DELETE FROM freelancer WHERE fid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$delid]);
    $res = ["success" => true];
    echo json_encode($res);

    
}
else{
    echo "Something went wrong";
}

?>