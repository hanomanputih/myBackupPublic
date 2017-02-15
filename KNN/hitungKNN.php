<?php

include 'koneksi.php';

$queryDelete = "delete from perhitungan";
$resultDelete = mysql_query($queryDelete);

$queryts = "select * from trainingSet order by no";
$resultts = mysql_query($queryts);
$k = $_POST['k'];
$at1 = $_POST['atribut1'];
$at2 = $_POST['atribut2'];
$atribut = array("$_POST[atribut1]", "$_POST[atribut2]");
$size = count($atribut);
//echo $size;

while ($datats = mysql_fetch_assoc($resultts)) {
//    echo $atribut[$i];  
//    $i++;
    $i = 0;
    $jumlah = 0;
//    echo '</br>' . $jumlah . '</br>';

//    $a = 3;
//    $class = 0;
    for ($i; $i < $size; $i++) {
        $selisih = ($datats[$i + 1]) - ($atribut[$i]);
        $pangkat = $selisih * $selisih;
        $jumlah = $jumlah + $pangkat;
//        echo 'data ' . (i + 1) . ' = ' . $data[$i + 1];
//        echo '</br>';
//        echo 'input' . $i . ' = ' . $atribut[$i] . '</br>';
//        echo 'pangkat = ' . $pangkat . '</br>';
//        echo 'selisih = ' . abs($selisih) . '</br>';
//        echo exp((6) * log(2)) . '</br>';
//         echo 'jumlah BBB= ' . $jumlah . '</br>';
    }
//    echo 'jumlah = ' . $jumlah . '</br>';
//    echo 'jarak ecluid = ' . sqrt($jumlah) . '</br>';
    $akhir = sqrt($jumlah);
//    $jumlah = $jumlah-$jumlah;
    $class = $datats['class'];
//    echo $class;
    $query1 = "INSERT INTO  `knn`.`perhitungan` (
`no` ,
`ecluidean` ,
`class`
)
VALUES (
NULL ,  '$akhir', '$class'
);";
    $result1 = mysql_query($query1);
}
//$c = exp(2 * log(3));
//echo $c;
//echo $atribut[0];
echo "<meta http-equiv=refresh content=0;url=index.php?k=$k&&at1=$at1&&at2=$at2>";
?>