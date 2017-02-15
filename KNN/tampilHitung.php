<html>
<?php
//$k = 0;
$queryhitung = "select * from perhitungan order by ecluidean";
$resulthitung = mysql_query($queryhitung);
?>
<table border="1" align="center">

	<tr align="center">
		<td>No</td>
		<td>Ecluidean</td>
                <td>Class</td>
	</tr>
            <?php
     $i = 1;
     $k = $_GET['k'];
           
while(($i <= $k)&&($datahitung = mysql_fetch_array($resulthitung))){
    ?>
	<tr align="center">
		<td><?php echo $i?></td>
		<td><?php echo $datahitung['ecluidean'];?></td>
		<td><?php echo $datahitung['class'];?></td>
        </tr>
        <?php
    if ($datahitung['class']==1) {
        $baik = $baik + 1;
    }elseif ($datahitung['class']==2) {
                $buruk = $buruk+1;
            }
        
        $i++;
        
}
?>
    </table>
    <?php
if ($baik>$buruk) {
    $keputusan = "BAIK";
}  elseif ($baik<$buruk){
   $keputusan = "BURUK" ;
} else{
    $keputusan = "yang belum bisa di tentukan";
}

echo '</br><center>Variable 1 = '.$_GET['at1'].'</br>';
echo 'Variable 2 = '.$_GET['at2'].'</br>';
echo '<p align="center" style="font-weight: bold">Termasuk dalam Klasifikasi '.$keputusan.'</p></center>';
?>
        
</html>
