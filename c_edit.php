<?php
session_start();
include('includes/db.php');
include_once 'includes/co.php';

// CHECK IMAGE ISSET OR NOT IF ISSET UPLOAD IMAGE

if (isset($_FILES['img']['name'])) {

    $img = basename($_FILES['img']['name']);
    $targetPath = "upload/".$img;
    $tmp_img = $_FILES['img']['tmp_name'];

    $valid = ['jpg','jpeg','gif','png'];
    $ext = pathinfo($img,PATHINFO_EXTENSION);

// CHECKING VALID IMAGE EXTENSION

    if (in_array($ext,$valid)) {
    move_uploaded_file($img,$targetPath);

    $editid = $_POST['editid'];
    $c_name = $_POST['c_name'];
    $headline = $_POST['headline'];
    $c_des = $_POST['c_des'];
    $location = $_POST['location'];
    $website = $_POST['website'];
    $founded = $_POST['founded'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $c_detail = $_POST['c_detail'];
    $option = $_POST['option'];
    $employer = $_POST['employer'];
    if ( trim(is_string($c_name)) && trim(isset($c_name)) && trim(!empty($c_name)) && 
    trim(is_string($headline)) && trim(isset($headline)) && trim(!empty($headline)) &&
    trim(is_string($c_des)) && trim(isset($c_des)) && trim(!empty($c_des)) &&
    trim(is_string($location)) && trim(isset($location)) && trim(!empty($location)) &&
    trim(is_string($employer)) && trim(isset($employer)) && trim(!empty($employer)) &&
    trim(is_string($website)) && trim(isset($website)) && trim(!empty($website)) &&
    trim(is_string($founded)) && trim(isset($founded)) && trim(!empty($founded)) &&
    trim(is_string($phone)) && trim(isset($phone)) && trim(!empty($phone)) &&
    trim(is_string($email)) && trim(isset($email)) && trim(!empty($email)) &&
    trim(is_string($c_detail)) && trim(isset($c_detail)) && trim(!empty($c_detail)) &&
    trim(is_string($option)) && trim(isset($option)) && trim(!empty($option))) 
    {

        $sql = "UPDATE company SET img=?,c_name=?,headline=?,c_des=?,`location`=?,website=?,founded=?,phone=?,email=?,c_detail=?,category_id=?
        WHERE cid = $editid";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$img,$c_name,$headline,$c_des,$location,$website,$founded,$phone,$email,$c_detail,$option]);    
        
        $res = ["res"=>"Updated","success"=>true ];
        echo json_encode($res);
    }



    }


}
// IF NOT SET IMAGE DO THAT
else{
  
    $editid = $_POST['editid'];
    $c_name = $_POST['c_name'];
    $headline = $_POST['headline'];
    $c_des = $_POST['c_des'];
    $location = $_POST['location'];
    $website = $_POST['website'];
    $founded = $_POST['founded'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $c_detail = $_POST['c_detail'];
    $option = $_POST['option'];
    $employer = $_POST['employer'];
    if ( trim(is_string($c_name)) && trim(isset($c_name)) && trim(!empty($c_name)) && 
    trim(is_string($headline)) && trim(isset($headline)) && trim(!empty($headline)) &&
    trim(is_string($c_des)) && trim(isset($c_des)) && trim(!empty($c_des)) &&
    trim(is_string($location)) && trim(isset($location)) && trim(!empty($location)) &&
    trim(is_string($employer)) && trim(isset($employer)) && trim(!empty($employer)) &&
    trim(is_string($website)) && trim(isset($website)) && trim(!empty($website)) &&
    trim(is_string($founded)) && trim(isset($founded)) && trim(!empty($founded)) &&
    trim(is_string($phone)) && trim(isset($phone)) && trim(!empty($phone)) &&
    trim(is_string($email)) && trim(isset($email)) && trim(!empty($email)) &&
    trim(is_string($c_detail)) && trim(isset($c_detail)) && trim(!empty($c_detail)) &&
    trim(is_string($option)) && trim(isset($option)) && trim(!empty($option))) 
    {

        $sql = "UPDATE company SET c_name=?,headline=?,c_des=?,`location`=?,website=?,founded=?,phone=?,email=?,c_detail=?,category_id=?
        WHERE cid = $editid";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$c_name,$headline,$c_des,$location,$website,$founded,$phone,$email,$c_detail,$option]);    
        
        $res = ["res"=>"Updated","success"=>true ];
        echo json_encode($res);
    }


}






?>