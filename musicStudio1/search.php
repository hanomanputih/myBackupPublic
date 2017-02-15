<html>
    <head>
         <script type="text/javascript">
            function showStudio(str)
            {
                if (str=="")
                {
                    document.getElementById("txtHint").innerHTML="";
                    return;
                } 
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","getStudio.php?q="+str,true);
                xmlhttp.send();
            }
            function showStudio1(str)
            {
                if (str=="")
                {
                    document.getElementById("txtHint").innerHTML="";
                    return;
                } 
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","getStudio.php?a="+str,true);
                xmlhttp.send();
            }
        </script>
    </head>
    <body>
        <div id="label">
            <form onsubmit="dontEnter()">
                <table>
                    <tr>
                        <td>Studio Name</td>
                        <td>:</td>
                        <td><input type="text" id="namastudio" name="namastudio" value="" onchange="showStudio1(this.value)"/></td>
                        <td></td>
                        <td>Location</td>
                        <td>:</td>
                        <td>
                            <select id="lokasi" name="lokasi" onchange="showStudio(this.value)">
                                <option value=""> </option>
                                <option value="yogyakarta">Yogyakarta</option>
                                <option value="sleman">Sleman</option>
                                <option value="bantul">Bantul</option>
                            </select>
                            
                        </td>
                    </tr>
                </table>
            </form>
             <br />
            
            <h3>STUDIO :</h3>
<div id="txtHint"><b></b></div>
    </div>
</body>
</html>