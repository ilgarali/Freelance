<?php
include('includes/db.php');




if(trim(isset($_POST['name'])) && trim(!empty($_POST['name'])) && 
trim(is_string($_POST['name'])) && trim(isset($_POST['surname'])) &&
 trim(!empty($_POST['surname'])) && trim(is_string($_POST['surname'])) && 
 trim(isset($_POST['email'])) && trim(!empty($_POST['email'])) && 
 trim(is_string($_POST['email']))  && trim(isset($_POST['pass'])) && 
 trim(!empty($_POST['pass'])) && trim(is_string($_POST['pass'])) && 
 trim(isset($_POST['pass1'])) && trim(!empty($_POST['pass1'])) &&
 trim(is_string($_POST['pass1'])) && trim(isset($_POST['opt'])) && trim(!empty($_POST['opt'])) &&
 trim(is_string($_POST['opt']))
 )
{
    if ($_POST['pass'] == $_POST['pass1']) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $pass = "il". md5($_POST['pass']) ."qar";
        $opt = $_POST['opt'];
        $sql = $conn->query("SELECT COUNT(email) as say FROM users  where email = '$email'")->fetch();
        if ((int)($sql['say'])>0) {

        echo json_encode(['status'=>'error', 'message' =>'Bu email artiq movcuddor']);
        }
        else{
            if ($opt = $_POST['opt'] == 'Freelancer') {
                $opt = 0;
                $sql="INSERT into users (`name`,surname,email,`password`,`type`) VALUES(?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name,$surname,$email,$pass,$opt]);
                echo json_encode(['status'=>'success1']);
            }
            else if($opt = $_POST['opt'] == 'Employer')
            {
                $opt = 1;
                $sql="INSERT into users (`name`,surname,email,`password`,`type`) VALUES(?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name,$surname,$email,$pass,$opt]);
                echo json_encode(['status'=>'success2']);
               

            }


           
        }
    }

}



?>