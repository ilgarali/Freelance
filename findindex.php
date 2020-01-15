<?php 
session_start();
include_once 'includes/db.php';
if (!isset($_SESSION['id'])) {
     header("Location:index.php");
}
$location = $_POST['location'];
$title = $_POST['title'];


if (trim(isset($title)) && trim(is_string($title)) && trim(!empty($title)) && 
trim(isset($location)) && trim(is_string($location)) && trim(!empty($location))
) {
     $sql = "SELECT * FROM job_posts WHERE job_location LIKE ?  AND job_title LIKE ?";
     $stmt =$conn->prepare($sql);
     $stmt->execute(["%" . $location . "%","%" . $title . "%"]);
     $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
     echo json_encode($datas);
}

elseif (trim(isset($title)) && trim(is_string($title)) && trim(!empty($title)))
 {
     $sql = "SELECT * FROM job_posts WHERE job_title LIKE ? ";
     $stmt =$conn->prepare($sql);
     $stmt->execute(["%" . $title . "%"]);
     $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
     echo json_encode($datas);

 }
elseif (trim(isset($location)) && trim(is_string($location)) && trim(!empty($location))) {
    $sql = "SELECT * FROM job_posts WHERE job_location LIKE ? ";
     $stmt =$conn->prepare($sql);
     $stmt->execute(["%" . $location . "%"]);
     $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
     echo json_encode($datas);

}



?>