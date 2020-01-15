<?php
include('includes/db.php');
session_start();
include_once 'includes/fr.php';

if (isset($_POST['submit'])) {
    $img = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    
    $valid = ['jpg','jpeg','png','gif'];
    $ext = pathinfo($img,PATHINFO_EXTENSION);
    if (in_array($ext,$valid)) {
        $k =move_uploaded_file($tmp_dir,"upload/$img");
        $user_id = $_SESSION['id'];
        $detail = $_POST['fid'];
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
           
           if (
         
           trim(is_string($detail)) && trim(isset($detail)) && trim(!empty($detail)) &&
           trim(is_string($headline)) && trim(isset($headline)) && trim(!empty($headline)) &&
           trim(is_string($des_about)) && trim(isset($des_about)) && trim(!empty($des_about)) &&
    
           trim(is_string($location)) && trim(isset($location)) && trim(!empty($location)) &&
           trim(is_string($website)) && trim(isset($website)) && trim(!empty($website))  &&
           trim(is_string($salary)) && trim(isset($salary)) && trim(!empty($salary)) &&
           trim(is_string($age)) && trim(isset($age)) && trim(!empty($age)) &&
    
           trim(is_string($phone)) && trim(isset($phone)) && trim(!empty($phone)) &&
           trim(is_string($email)) && trim(isset($email)) && trim(!empty($email)) &&
           trim(is_string($tags)) && trim(isset($tags)) && trim(!empty($tags)) &&
           trim(is_string($degree)) && trim(isset($degree)) && trim(!empty($degree)) &&
    
           trim(is_string($major)) && trim(isset($major)) && trim(!empty($major)) &&
           trim(is_string($school_name)) && trim(isset($school_name)) && trim(!empty($school_name)) &&
           trim(is_string($date_from)) && trim(isset($date_from)) && trim(!empty($date_from)) &&
           trim(is_string($date_to)) && trim(isset($date_to)) && trim(!empty($date_to)) &&
    
           trim(is_string($e_description)) && trim(isset($e_description)) && trim(!empty($e_description)) &&
           trim(is_string($company_name)) && trim(isset($company_name)) && trim(!empty($company_name))  &&
           trim(is_string($position)) && trim(isset($position)) && trim(!empty($position)) &&
           trim(is_string($date_from_c)) && trim(isset($date_from_c)) && trim(!empty($date_from_c)) &&
    
           trim(is_string($date_to_c)) && trim(isset($date_to_c)) && trim(!empty($date_to_c))  &&
           trim(is_string($c_description)) && trim(isset($c_description)) && trim(!empty($c_description)) &&
           trim(is_string($skills)) && trim(isset($skills)) && trim(!empty($skills)) &&
           trim(is_string($skill_proficiency)) && trim(isset($skill_proficiency)) && trim(!empty($skill_proficiency)) 
           )
            {

            $sql = "UPDATE freelancer SET `user_id` =? ,head=?,`description`=?,`location`=?,
            website=?,salary=?,age=?,phone=?,email=?,tags=?,degree=?
            ,major=?,school_name=?,date_from=?,date_to=?,e_description=?,company_name=?,position=?,date_from_c=?,
            date_to_c=?,c_description=?,skills=?,dev_img=?,skill_proficiency=? WHERE fid = $detail";
            $stmt = $conn->prepare($sql);
            $stmt->execute([ $user_id , $headline,$des_about,$location,$website,$salary,$age,$phone,$email,$tags,$degree,
            $major,$school_name,$date_from,$date_to,$e_description,$company_name,$position,$date_from_c,$date_to_c,
            $c_description,$skills,$img,$skill_proficiency]);
            header('Location:index.php');
           }

        
    }

else{
    echo "fail";
}
       
            
    

}
?>