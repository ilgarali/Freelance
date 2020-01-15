<?php
include 'includes/db.php';
include_once 'includes/co.php';
$deletejob = $_POST['deletejob'];
if ( trim(is_string($deletejob)) && trim(isset($deletejob)) && trim(!empty($data))) {
    $sql = "DELETE FROM job_posts WHERE jid=?";
$stmt = $conn->prepare($sql);
if ($stmt->execute([$deletejob])) {
    
$res = ["success"=>true];
echo json_encode($res);
}
}




?>