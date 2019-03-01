<?php
if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name']))
{
$image=$_POST["imagenactual"];
}
else 
{
$ext = explode(".", $_FILES["image"]["name"]);
$image = round(microtime(true)) . '.' . end($ext);
move_uploaded_file($_FILES["image"]["tmp_name"], "../files/" . $image);  
}
?>