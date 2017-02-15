<?php 
include "koneksi.php";
$query = "select * from trainingSet order by no";
$sql = mysql_query($query);
?>

<table border="1" align="center">

	<tr align="center">
		<td>No</td>
		<td>Variable 1</td>
		<td>Variable 2</td>
                <td>Class</td>
                <td>Hapus</td>
	</tr>
            <?php
     $i = 1;
while($data = mysql_fetch_array($sql)){
    ?>
	<tr align="center">
		<td><?php echo $i?></td>
		<td><?php echo $data['1'];?></td>
		<td><?php echo $data['2'];?></td>
                <td><?php echo $data['class'];?></td>
                <td><a href=deleteData.php?no=<?php echo $data['no'];?>>Delete</a></td>
        </tr>
        <?php
        $i++;
        
}
        ?>
</table>


