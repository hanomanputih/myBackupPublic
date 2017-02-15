<?php
include 'koneksi.php';

$no = $_GET['no'];

$query = "delete from trainingSet where no= $no";
$sql = mysql_query($query);
// echo "$id";
echo "<meta http-equiv=refresh content=0;url=index.php>";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
