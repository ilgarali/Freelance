<?php 
include('includes/db.php');
include_once 'includes/co.php';
$del_id = $_POST['id'];

if ( trim(isset($del_id)) && trim(!empty($del_id)) &&trim(isset($del_id)) ) {
    $sql = "DELETE FROM company WHERE cid= ? ";
$stmt= $conn->prepare($sql);
$stmt->execute([$del_id]);
$res = ["success" => true];
echo json_encode($res);
}

?>