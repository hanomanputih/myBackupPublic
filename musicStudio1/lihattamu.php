<?php
session_start();
$user = $_SESSION["username"];

if ($user != null) {
    include 'koneksi.php';

    $query = "select * from tamu order by tanggal desc";
    $result = oci_parse($koneksi, $query);
    ociexecute($result);
    ?>
    <h3 align="center">VISITOR</h3>
    <table align="center" border="1px" style="text-align: center" >
        <tr style="background-color: black; color:white;">
            <td style="padding: 10px">NAME</td>
            <td style="padding: 10px">EMAIL</td>
            <td style="padding: 10px">COMMENT</td>
            <td style="padding: 10px">DATE</td>
            <td style="padding: 10px">MANAGE</td>
        </tr>

        <?php
        while (ocifetchinto($result, $data, OCI_ASSOC)) {
            ?>

            <tr>
                <td style="padding: 10px"><?php echo $data['NAMA'] ?></td>
                <td style="padding: 10px"><?php echo $data['EMAIL'] ?></td>
                <td style="padding: 10px"><?php echo $data['KOMENTAR'] ?></td>
                <td style="padding: 10px"><?php echo $data['TANGGAL'] ?></td>
                <td style="padding: 10px"><a style="color: red" href="hapuskomentar.php?id=<?php echo $data['IDTAMU'] ?>">DELETE</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} else {
    echo "<meta http-equiv=refresh content=0;url=index.php>";
}
?>