<?php
session_start();
$user = $_SESSION["username"];

if ($user != null) {

    include 'koneksi.php';

    $query = "select * from studio";
    
    $sql = ociparse($koneksi,$query);
    ociexecute($sql);
    ?>
<h3 align="center">MANAGE</h3>
<table border="1px" align="center" style="text-align: center">
    <tr style="text-transform: uppercase; background-color: black; color: white">
            <td>Studio Name</td>
            <td>Info</td>
            <td>Location</td>
            <td>Address</td>
            <td>Contact Person</td>
            <td>Manage</td>
        </tr>

        <?php while (ocifetchinto($sql, $data,OCI_ASSOC)) { ?>
            <tr>
                <td><?php echo $data['NAMA'] ?></td>
                <td><?php echo $data['INFO'] ?></td>
                <td><?php echo $data['LOKASI'] ?></td>
                <td><?php echo $data['ALAMAT'] ?></td>
                <td><?php echo $data['CP'] ?></td>
                
                <td> <a style="color: black" href="edit.php ?id=<?php echo $data['IDSTUDIO'];?>">Edit</a> <br/> <a style="color: red" href="hapus.php ?id= <?php echo $data['IDSTUDIO'];?>">Delete</a></td></tr>
        
        <?php
    } echo "</table>";
} else {
    echo "<meta http-equiv=refresh content=0;url=index.php>";
}
?>
