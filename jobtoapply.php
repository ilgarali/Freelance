<?php 
include_once 'includes/db.php';
include_once 'includes/fr.php';
$resumeid = $_POST['resumeid'];
$jobpostid = $_POST['jobpostid'];
$companyid = $_POST['companyid'];

$sql = "INSERT INTO `apply` (resumeid,job_post_id,company_id) VALUES (?,?,?)";
$stmt= $conn->prepare($sql);


if ($stmt->execute( [$resumeid,$jobpostid,$companyid] )) {
    $res = ["success" => true];
    echo json_encode($res);
}



?>