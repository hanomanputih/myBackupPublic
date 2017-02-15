<?php
$q = $_GET["lokasi"];
$a = $_GET["studio"];



include 'koneksi.php';

//mysql_select_db("studiomusik", $con);
//if ($q == null) {
//    $sql = "SELECT * FROM studio WHERE nama = '" . $a . "'";
//} else if ($a == null) {
//    $sql = "SELECT * FROM studio WHERE nama = '" . $q . "'";
//} else if ($a != null && $q != null) {
//    $sql = "SELECT * FROM studio WHERE lokasi = '" . $lokasi . "' OR nama = '" . $studio . "'";
//}

//if ($lokasi != "" AND $studio != "")
//{
//    $sql = "SELECT * FROM studio WHERE lokasi = '$lokasi' AND nama = '$studio'";
//}
//elseif ($lokasi != "")
//{
//    $sql = "SELECT * FROM studio WHERE lokasi = '$lokasi'";
//}
//elseif ($studio != "")
//{
//    $sql = "SELECT * FROM studio WHERE nama = '$studio'";
//}
    $sql = "SELECT * FROM studio WHERE lokasi = '" . $q . "' OR nama = '" . $a . "'";

$result = oci_parse($koneksi, $sql);
ociexecute($result);
//echo "<table border='1'>
//<tr>
//<th>Nama Studio</th>
//<th>Lokasi</th>
//<th>Alamat</th>
//<th>Info</th>
//<th>CP</th>
//<th>Penulis</th>
//</tr>";

while (ocifetchinto($result, $row, OCI_ASSOC)) {

    echo "<h2>" . $row['NAMA'] . "<br/></h2>";
    ?>
    <img src="image_studio/<?php echo $row['FOTO'] ?>"width="30%" height="30%">
    <?php
    echo "</br>Location : " . $row['LOKASI'] . "<br/>";
    echo "Address : " . $row['ALAMAT'] . "<br/>";
    echo "Information : " . $row['INFO'] . "<br/>";
    echo "CP : " . $row['CP'] . "<br/>";
    echo "Author : " . $row['ADMIN'] . "<br/>";
    echo "<hr/>";

//  echo "<tr>";
//  echo "<td>" . $row['nama'] . "</td>";
//  echo "<td>" . $row['lokasi'] . "</td>";
//  echo "<td>" . $row['alamat'] . "</td>";
//  echo "<td>" . $row['info'] . "</td>";
//  echo "<td>" . $row['cp'] . "</td>";
//  echo "<td>" . $row['admin'] . "</td>";
//  echo "</tr>";
}
//echo "</table>";
//mysql_close($con);
?>
