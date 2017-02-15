<?php

$user = $_SESSION["username"];

include 'koneksi.php';

$nama = $_POST['nama'];
$info = $_POST['info'];
$lokasi = $_POST['lokasi'];
$alamat = $_POST['alamat'];
$cp = $_POST['cp'];
$id = $_POST['id'];



$query = "UPDATE  studio SET  nama= '$nama', info='$info', lokasi='$lokasi',alamat =  '$alamat',cp = '$cp' WHERE  idstudio ='$id'";
$sql = oci_parse($koneksi,$query);
ociexecute($sql);
$lokasi_file = $_FILES['foto']['tmp_name'];
if (!empty($lokasi_file)) {
    
    $tipe_file = $_FILES['foto']['type'];
    $nama_file = $_FILES['foto']['name'];
    $direktori = "image_studio/$nama_file";

    move_uploaded_file($lokasi_file, $direktori);

    $query2 = "SELECT * FROM studio WHERE idstudio='$id'";
    $sql2 = oci_parse($koneksi, $query2);
    ociexecute($sql2);
    while (ocifetchinto($sql2, $data1, OCI_ASSOC)) {
        $fotolama = $data1['FOTO'];
        $hapus = "image_studio/$fotolama";
        @$hapusfoto = unlink($hapus);

        $query1 = "UPDATE  studio SET foto = '$nama_file' WHERE  idstudio ='$id'";
        $sql1 = oci_parse($koneksi,$query1);
        oci_execute($sql1);
    }
}
echo "<meta http-equiv=refresh content=0;url=homeadmin.php?cat=kelola>";
?>
