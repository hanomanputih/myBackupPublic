<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Tambah Nilai</h3></header>
        <div class="with-padding">
            <table cellspacing="10" width="400px">
                <tbody>
                    <tr>
                        <td>NIM</td><td><input type="text" class="input full" id="nim-praktikan"/></td>
                    </tr>
                    <tr>
                        <td>Tahun Ajaran</td>
                        <td>
                            <select id="ta-praktikan" class="select">
                                <option value="">-pilih-</option>
                                <?php
                                if($ta)
                                {
                                    foreach($ta as $result)
                                    {
                                        ?>
                                        <option value="<?php echo $result["ta_id"]?>"><?php echo $result["ta_nama"]?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="">-pilih-</option>
                                    <?php
                                }
                                ?>
                            </select>
                        <td>
                    </tr>
                    <tr>
                        <td>Nilai</td>
                        <td>
                            <select id="nilai-praktikan" class="select">
                                <option value="">-pilih-</option>
                                <?php
                                $nilai = array("A","A-","A/B","B+","B","B-","B/C","C+","C","C-","C/D","D+","D","D-","D/E","E+","E");
                                foreach($nilai as $result=>$val){
                                    ?>
                                    <option value="<?php echo $val?>"><?php echo $val?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select id="status-praktikan" class="select">
                                <option value="">-pilih-</option>
                                <option value="ok">OK</option>
                                <option value="pending">PENDING</option>
                                <option value="gugur">GUGUR</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Keterangan</td><td><textarea id="keterangan-praktikan"></textarea></td>
                    </tr>
                    <tr>
                        <td/>
                        <td>
                            <input type="submit" value="Tambah" id="tambah" class="alt_btn"/>
                            <input type="submit" value="Batal" id="batal"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <footer>
            <div class="submit_link left-float">
                <input type="submit" id="list-nilai" value="List Nilai"/>
            </div>
        </footer>
    </article>
    <?php $this->load->view("content/sadmin/nilai/right_side");?>
    <div class="spacer"></div>
</section>
<script type="text/javascript">
$(document).ready(function(){
    $("#list-nilai").click(function(){
        window.location.href = "<?php echo base_url()?>superadmin/pbo/nilai";
    })

    $("#tambah").click(function(){
        displayLoading("Harap tunggu ...");
        $.ajax("<?php echo base_url()?>superadmin/pbo/proses_tambah_nilai",{
            data : {
                nim : $("#nim-praktikan").val(),
                ta : $("$ta-praktikan").val(),
                nilai : $("#nilai-praktikan").val(),
                status : $("#status-praktikan").val(),
                keterangan : $("#keterangan-praktikan").val(),
            },
            type : "POST",
            dataType : "JSON",
            success : function(data){
                if(data.berhasil == 1){
                    displayMessage("alert_success","Data nilai berhasil ditambahkan");
                }
            },
            error : function(){
                displayMessage("alert_error","Maaf, terjadi kesalahan pada server kami");
            }
        })
    })
})
</script>

