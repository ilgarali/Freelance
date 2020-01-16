<?php 
include_once "includes/db.php";
$keyword = $_POST['keyword'];
$location = $_POST['location'];
if (trim(isset($keyword)) && trim(is_string($keyword)) && trim(!empty($keyword)) &&
 trim(isset($location)) && trim(is_string($location)) && trim(!empty($location))
) {
    $sql = "SELECT * FROM freelancer WHERE head LIKE ? AND location LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["%" . $keyword . "%","%" . $location . "%"]);
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

elseif (trim(isset($keyword)) && trim(is_string($keyword)) && trim(!empty($keyword)) ) {
    $sql = "SELECT *,CONCAT(`name`,' ',surname) as fullname FROM freelancer left join users on freelancer.user_id = users.id  WHERE head LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["%" . $keyword . "%"]);
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

elseif ( trim(isset($location)) && trim(is_string($location)) && trim(!empty($location))) {
    $sql = "SELECT * FROM freelancer WHERE head LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["%" . $location . "%"]);
    $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}

?>