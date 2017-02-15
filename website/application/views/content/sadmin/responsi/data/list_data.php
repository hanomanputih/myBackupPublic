<section id="main" class="column">
    <article class="module width_full">
        <header><h3>Data Responsi KCB</h3><span>Jadwal aktif : <?php echo $jumlah?> dari <?php echo $total?></span></header>
        <?php
            $url = $this->uri->segment(5);
            ?>
            <div class="list-kelas">
                <span class="data-kelas">
                        <?php
                        $day = array("senin"=>"senin","selasa"=>"selasa","rabu"=>"rabu","kamis"=>"kamis","jumat"=>"jum'at","sabtu"=>"sabtu","minggu"=>"minggu");
                        foreach($day as $result=>$val)
                        {
                            if($url == $result)
                            {
                                $class = "class='active'";
                            }
                            else
                            {
                                $class = "";
                            }   
                            ?>
                            <a <?php echo $class?> href="<?php echo base_url()?>superadmin/kcb/responsi/praktikan/<?php echo $result?>"><?php echo $val?></a>&nbsp;&nbsp;|
                            <?php
                        }
                        if($url == "belum-daftar")
                        {
                            $class = "class = 'active'";
                        }
                        else
                        {
                            $class = "class = 'no-data'";
                        }
                        ?>
                        <a <?php echo $class?> href="<?php echo base_url()?>superadmin/kcb/responsi/praktikan/belum-daftar">Belum daftar</a> |
                </span>
            </div>
        <table class="tablesorter" cellspacing="0">
            <thead>
                <tr>
                    <th align="center">No</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Kelompok</th>
                    <th align="center">Pilih</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Ruang</th>
                    <th align="center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($responsi)
                {
                    $no = 1;
                    foreach($responsi as $result)
                    {
                        ?>
                        <tr>
                            <td align="center"><?php echo $no?></td>
                            <td><?php echo $result["responsi_hari"]?></td>
                            <td><?php echo date("d-M-Y",human_to_unix($result["responsi_tanggal"]))?></td>
                            <td><?php echo $result["responsi_jam"]?></td>
                            <td>
                                <?php
                                if($result["responsi_kelompok"] == 0)
                                {
                                    echo "-";
                                }
                                else
                                {
                                   echo "Kelompok ".$result["responsi_kelompok"];
                                }
                                ?>
                            </td>
                            <td align="center">
                                <input name="pilih" href="#login-box" class="pilih login-window" <?php if($result["responsi_status"] == "ya"){echo "disabled";}?> <?php if($result["responsi_status_aktif"] == "non-aktif"){echo "disabled";}?> type="radio" value="<?php echo $result["responsi_id"]?>">
                            </td>
                            <td>
                                <?php
                                $data = $dataResponsi->getDataResponsiByJadwal($result["responsi_id"]);
                                if($data)
                                {
                                    foreach($data as $row)
                                    {
                                        echo $row["praktikan_nim"]."<br/>";
                                    }
                                }
                                else
                                {
                                    echo "-";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if($data)
                                {
                                    foreach($data as $row)
                                    {
                                        echo $row["praktikan_nama"]."<br/>";
                                    }
                                }
                                else
                                {
                                    echo "-";
                                }
                                ?>
                            </td>
                            <td><?php echo $result["responsi_ruang"]?></td>
                            <td align="center">
                                <?php
                                if($data)
                                {
                                    ?>
                                    <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" id="edit" onclick="edit(<?php echo $result["responsi_id"]?>)">
                                    <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" id="hapus" class="hapus" value="<?php echo $result["responsi_id"]?>">
                                    <?php
                                }
                                else
                                {
                                    echo "-";
                                }
                                ?>
                                
                            </td>
                        </tr>                   
                        <?php
                        $no++;
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="10" align="center" class="no-data">Tidak ada data jadwal responsi</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
         <div id="login-box" class="login-popup">
        <a href="#" class="close"><img src="<?php echo base_url()?>public/images/close_button.png" class="close_btn" title="Close Window" alt="Close" /></a>
            <div class="content">
                <h4></h4>
                <h3>Masukkan NIM Praktikan</h3>
                <input type="hidden" class="responsi">
                <input type="text" placeholder="NIM 1" class="nim" id="nim1">
                <input type="text" placeholder="NIM 2" class="nim" id="nim2">
                <input type="text" placeholder="NIM 3" class="nim" id="nim3">
                <input type="submit" class="alt_btn tambah-responsi" value="Tambah">
                <input type="submit" class="batal" value="Batal">
            </div>
        </div>
         <footer>
        </footer>
    </article>
    <div class="spacer"></div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        $(".detail").hide();

        $(".hapus").click(function(){
            var conf = window.confirm("Apakah Anda ingin menghapus praktikan ini?");
            if(conf){
                $.post("<?php echo base_url()?>superadmin/kcb/proses_hapus_data_responsi",
                    {"id":$(this).val()},
                    function(data){
                        if(data){
                            window.alert("Praktikan berhasil dihapus");
                            window.location.reload();
                        }else{
                            window.alert("Praktikan gagal dihapus");
                        }
                    })
            }
        })

        $(".tambah-responsi").click(function(){
            displayLoadingPopup("Harap tunggu ...");
           var nim = [$("input#nim1").val(),$("input#nim2").val(),$("input#nim3").val()];
                $.post("<?php echo base_url()?>superadmin/kcb/proses_tambah_data_responsi",
                {"responsi_id":$(".responsi").val(),"daftar_nim":nim},
                function(data){
                    if(data.valid == 1){
                        displayMessagePopup("green-alert","Jadwal berhasil disimpan");
                    }else if(data.valid == "not-number"){
                        displayMessagePopup("red-alert","NIM harus angka");
                    }else if(data.valid == "empty"){
                        displayMessagePopup("red-alert","NIM "+data.nim+" tidak terdaftar dalam sistem");
                    }else if(data.valid == "duplikat"){
                        displayMessagePopup("red-alert","NIM "+data.nim+" sudah terdaftar di kelompok "+data.kelas);
                    }else{
                        displayMessagePopup("red-alert","Jadwal gagal disimpan");
                    }
                },"json")
           
        });

        $('.pilih').click(function() {
            $(".responsi").val($(this).val());

            var loginBox = $(this).attr("href");

            $(loginBox).fadeIn(300);

            var popMargTop = ($(loginBox).height() + 24) / 2; 
            var popMargLeft = ($(loginBox).width() + 24) / 2; 
            
            $(loginBox).css({ 
                'margin-top' : -popMargTop,
                'margin-left' : -popMargLeft
            });
            

            $('body').append('<div id="mask"></div>');
            $('#mask').fadeIn(300);
        
        });
    
    $('a.close, #mask, .batal').live('click', function() { 
      $('#mask , .login-popup').fadeOut(300 , function() {
        $('#mask').remove();  
        clearPopup();
        window.location.reload();
    }); 
    return false;
    });
      
    })
    function edit(id){
        window.location.href="<?php echo base_url()?>superadmin/kcb/responsi/praktikan/edit/"+id;
    }
</script>