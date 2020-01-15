<?php 
include('includes/db.php');

$img = basename($_FILES['img']['name']);
$targetPath = "upload/" . $img;
$tmp_dir = $_FILES['img']['tmp_name'];

move_uploaded_file($tmp_dir,$targetPath);
$text =$_POST['title'];
$title =$_POST['text'];



$sql = "INSERT INTO test (title,`text`,img) VALUES(?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$title,$text,$img]);



?>
