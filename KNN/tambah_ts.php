<?php 
include 'koneksi.php';
$atribut1 = $_POST['atribut1'];
$atribut2 = $_POST['atribut2'];
$class = $_POST['class'];
//echo 

$query = "INSERT INTO  `knn`.`trainingSet` (
`no` ,
`1` ,
`2` ,
`class`
)
VALUES (
NULL ,  '$atribut1',  '$atribut2',  '$class'
);";
$sql = mysql_query($query);

 echo "<meta http-equiv=refresh content=0;url=index.php>";
 ?>