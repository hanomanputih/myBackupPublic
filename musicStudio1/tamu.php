<html>
    <head>
    </head>
    <body>
        <h3 align="center">GUEST BOOK</h3>
        <form method="get" action="proses_tamu.php">
            <table>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><input type="text" name="nama"/></td>
                </tr>
                 <tr>
                    <td>E-mail</td>
                    <td>:</td>
                    <td><input type="text" name="email"/></td>
                </tr>
                <tr>
                    <td>Comment</td>
                    <td>:</td>
                    <td><textarea name="komentar" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="Submit" onsubmit="alert('Thank you for your submission')"/><input type="reset" value="Reset"/></td>
                </tr>
            </table>
            
        </form>
    </body>
</html>
