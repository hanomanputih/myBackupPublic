<div id="cB1">
	<h3><a href="<?php echo base_url().uri_String()?>"><?php echo uri_string()?></a></h3>
	<div class="main-content">
            <div id="info"></div>
		<div class="news">
            <h4 class="title">Kritik dan Saran</h4>
                <table cellspacing="5">
                    <tr>
                        <td>NIM</td><td> : </td><td><input type="text" name="nim" id="nim" class="input"></td>
                    </tr>
                    <tr>
                        <td>Pesan</td><td> : </td><td><textarea name="pesan" id="pesan" class="input" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td/><td/><td><input type="submit" name="kirim" id="kirim" class="submit button-blue" value="kirim"></td>
                    </tr>
                </table>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#kirim").click(function(){
            var nim = $("#nim");
            var pesan = $("#pesan");
            displayMessage('alert_warning',"harap tunggu .. ");
            $.post("<?php echo base_url()?>saran/proses",
            {
                "nim":nim.val(),
                "pesan":pesan.val()
            },
            function(data){
                if(data.status == true){
                    displayMessage("alert_success",data.msg+". terima kasih atas saran dan kritiknya.");
                    nim.val('');
                    pesan.val('');
                }
                else{
                    displayMessage("alert_error",data.msg);
                }
            },"json");
        })
    })
</script>