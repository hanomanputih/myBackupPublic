    <section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Jadwal Responsi</h3></header>
        <div class="with-padding">
            <table cellspacing="10" width="500px" border="0">
            	<input type="hidden" id="id-responsi" value="<?php echo $responsi["responsi_id"]?>"/>
                <tbody>
                    <tr>
                        <td>Tanggal</td>
                        <td>
                            <select class="select" id="tanggal-responsi">
                            	<?php
                            	$tanggal = substr($responsi["responsi_tanggal"],8,2);
                            	
                                for($i=1;$i<=31;$i++)
                                {
                                    if($i < 10)
                                    {
                                        $i = "0".$i;
                                    }
                                    if($tanggal == $i)
                                	{
                                		?>
                                		<option selected value="<?php echo $tanggal?>"><?php echo $tanggal?></option>
                                		<?php
                                		continue;
                                	}
                                    ?>
                                    <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select class="select" id="bulan-responsi">
                                <?php
                                $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                $bln = substr($responsi["responsi_tanggal"], 5,2);
                                for($i=1;$i<=12;$i++)
                                {
                                    if($i < 10)
                                    {
                                        $i = "0".$i;
                                    }
                                    if($bln == $i)
                                    {
                                    	?>
                                    	<option selected value="<?php echo $bln?>"><?php echo $bulan[$i-1]?></option>
                                    	<?php
                                    	continue;
                                    }
                                    ?>
                                    <option value="<?php echo $i?>"><?php echo $bulan[$i-1]?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select class="select" id="tahun-responsi">
                                <?php
                                $tahun = substr($responsi["responsi_tanggal"], 0,4);
                                for($i=12;$i<=20;$i++)
                                {
                                	if($tahun == "20".$i)
                                	{
                                		?>
                                		<option selected value="<?php echo $tahun?>"><?php echo $tahun?></option>
                                		<?php
                                		continue;
                                	}
                                    ?>
                                		<option value="20<?php echo $i?>">20<?php echo $i?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jam</td><td><input type="text" class="input full" id="jam-responsi" placeholder="xx:xx-xx:xx" value="<?php echo $responsi["responsi_jam"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td><td><input type="text" class="input full" id="ruang-responsi" placeholder="Ruang responsi" value="<?php echo $responsi["responsi_ruang"]?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Simpan" id="simpan" class="alt_btn"/>
                            <input type="submit" value="Batal" id="batal"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <footer>
            <div class="submit_link left-float">
                <input type="submit" id="list-kelas" value="List Daftar Responsi"/>
            </div>
        </footer>
    </article>
</section>

<script type="text/javascript">
    $(document).ready(function(){
       $("#list-kelas").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/kcb/responsi";
       });
       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kcb/responsi"; 
       });
       
       $("#simpan").click(function(){
            displayLoading("Harap tunggu ...");

          $.post(
                "<?php echo base_url()?>superadmin/kcb/proses_edit_responsi",
                {"id_responsi":$("#id-responsi").val(),"tanggal_responsi":$("#tanggal-responsi").val(),"bulan_responsi":$("#bulan-responsi").val(),"tahun_responsi":$("#tahun-responsi").val(),"jam_responsi":$("#jam-responsi").val(),"ruang_responsi":$("#ruang-responsi").val()},
                function(data){
                    if(data == 1){
                        displayMessage("alert_success","Jadwal responsi berhasil diubah");
                    }else if(data == "duplikat"){
                        displayMessage("alert_error","Data sudah tersedia");
                    }else if(data == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else{
                        displayMessage("alert_error","Jadwal responsi gagal diubah");
                    }
                }
            ) 
       });
    });
</script>