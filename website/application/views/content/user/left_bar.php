<div id="cA">
        <div class="Ctopleft"></div>
        <h3>PENCARIAN</h3>
        <div id="search">
            <input type="text" id="cari" class="search"><input style="margin-left:5px" type="submit" id="submit-cari" class="submit button-red" value="cari" title="Cari" />
        </div><!-- search -->
        <p>&nbsp;</p>
        <?php
        echo $sub_menu;
        
        echo $this->load->view("content/user/sub_menu/menu_link");
        
        // echo $this->load->view("content/user/sub_menu/menu_timeline");
        ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#submit-cari").click(function(){
            if($("#cari").val() != ""){
                window.location.href = "<?php echo base_url()?>berita/cari/"+$("#cari").val();
            }
        })
    })
</script>
