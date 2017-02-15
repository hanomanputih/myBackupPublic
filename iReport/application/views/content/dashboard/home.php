<div class="dashboard content">
    <div class="title">
        <div class="title-img">
            <img src="<?php echo base_url('assets/images/icons/png/map.png'); ?>">
        </div>
        <div class="title-text">Dashboard</div>
        <div class="date"><?php echo date('d M', time()); ?></div>
        <div class="clear"></div>
    </div>
    <div class="content-menu">
        <?php
        if($this->session->userdata('position') != 0)
        {
            ?>
            <div class="list-menu">
                <a href="<?php echo site_url('presence');?>">
                    <img src="<?php echo base_url('assets/images/icons/png/clipboard.png'); ?>">
                    <div class="title-text">My Presences</div>
                </a>
            </div>
            <?php
        }
        ?>
        <div class="list-menu">
            <?php
            switch($this->session->userdata('position'))
            {
                case 0:
                    $url = site_url('schedule');
                    $sch = 'All Schedules';
                break;
                default:
                    $url = site_url('schedule/me');
                    $sch = 'My Schedules';
                break;
            }
            ?>
            <a href="<?php echo $url; ?>">
                <img src="<?php echo base_url('assets/images/icons/png/calendar.png'); ?>">
                <div class="title-text"><?php echo $sch; ?></div>
            </a>
        </div>
        <div class="list-menu">
            <a href="<?php echo site_url('account'); ?>">
                <img src="<?php echo base_url('assets/images/icons/png/user.png'); ?>">
                <div class="title-text">My Account</div>
            </a>
        </div>
        <div class="list-menu">
            <a href="<?php echo site_url('report'); ?>">
                <img src="<?php echo base_url('assets/images/icons/png/book.png'); ?>">
                <div class="title-text">Report</div>
            </a>
        </div>
    </div>
</div>