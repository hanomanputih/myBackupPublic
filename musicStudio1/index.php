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
        <div id="wrapper" >
            <div style="float: left ; margin-left: 0px; margin-top: 100px; margin-right: 20px"><img src="images/VANDEZI.png" width="250px" height="500px"></div>
            <div id="header" style="font-family: 'Shojumaru', cursive;">Vandezi<br/></div>
            <div id="subheader" style="font-family: 'Allura', cursive; font-size: 30px"> Music Studio Information</div>          
            <h1 style="text-align: center"></h1>
            <div id="menu" style="float: left ; margin-bottom: 20px; text-align: center" >
                <ul>
                    <li><a href="?cat=home">HOME</a> </li> 
                    <li><a href="?cat=search">SEARCH</a> </li>
                    <li><a href="?cat=contact">CONTACT</a></li>
                </ul>
            </div>

            <div id="kiri"> <?php
if (($_GET["cat"] == "home") or (!isset($_GET["cat"]))) {
    include "home.php";
} else if ($_GET["cat"] == "search") {
    include "search.php";
} else if ($_GET["cat"] == "contact") {
    include "contact.php";
}
?>
            </div>
            <div id="kanan"> <br/><?php include "tamu.php" ?> </div>

            <div style="clear:both"></div>

        </div>
        <div id="footer">Copyright @Vandezi 2012</div>

    </body>

</html>
