<?php 
include('includes/db.php');
include_once 'includes/co.php';
$keyword= $_POST['keyword'];
$location= $_POST['location'];
$select = $_POST['select'];

    if (trim(!empty($keyword)) && trim(is_string($keyword)) && trim(isset($keyword)) 
    
    ) {
        $sql = "SELECT * FROM company WHERE c_name LIKE ? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["%". $keyword ."%"]);
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($datas);


    }
    elseif (trim(!empty($location)) && trim(is_string($location)) && trim(isset($location)) ) {
        $sql = "SELECT * FROM company WHERE `location` LIKE ? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["%". $location ."%",]);
        $datas = $stmt->fetchAll();
        echo json_encode($datas);
    }elseif ( trim(!empty($select)) && trim(is_string($select)) && trim(isset($select))) {
        $sql = "SELECT * FROM company WHERE category_id LIKE ? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["%" . $select . "%"]);
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($datas);
    }
