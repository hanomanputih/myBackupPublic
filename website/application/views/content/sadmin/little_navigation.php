<section id="secondary_bar">
        <div class="user">
                <p><?php echo $this->session->userdata("user_id");?></p>
                 <a class="logout_user" href="<?php echo base_url()?>superadmin/login/logout" title="Logout">Logout</a> 
        </div>
        <div class="breadcrumbs_container">
            <?php
            $url_1 = $this->uri->segment(2);
            $url_2 = $this->uri->segment(3);
            
            if($url_2)
            {
                $link = 'href="'.base_url().'superadmin/'.$url_1.'"';
                $class = 'class="title-case"';
            }
            else
            {
                $link = "";
                $class = 'class="current title-case"';
            }
            ?>
                <article class="breadcrumbs">
                    <a href="<?php echo base_url()?>superadmin/home">Dashboard</a>
                    <div class="breadcrumb_divider"></div>
                    <a <?php echo $link?> <?php echo $class?>>
                        <?php
                        if($url_1 != "home")
                        {
                            echo $url_1;
                        }
                        ?>
                    </a>
                    <?php
                    if(!empty($url_2))
                    {
                        ?>
                        <div class="breadcrumb_divider"></div>
                        <a class="current title-case">
                            <?php echo $url_2;?>
                        </a>
                        <?php
                    }
                    ?>
                    
                </article>
        </div>
</section>