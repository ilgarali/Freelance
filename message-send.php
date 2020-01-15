<?php 
include_once 'includes/db.php';
session_start();
$message = $_POST['message'];
$to_id = $_POST['to_id'];
$from_id = $_SESSION['id'];
if ( 
    trim(isset($message)) && trim(is_string($message)) && trim(!empty($message)) &&
    trim(isset($to_id)) && trim(is_string($to_id)) && trim(!empty($to_id))
   ) 
    {
        $sql= "INSERT INTO messages (from_id,to_id,`message`) VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);

        $stmt->execute([$from_id,$to_id,$message]) ;
        $res = ["success" => true];
        echo json_encode($res);

    }

?>


