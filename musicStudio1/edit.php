<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style1.css"/>
        <link href='http://fonts.googleapis.com/css?family=Shojumaru' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Allura' rel='stylesheet' type='text/css'>
        <title></title>
    </head>
    <body>
        <div id="wrapper">
            <div style="float: left ; margin-left: 0px; margin-top: 100px; margin-right: 20px"><img src="images/VANDEZI.png" width="250px" height="500px"></div>
           <div id="header" style="font-family: 'Shojumaru', cursive;">Vandezi<br/></div>
            <div id="subheader" style="font-family: 'Allura', cursive; font-size: 30px"> Music Studio Information</div>
            <h4>            
                <?php
                @session_start();
                include 'koneksi.php';

                $username = $_SESSION["username"];
                ?>
            </h4>
            <h1 style="text-align: center"></h1>
           <div id="menu" style="float: left ; margin-bottom: 20px" >
                <ul>
                  <li><a href="?cat=home">HOME</a> </li> 
                    <li><a href="?cat=search">SEARCH</a></li>
                    <li><a href="?cat=kelola">MANAGE</a></li>
                    <li><a href="?cat=input">ADD STUDIO</a></li>
                    <li><a href="?cat=lihattamu">VISITOR</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                </ul>
            </div>
            <br/>

            <div id="kiri"> <?php
                if (($_GET["cat"] == "home")) {
                    include "home.php";
                } else if ($_GET["cat"] == "search") {
                    include "search.php";
                } else if ($_GET["cat"] == "kelola") {
                    include "kelola.php";
                } else if ($_GET["cat"] == "input") {
                    include "inputstudio.php";
                } else if ($_GET["cat"] == "edit") {
                    include "edit.php";
                }else if ($_GET["cat"] == "lihattamu") {
                    include "lihattamu.php";
                } else if (($_GET["cat"] == "edit") or (!isset($_GET["cat"]))) {

                    session_start();
                    include 'koneksi.php';
                    $user = $_SESSION["username"];
                    $id = $_GET['id'];
                    $query = "select * from studio where idstudio = '$id'";
                    $sql = oci_parse($koneksi, $query);
                    ociexecute($sql);
                    ocifetchinto($sql, $data, OCI_ASSOC);
                    ?> 
                    <form method="post" action="edit_studio.php" enctype="multipart/form-data">
                        <h2 align="center">EDIT</h2>
                        <table align="center">
                            <tr>
                                <td>ID Studio</td>
                                <td style="color: gray">:  <input style="color: gray"type="text" name="id" value="<?php echo $data['IDSTUDIO'] ?>" readonly="true">tidak untuk di edit</td>
                            </tr>
                            <tr>
                                <td>Nama Studio</td>
                                <td>: <input type="text" name="nama" value="<?php echo $data['NAMA'] ?>"></td>
                            </tr>
                            <tr>
                                <td>Info</td>
                                <td>: <textarea name="info"><?php echo $data['INFO'] ?></textarea></td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>: <select name="lokasi" spellcheck="<?php echo $data['LOKASI'] ?>">
                                        <option value="<?php echo $data['LOKASI'] ?>"><?php echo $data['LOKASI'] ?></option>
                                        <option value="yogyakarta">Yogyakarta</option>
                                        <option value="sleman">Sleman</option>
                                        <option value="bantul">Bantul</option>


                                    </select></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: <textarea name="alamat"><?php echo $data['ALAMAT'] ?></textarea></td>
                            </tr>
                            <tr>
                                <td>Contact Person</td>
                                <td>: <input type="text" name="cp" value="<?php echo $data['CP'] ?>"></td>
                            </tr
                            <tr>
                                <td>Ganti Foto</td>
                                <td>: <input type="file" name="foto"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><img src="image_studio/<?php echo $data['FOTO']; ?>" width="20%" height="20%">Foto Lama</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="Simpan"> <input type="reset" name="Reset"></td>
                            </tr>

                        </table>

                    </form> 
                    <?php
                }
                ?>

            </div>
            <div id="kanan"> <br/>
                <?php echo "Welcome " . $username; ?>
                <br/>Be Carefull when UPDATE or EDIT<br/>Thank you . .
            </div>

            <div style="clear:both"></div>
            
        </div>
<div id="footer">Copyright@ Vandezi 2012</div>

    </body>

</html>




