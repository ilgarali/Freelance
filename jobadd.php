<?php
include 'includes/db.php';
include_once 'includes/co.php';
$img = $_FILES['cover_img_file']['name'];

$uploadDir = 'upload/'.$img;
$tmp_img = $_FILES['cover_img_file']['tmp_name'];
$getExt = pathinfo($img,PATHINFO_EXTENSION);
$valid = ['jpg','jpeg','png','gif'];

if (in_array($getExt,$valid)) {
    move_uploaded_file($tmp_img,$uploadDir);
    $title = $_POST['title'];
    $option = $_POST['option'];
    $job_short = $_POST['job_short'];
    $job_type = $_POST['job_type'];
    $user_id = $_POST['user_id'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];    
    $working_hours = $_POST['working_hours'];
    $exprience = $_POST['exprience'];
    
    $jobcategory = $_POST['jobcategory'];
    $degree = $_POST['degree'];
    $job_detail = $_POST['job_detail'];
    $created_at = date('Y-m-d H:i:s');
    $expires_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO job_posts (job_title,company_id,job_short,`job_location`,job_type,salary,working_hours,
    exprience,degree,job_detail,cover_img,created_at,expires_at,`user_id`,job_category)
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
    $stmt=$conn->prepare($sql);
    $stmt->execute([$title,$option,$job_short,$location,$job_type,$salary,$working_hours,$exprience,
    $degree,$job_detail,$img,$created_at,$expires_at,$user_id,$jobcategory]);
   $response = ['success'=>true];
    echo json_encode($response);
}
else{
    echo "FAILL";
}



?>