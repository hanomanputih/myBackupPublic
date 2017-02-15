    <section id="main" class="column">
        <h4 <?php echo $class?>><?php echo $pesan?></h4>
    <article class="module width_3_quarter">
        <header><h3>Tambah Repositori Materi</h3></header>
        <?php echo form_open_multipart(base_url()."superadmin/repositori/upload")?>
        <div class="with-padding">
            <fieldset>
                <label>Nama File</label>
                <input type="text" name="nama-repo"/>
                <input type="hidden" name="kategori-repo" value="materi">
            </fieldset>
            <input type="file" name="userfile"/><br/>
            <small>Format file yang diizinkan hanya JPG, JPEG, PNG, zip, doc, docx, xl, xls, xlsx, pdf</small>
        </div>
        <div class="with-padding">
            <input type="submit" name="submit-repo" id="submit-repo" class="alt_btn" value="Tambah" title="tambah"/>
            <input type="submit" name="submit-batal" id="submit-batal" value="Batal" title="Batal"/>
        </div>
        <?php
        echo form_close();
        ?>
        <footer>
            <div class="submit_link left-float">
                <input type="submit" id="list-repositori" value="List Repositori"/>
            </div>
        </footer>
    </article>
</section>

<script type="text/javascript">
    $(document).ready(function(){
       $("#list-repositori").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/repositori";
       });
    });
</script>