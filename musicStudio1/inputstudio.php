<?php
session_start();
$user = $_SESSION["username"];

if ($user != NULL) {?>
    
<form method="post" action="input_studio.php" enctype="multipart/form-data">
        <h3 align="center">ADD STUDIO</h3>
    <table align="center">
        <tr>
            <td>Studio Name</td>
            <td>: <input type="text" name="nama"></td>
        </tr>
        <tr>
            <td>Info</td>
            <td>: <textarea name="info"></textarea></td>
        </tr>
        <tr>
            <td>Location</td>
            <td>: <select name="lokasi">
                    <option value=""></option>
                    <option value="yogyakarta">Yogyakarta</option>
                    <option value="sleman">Sleman</option>
                    <option value="bantul">Bantul</option>
                </select></td>
        </tr>
        <tr>
            <td>Address</td>
            <td>: <textarea name="alamat"></textarea></td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td>: <input type="text" name="cp"></td>
        </tr>
        <tr>
            <td>Upload Picture</td>
            <td>: <input type ="file" name="gambar"/></td>
        </tr>
        <tr>
            <td></td>
            <td> <input type="submit" name="Simpan"> <input type="reset" name="Reset"></td>
        </tr>

    </table>

</form> 
        <?php
} else {
    echo "<meta http-equiv=refresh content=0;url=index.php>";
}
?>
