<?php 
include_once 'includes/co.php';
include_once 'includes/db.php';
$fillid = $_POST['fillid'];
$is_filled = $_POST['is_filled'];
if (trim(!empty($fillid)) && trim((is_string($fillid))) && trim(!empty($is_filled)) && trim((is_string($is_filled)))   ) {
    $sql="UPDATE job_posts SET is_filled =? WHERE jid=? ";
    $stmt =$conn->prepare($sql);
    $stmt->execute([$is_filled,$fillid]);
    $res=['success'=>true];
    echo json_encode($res);

}

?>