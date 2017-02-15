

$query = "insert into tamu (idtamu,nama,komentar,email,tanggal) values (idtamu.nextVal,'$nama','$komentar','$email',sysdate)";
$result = oci_parse($koneksi, $query);
ociexecute($result);
echo "<meta http-equiv=refresh content=0;url=index.php>";
?>