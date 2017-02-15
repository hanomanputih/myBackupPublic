<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        
        <h2 align="center">METODE K-NEAREST NEIGHBOR</h2>
       
        <?php
        include 'koneksi.php';
        include 'tampilDataTraining.php';
        
        ?>
         <p align="center"><b>Keterangan Kelas:</b>
        </br>
        1 = BAIK</br>
        2 = BURUK</br>
        <b>Keterangan Variabel: </b></br>
        Variabel 1 = Kenaikan derajat keasaman (%)</br>
        Variabel 2 = Penyusutan Volume (%)
        </p>
        <h4 align="center">Tambah Data Training</h4>
        <form method="post" action="tambah_ts.php" enctype="multipart/form-data">
            <table align="center">
                <tr>
                    <td>Nilai Atribut 1</td>
                    <td>: <input type="text" name="atribut1"></td>
                </tr>
                <tr>
                    <td>Nilai Atribut 2</td>
                    <td>: <input type="text" name="atribut2"></td>
                </tr>
                <tr>
                    <td>Class</td>
                    <td>: <input type="text" name="class"/></td>
                </tr>

            </table>

            </br><center><input type="reset" value="Reset"><input type="submit" value="Tambah"></center>
        </form>
        </br>
        <hr>
<center><h3>INPUT DATA UJI</h3></center>
        <form method="post" action="hitungKNN.php" enctype="multipart/form-data">
          <center>  Atribut 1 </br><input type="text" name="atribut1"/><br/>
            Atribut 2 </br><input type="text" name="atribut2"/><br/>
            Nilai K </br> <input type="text" name="k"></br></br>
            <input type="submit" value="Hitung">
            </center>
        </form>
</br>
<hr>
<center><h3>Hasil Perhitungan</h3></center>
<?php include 'tampilHitung.php';?>
<hr>
<footer align="center" style="font-weight: bold">copyright © Ivan Adhi Prasetya™</footer>
    </body>
</html>
