<script type="text/javascript" src="<?php echo base_url()?>public/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
theme : "advanced",
elements : "isi",
mode : "textareas",
// plugins : "advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,autoresize",
plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,
// theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,",
// theme_advanced_buttons2 : "",
// theme_advanced_resizing : true

});


</script>

<script type="text/javascript">
$(document).ready(function(){
   $("#gambar").hide(); 
   $("#show").css("cursor", "pointer");
   
   $("#show").click(function(){
       $("#show").slideUp(300,
        function(){$("#gambar").slideDown(300)
        })
   })
});
</script>
<section id="main" class="column">
            <h4 <?php echo $class?>><?php echo $pesan?></h4>
		<article class="module width_full">
			<header><h3>Edit Berita</h3></header>
                            <?php
                            echo form_open_multipart(base_url()."superadmin/berita/edit/".$berita["berita_id"]."/proses");
                            ?>
				<div class="module_content">
					<fieldset>
                                            <label>Praktikum</label>
                                            <input type="hidden" name="id-berita" value="<?php echo $berita["berita_id"]?>">
                                            <select name="praktikum">
                                                <?php
                                                    switch ($berita["berita_praktikum"]) {
                                                        case "PBO":
                                                            $pilihan = "KSC";
                                                            break;
                                                        case "KSC":
                                                            $pilihan = "PBO";
                                                        default:
                                                            $pilihan = "tidak ada";
                                                            break;
                                                    }
                                                ?>
                                                <option selected="<?php echo $berita["berita_praktikum"]?>"><?php echo $berita["berita_praktikum"]?></option>
                                                <option value="<?php echo $pilihan?>"><?php echo $pilihan?></option>
                                            </select>
                                        </fieldset>
                                        <fieldset>
                                            <label>Kategori</label>
                                            <select name="kategori">
                                                <?php
                                                    switch ($berita["berita_kategori"]) {
                                                        case "pengumuman":
                                                            $pilihan = "agenda";
                                                            break;
                                                        case "agenda":
                                                            $pilihan = "pengumuman";
                                                            break;
                                                        default:
                                                            $pilihan = "tidak ada";
                                                            break;
                                                    }
                                                ?>
                                                <option selected="<?php echo $berita["berita_kategori"]?>"><?php echo $berita["berita_kategori"]?></option>
                                                <option value="<?php echo $pilihan?>"><?php echo $pilihan?></option>
                                            </select>
                                        </fieldset>
					<fieldset>
                                            <label>Judul Berita</label>
                                            <input name="judul" type="text" value="<?php echo $berita["berita_judul"]?>"/>
                                        </fieldset>
                                        <fieldset class="wisiwig">
                                            <label>Isi Berita</label>
                                            <textarea name="isi"><?php echo $berita["berita_isi"]?></textarea>
                                        </fieldset>
                                        <label id="show"><a>Klik disini jika ingin mengubah gambar</a></label>
                                        <div id="gambar">
                                        <fieldset>
                                            <label>Judul File</label>
                                            <input name="judul-file" type="text" value="<?php echo $berita["berita_judul_file"]?>"/>
                                        </fieldset>
                                        <input name="userfile" type="file" value="<?php echo $berita["berita_file"]?>"/><br/>
                                        <small>Format file yang diizinkan hanya JPG, JPEG, PNG, pdf, doc, docx, xl, xls, xlxs</small>
                                        </div>
				</div>
                        <footer>
                            <div class="submit_link">
                                <input name="tambah" type="submit" value="Simpan" class="alt_btn"/>
                                <input name="batal" type="submit" value="Batal"/>
                            </div>
                        </footer>
                        <?php
                        echo form_close();
                        ?>
		</article><!-- end of styles article -->
		<div class="spacer"></div>
	</section>