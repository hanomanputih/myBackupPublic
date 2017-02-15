<!DOCTYPE html>
<?php
@session_start();
$user = $_SESSION["username"];

if ($user != null) {
    ?>
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
                if (($_GET["cat"] == "home") or (!isset($_GET["cat"]))) {
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
                }
                ?>

            </div>
                       <div id="kanan"> <br/>
          <?php echo "Welcome " . $username ;?>
                           <br/>Be Carefull when UPDATE or EDIT<br/>Thank you . .
               </div>

            <div style="clear:both"></div>
            
        </div>
<div id="footer">Copyright@ Vandezi 2012</div>

    </body>

</html>
<?php
} else {
    echo "<meta http-equiv=refresh content=0;url=index.php>";
}
?>
