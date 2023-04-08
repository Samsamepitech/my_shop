<?php 
session_start();
include_once('../includes/my_connection.php');

if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = htmlspecialchars($_GET['id']);
  $id = htmlspecialchars($_GET['id']);
    $sql = "SELECT * FROM products WHERE id=:id";

    $rq = $connect->prepare($sql);

    $rq->bindValue(':id', $id, PDO::PARAM_INT);
    $rq->execute();
    $result=$rq->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="./style_admin.css" />
    <title>Delete product</title>

</head>
<body>

<h1>Are you sure you want to delete ?</h1>

<div class="form-check">
  <label class="form-check-label">
  <a href="delete_product.php?id=<? $result['id']?>"><input type="radio" class="form-check-input" name="optradio" >YES</a>
  </label>
   
</div>
<div class="form-check">
  <label class="form-check-label">
  <a href="delete_product.php?id=<? $result['id']?>"><input type="radio" class="form-check-input" name="optradio" >NO</a>
  </label>
</div>
</body>
</html>