<?php
include 'includes/db.php';
include_once 'includes/co.php';

// CHECK IMAGE ISSET OR NOT IF ISSET UPLOAD IMAGE
if (isset($_FILES['cover_img_file']['name']) ) {
    $img = $_FILES['cover_img_file']['name'];
    $uploadDir = 'upload/'.$img;
    $tmp_img = $_FILES['cover_img_file']['tmp_name'];
    $getExt = pathinfo($img,PATHINFO_EXTENSION);
    $valid = ['jpg','jpeg','png','gif'];
// CHECKING VALID IMAGE EXTENSION
        if (in_array($getExt,$valid)) {
        move_uploaded_file($tmp_img,$uploadDir);


        $title = $_POST['title'];
        $option = $_POST['option'];
        $job_short = $_POST['job_short'];
        $job_type = $_POST['job_type'];

        $location = $_POST['location'];
        $salary = $_POST['salary'];    
        $working_hours = $_POST['working_hours'];
        $exprience = $_POST['exprience'];
        $jobcategory = $_POST['jobcategory'];
        $degree = $_POST['degree'];
        $job_detail = $_POST['job_detail'];
        $created_at = date('Y-m-d H:i:s');
        $expires_at = date('Y-m-d H:i:s');

        $editid = $_POST['editid'];


        if ( 
        trim(isset($title)) && trim(is_string($title)) && trim(!empty($title)) &&
        trim(isset($option)) && trim(is_string($option)) && trim(!empty($option)) &&
        trim(isset($job_short)) && trim(is_string($job_short)) && trim(!empty($job_short)) &&
        trim(isset($job_type)) && trim(is_string($job_type)) && trim(!empty($job_type)) &&
        trim(isset($location)) && trim(is_string($location)) && trim(!empty($location)) &&
        trim(isset($salary)) && trim(is_string($salary)) && trim(!empty($salary)) &&
        trim(isset($working_hours)) && trim(is_string($working_hours)) && trim(!empty($working_hours)) &&
        trim(isset($exprience)) && trim(is_string($exprience)) && trim(!empty($exprience)) &&
        trim(isset($jobcategory)) && trim(is_string($jobcategory)) && trim(!empty($jobcategory)) &&
        trim(isset($degree)) && trim(is_string($degree)) && trim(!empty($degree)) &&
        trim(isset($job_detail)) && trim(is_string($job_detail)) && trim(!empty($job_detail))
        
    )
        {
        $sql = "UPDATE job_posts SET job_title =?,company_id=?,job_short=?,job_location=?,job_type=?,salary=?,working_hours=?,
        exprience=?,degree=?,job_detail=?,cover_img=?,created_at=?,expires_at=?,job_category=? WHERE jid = $editid 
            ";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$title,$option,$job_short,$location,$job_type,$salary,$working_hours,$exprience,$degree,$job_detail,$img,$created_at,$expires_at,$jobcategory]);
        $response = ['success'=>true];
        echo json_encode($response);
        }

        }

        else{
            echo "FAILL";
        }

}

// IF NOT SET IMAGE DO THAT
else{
       
        $title = $_POST['title'];
        $option = $_POST['option'];
        $job_short = $_POST['job_short'];
        $job_type = $_POST['job_type'];
    
        $location = $_POST['location'];
        $salary = $_POST['salary'];    
        $working_hours = $_POST['working_hours'];
        $exprience = $_POST['exprience'];
        $jobcategory = $_POST['jobcategory'];
        $degree = $_POST['degree'];
        $job_detail = $_POST['job_detail'];
        $created_at = date('Y-m-d H:i:s');
        $expires_at = date('Y-m-d H:i:s');
    
        $editid = $_POST['editid'];
    
    
        if ( 
            trim(isset($title)) && trim(is_string($title)) && trim(!empty($title)) &&
            trim(isset($option)) && trim(is_string($option)) && trim(!empty($option)) &&
            trim(isset($job_short)) && trim(is_string($job_short)) && trim(!empty($job_short)) &&
            trim(isset($job_type)) && trim(is_string($job_type)) && trim(!empty($job_type)) &&
            trim(isset($location)) && trim(is_string($location)) && trim(!empty($location)) &&
            trim(isset($salary)) && trim(is_string($salary)) && trim(!empty($salary)) &&
            trim(isset($working_hours)) && trim(is_string($working_hours)) && trim(!empty($working_hours)) &&
            trim(isset($exprience)) && trim(is_string($exprience)) && trim(!empty($exprience)) &&
            trim(isset($jobcategory)) && trim(is_string($jobcategory)) && trim(!empty($jobcategory)) &&
            trim(isset($degree)) && trim(is_string($degree)) && trim(!empty($degree)) &&
            trim(isset($job_detail)) && trim(is_string($job_detail)) && trim(!empty($job_detail))
            
        )
         {
            $sql = "UPDATE job_posts SET job_title =?,company_id=?,job_short=?,job_location=?,job_type=?,salary=?,working_hours=?,
            exprience=?,degree=?,job_detail=?,created_at=?,expires_at=?,job_category=? WHERE jid = $editid 
             ";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$title,$option,$job_short,$location,$job_type,$salary,$working_hours,$exprience,
            $degree,$job_detail,$created_at,$expires_at,$jobcategory]);
           $response = ['success'=>true];
            echo json_encode($response);
        }
      
    
    // IF SOMETHING WENT WRONG DO THAT
    else{
        echo "FAILL";
    }



}


?>