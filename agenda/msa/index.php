<?php 
session_start(); 
ini_set("max_execution_time", "0");

$gambar=array("1.jpg", "2.jpg", "3.jpg", "4.jpg", "5.jpg");
$hari=array("Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu");
$bulan=array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agt","Sep","Okt","Nov","Des");

$rand_gambar = array_rand($gambar, 2);
?>
<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
//   -->
</script>
<body onload="JavaScript:timedRefresh(6000);" background="<?php echo $gambar[$rand_gambar[1]];?> ">

<?php

$hostname = "localhost";
$database = "umum1";
$username = "root";
$password = "";
$pejabat=$_GET["key"];

$msa = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_select_db($database, $msa);
$test = "SELECT
unit.Unit_org,
agenda_hadir.Jabatan,
agenda_bos.Nama,
agenda.Apa,
agenda.Tgl_mulai,
agenda.Tgl_akhir,
agenda.Jam_mulai,
agenda.Jam_akhir,
agenda.Tempat,
agenda_hadir.id_bos
FROM agenda_hadir
INNER JOIN agenda_bos ON agenda_hadir.id_bos = agenda_bos.id_bos
INNER JOIN agenda ON agenda_hadir.id_agenda = agenda.id_agenda
INNER JOIN unit ON agenda_hadir.Instansi = unit.A5
WHERE (agenda_hadir.id_bos =".$pejabat.") and (agenda.Tgl_mulai>=now())
ORDER BY agenda.Tgl_mulai asc";

$x = mysql_query($test, $msa) or die(mysql_error());


$n=0;

while ($row = mysql_fetch_array($x, MYSQL_BOTH)) {
    $n++;
    	if ($n==1) {
?>
<div class=Section1>

<p class=MsoNormal><span class=GramE>INSTANSI :</span><b><?php echo $row[0]; ?></b></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid black .5pt;
 mso-border-themecolor:text1;mso-yfti-tbllook:1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=130 colspan=3 valign=top style='width:97.55pt;border:none;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'>NAMA </p>
  </td>
  <td width=508 colspan=5 valign=top style='width:381.25pt;border:none;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'>: <b><?php echo $row[2]; ?></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=130 colspan=3 valign=top style='width:97.55pt;border:none;
  border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-alt:solid black .5pt;mso-border-bottom-themecolor:text1;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'>JABATAN</p>
  </td>
  <td width=508 colspan=5 valign=top style='width:381.25pt;border:none;
  border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:text1;
  mso-border-bottom-alt:solid black .5pt;mso-border-bottom-themecolor:text1;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'>: <b> <?php echo  $row[1]; ?></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=35 valign=top style='width:26.6pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-top:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'>NO</p>
  </td>
  <td width=229 colspan=5 valign=top style='width:171.45pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:
  text1;border-right:solid black 1.0pt;mso-border-right-themecolor:text1;
  mso-border-top-alt:solid black .5pt;mso-border-top-themecolor:text1;
  mso-border-left-alt:solid black .5pt;mso-border-left-themecolor:text1;
  mso-border-alt:solid black .5pt;mso-border-themecolor:text1;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>HARI/TANGGAL</p>
  </td>
  <td width=143 valign=top style='width:107.3pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:text1;
  border-right:solid black 1.0pt;mso-border-right-themecolor:text1;mso-border-top-alt:
  solid black .5pt;mso-border-top-themecolor:text1;mso-border-left-alt:solid black .5pt;
  mso-border-left-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>TEMPAT</p>
  </td>
  <td width=231 valign=top style='width:173.45pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:text1;
  border-right:solid black 1.0pt;mso-border-right-themecolor:text1;mso-border-top-alt:
  solid black .5pt;mso-border-top-themecolor:text1;mso-border-left-alt:solid black .5pt;
  mso-border-left-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>AGENDA</p>
  </td>
 </tr>

<?php
}
?>

 <tr style='mso-yfti-irow:3;height:6.75pt'>
  <td width=35 rowspan=2 valign=top style='width:26.6pt;border:solid black 1.0pt;
  mso-border-themecolor:text1;border-top:none;mso-border-top-alt:solid black .5pt;
  mso-border-top-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0cm 5.4pt 0cm 5.4pt;height:6.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><?php echo $n; ?></p>
  </td>
  <td width=229 colspan=5 valign=top style='width:171.45pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:
  text1;border-right:solid black 1.0pt;mso-border-right-themecolor:text1;
  mso-border-top-alt:solid black .5pt;mso-border-top-themecolor:text1;
  mso-border-left-alt:solid black .5pt;mso-border-left-themecolor:text1;
  mso-border-alt:solid black .5pt;mso-border-themecolor:text1;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><?php 

$namahari = date("l", strtotime($row[4]));
$namahari2 = date("l", strtotime($row[5]));

if ($namahari == "Sunday") $namahari = "Minggu";
else if ($namahari == "Monday") $namahari = "Senin";
else if ($namahari == "Tuesday") $namahari = "Selasa";
else if ($namahari == "Wednesday") $namahari = "Rabu";
else if ($namahari == "Thursday") $namahari = "Kamis";
else if ($namahari == "Friday") $namahari = "Jum'at";
else if ($namahari == "Saturday") $namahari = "Sabtu";

if ($namahari2 == "Sunday") $namahari2 = "Minggu";
else if ($namahari2 == "Monday") $namahari2 = "Senin";
else if ($namahari2 == "Tuesday") $namahari2 = "Selasa";
else if ($namahari2 == "Wednesday") $namahari2 = "Rabu";
else if ($namahari2 == "Thursday") $namahari2 = "Kamis";
else if ($namahari2 == "Friday") $namahari2 = "Jum'at";
else if ($namahari2 == "Saturday") $namahari2 = "Sabtu";


//Waktu (Hari/Tgl)
echo "<b>".$namahari."</b> (".date("d-M",strtotime($row[4])).")"; 

// Tgl Selesai
if (date(strtotime($row[5]))>date(strtotime($row[4]))) {

echo " s/d <b>".$namahari2. " </b>( ".date("d-M",strtotime($row[5])).")"; }

?>
</p>
  </td>
  <td width=143 rowspan=2 valign=top style='width:107.3pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:
  text1;border-right:solid black 1.0pt;mso-border-right-themecolor:text1;
  mso-border-top-alt:solid black .5pt;mso-border-top-themecolor:text1;
  mso-border-left-alt:solid black .5pt;mso-border-left-themecolor:text1;
  mso-border-alt:solid black .5pt;mso-border-themecolor:text1;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><?php 

//tempat
   echo "<b>".$row[8]; ?></b></p>
  </td>
  <td width=231 rowspan=2 valign=top style='width:173.45pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:
  text1;border-right:solid black 1.0pt;mso-border-right-themecolor:text1;
  mso-border-top-alt:solid black .5pt;mso-border-top-themecolor:text1;
  mso-border-left-alt:solid black .5pt;mso-border-left-themecolor:text1;
  mso-border-alt:solid black .5pt;mso-border-themecolor:text1;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><?php 
//Agenda
echo "<b>".$row[3]; ?></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;mso-yfti-lastrow:yes;height:6.75pt'>
  <td width=58 valign=top style='width:43.6pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:text1;
  border-right:solid black 1.0pt;mso-border-right-themecolor:text1;mso-border-top-alt:
  solid black .5pt;mso-border-top-themecolor:text1;mso-border-left-alt:solid black .5pt;
  mso-border-left-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0cm 5.4pt 0cm 5.4pt;height:6.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'>
Jam
  </td>
  <td width=58 colspan=2 valign=top style='width:43.6pt;border-top:none;
  border-left:none;border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:
  text1;border-right:solid black 1.0pt;mso-border-right-themecolor:text1;
  mso-border-top-alt:solid black .5pt;mso-border-top-themecolor:text1;
  mso-border-left-alt:solid black .5pt;mso-border-left-themecolor:text1;
  mso-border-alt:solid black .5pt;mso-border-themecolor:text1;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><?php 
//Jam mulai
echo "<b>".$row[6]; ?></b></p>
  </td>
  <td width=58 valign=top style='width:43.6pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:text1;
  border-right:solid black 1.0pt;mso-border-right-themecolor:text1;mso-border-top-alt:
  solid black .5pt;mso-border-top-themecolor:text1;mso-border-left-alt:solid black .5pt;
  mso-border-left-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0cm 5.4pt 0cm 5.4pt;height:6.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'> 
s/d</p>
  </td>
  <td width=54 valign=top style='width:40.65pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;mso-border-bottom-themecolor:text1;
  border-right:solid black 1.0pt;mso-border-right-themecolor:text1;mso-border-top-alt:
  solid black .5pt;mso-border-top-themecolor:text1;mso-border-left-alt:solid black .5pt;
  mso-border-left-themecolor:text1;mso-border-alt:solid black .5pt;mso-border-themecolor:
  text1;padding:0cm 5.4pt 0cm 5.4pt;height:6.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><?php echo $row[7]; ?></p>
  </td>
 </tr>
<?php

}

mysql_free_result($x);

?>

 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=35 style='border:none'></td>
  <td width=66 style='border:none'></td>
  <td width=42 style='border:none'></td>
  <td width=25 style='border:none'></td>
  <td width=66 style='border:none'></td>
  <td width=62 style='border:none'></td>
  <td width=143 style='border:none'></td>
  <td width=231 style='border:none'></td>
 </tr>
 <![endif]>
</table>
</body>
</html>