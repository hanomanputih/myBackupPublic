    <section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Data Praktikan Responsi</h3></header>
        <div class="with-padding">
            <h3>Kelompok <?php echo $this->uri->segment(6)?></h3>
            <table cellspacing="10" width="600px" border="0">
                <tbody>
                    
                        <?php
                        if($dataResponsi)
                        {
                            $no = 1;
                            foreach($dataResponsi as $result)
                            {
                                ?>
                                <input type="hidden" id="id-responsi" value="<?php echo $result["responsi_id"]?>"/>
                                <tr>
                                    <td width="75px">NIM <?php echo $no?></td>
                                    <td align="center">
                                        <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" id="nim<?php echo $no?>" class="edit" title="Edit" value="<?php echo $result["praktikan_responsi_id"]?>">
                                        <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" id="nim<?php echo $no?>" class="hapus" title="Hapus" value="<?php echo $result["praktikan_responsi_id"]?>">
                                    </td>
                                    <td width="200px">
                                        <input type="text" class="nim readonly" id="nim<?php echo $no?>" readonly value="<?php echo $result["praktikan_nim"]?>" placeholder="NIM <?php echo $no?>">
                                    </td>
                                    <td><span id="nim<?php echo $no?>"><?php echo $result["praktikan_nama"]?></span></td>
                                </tr>
                                
                                <?php
                                $no++;
                            }   
                                if($no == 2)
                                {
                                    for($i = ($no); $i<=3; $i++)
                                    {
                                        ?>
                                        <tr>
                                            <td width="75px">NIM <?php echo $i?></td>
                                            <td align="center">
                                                <input type="image" src="<?php echo base_url()?>public/images/icn_add_user.png" id="nim<?php echo $i?>" class="add" title="Tambah praktikan" value="<?php echo $result["praktikan_responsi_id"]?>">
                                            </td>
                                            <td width="200px">
                                                <input type="text" class="add_nim" id="nim<?php echo $i?>" placeholder="NIM <?php echo $i?>">
                                            </td>
                                            <td><span id="nim<?php echo $i?>"></span></td>
                                        </tr>
                                    <?php
                                    }
                                }
                                if($no == 3)
                                {
                                    for($i = ($no); $i<=3; $i++)
                                    {
                                        ?>
                                        <tr>
                                            <td width="75px">NIM <?php echo $i?></td>
                                            <td align="center">
                                                <input type="image" src="<?php echo base_url()?>public/images/icn_add_user.png" id="nim<?php echo $i?>" class="add" title="Tambah praktikan" value="<?php echo $result["praktikan_responsi_id"]?>">
                                            </td>
                                            <td width="200px">
                                                <input type="text" class="add_nim" id="nim<?php echo $i?>" placeholder="NIM <?php echo $i?>">
                                            </td>
                                            <td><span id="nim<?php echo $i?>"></span></td>
                                        </tr>
                                    <?php
                                    }
                                }
                        }
                        ?>
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
        var no = 0;
    $("input.hapus").each(function(){
        no++
    });
    if(no == 1){
        $("input.hapus").remove();
    }


       $("#list-kelas").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/kcb/responsi/praktikan";
       });

       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kcb/responsi/praktikan"; 
       });

       $(".edit").click(function(){
        var id = $(this).attr("id");
        $("input#"+id).removeAttr("readonly");
        $("input#"+id).removeClass("readonly");
       });

       $(".add").click(function(){
        var id = $(this).attr("id");
        var nim = $("input.add_nim#"+id).val();
        displayLoading("Harap tunggu ...");
        $.post("<?php echo base_url()?>superadmin/kcb/addPraktikan",
            {"nim":nim,"id":$("#id-responsi").val()},
            function(data){
                var message ="";
                if(data.stats == "success"){
                    message = data.praktikan_nama;
                    displayMessage("alert_success","Data berhasil ditambahkan");
                    $("input.nim#"+id).attr("readonly");
                    $("input.nim#"+id).addClass("readonly");
                    window.location.reload();
                }else if(data.stats == "avail"){
                    displayMessage("alert_error","NIM "+nim+" sudah terdaftar di kelompok "+data.responsi_id);
                    message = data.praktikan_nama;
                }else if(data.stats == "kosong"){
                    displayMessage("alert_error","Kolom NIM tidak boleh kosong");
                }else if(data.stats == "not-number"){
                    displayMessage("alert_error","Kolom NIM harus angka");
                }else{
                    displayMessage("alert_error","NIM "+nim+" tidak terdaftar dalam sistem");
                }
                $("span#"+id).html(message);
            },"json");
       });

       $(".hapus").click(function(){
        var id = $(this).attr("id");
        var id_praktikan = $(".hapus#"+id).val();
        var conf = window.confirm("Apakah Anda ingin menghapus data praktikan responsi ini?");
        if(conf){
            $.post("<?php echo base_url()?>superadmin/kcb/deleteDataResponsi",
                {"id":id_praktikan},
                function(data){
                    if(data.stats){
                        window.alert("Praktikan berhasil dihapus");
                        window.location.reload();
                    }else{
                        window.alert("Praktikan gagal dihapus");
                    }
                },"json")
        }
       })

       $(".nim").blur(function(){
        var id = $(this).attr("id");
        var id_responsi = $(".edit#"+id).val();
        var nim = $(".nim#"+id).val();
        $.post("<?php echo base_url()?>superadmin/kcb/getDataPraktikan",
            {"nim":nim,"id":id_responsi},
            function(data){
                displayLoading("Harap tunggu ...");
                var message = "";
                if(data.stats == "success"){
                    message = data.praktikan_nama;
                    displayMessage("alert_success","Data berhasil diubah");
                    $("input.nim#"+id).attr("readonly");
                    $("input.nim#"+id).addClass("readonly");
                    window.location.reload();
                }else if(data.stats == "avail"){
                    displayMessage("alert_error","NIM "+nim+" sudah terdaftar di kelompok "+data.responsi_id);
                    message = data.praktikan_nama;
                }else if(data.stats == "kosong"){
                    displayMessage("alert_error","Kolom NIM tidak boleh kosong");
                }else if(data.stats == "not-number"){
                    displayMessage("alert_error","Kolom NIM harus angka");
                }else{
                    displayMessage("alert_error","NIM "+nim+" tidak terdaftar dalam sistem");
                }
                $("span#"+id).html(message);
            },"json")
       });
       
    });
</script>