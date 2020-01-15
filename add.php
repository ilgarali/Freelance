<?php
include('includes/db.php');
session_start();
include_once 'includes/fr.php';
if (isset($_POST['submit'])) {
    $img = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    $k =move_uploaded_file($tmp_dir,"upload/$img");
    $valid = ['jpg','jpeg','png','gif'];
    $ext = pathinfo($img,PATHINFO_EXTENSION);
    if ($k && in_array($ext,$valid)) {
        $user_id = $_SESSION['id'];
            
            $headline = $_POST['headline'];
            $des_about = $_POST['des-about'];
            $location = $_POST['location'];
            $website = $_POST['website'];
            $salary = $_POST['salary'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $tags = $_POST['tags'];
            $degree = $_POST['degree'];
            $major = $_POST['major'];
            $school_name = $_POST['school_name'];
            $date_from = $_POST['date_from'];
            $date_to = $_POST['date_to'];
            $e_description = $_POST['e_description'];
            $company_name = $_POST['company_name'];
            $position = $_POST['position'];
            $date_from_c = $_POST['date_from_c'];
            $date_to_c = $_POST['date_to_c'];
            $c_description = $_POST['c_description'];
            $skills = $_POST['skills'];
            $skill_proficiency = $_POST['skill_proficiency'];
           
            $sql = 'INSERT INTO freelancer(`user_id`,head,`description`,`location`,website,salary,age,phone,email,tags,degree
            ,major,school_name,date_from,date_to,e_description,company_name,position,date_from_c,date_to_c,c_description,skills,dev_img,
            skill_proficiency)  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$user_id,$headline,$des_about,$location,$website,$salary,$age,$phone,$email,$tags,$degree,
            $major,$school_name,$date_from,$date_to,$e_description,$company_name,$position,$date_from_c,$date_to_c,$c_description,$skills,
            $img,$skill_proficiency]);
            header('Location:index.php');

        
    }

else{
    echo "fail";
}
       
            
    

}