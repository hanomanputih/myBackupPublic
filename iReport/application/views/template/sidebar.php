<?php
    $url = $this->uri->segment(1);
?>
<ul class="nav nav-list">
    <li <?php if($url == 'home'){ echo 'class="active"'; }?>><a href="<?php echo site_url('home'); ?>"><span class="fui-radio-unchecked"></span> Dashboard</a></li>
    <?php
    if($this->session->userdata('position') != 0)
    {
        ?>
        <li <?php if($url == 'presence'){ echo 'class="active"'; }?>>
            <a><span class="fui-check-inverted-2"></span> Presence</a>
            <ul class="list-item">
                <li><a href="<?php echo site_url('presence'); ?>"><span class="fui-list"></span> List Presence</a></li>
                <li><a class="disable-action" href="<?php echo site_url('presence/create'); ?>" class="btn-presence"><span class="fui-plus"></span> Add Presence</a></li>
            </ul>
        </li>
        <?php
    }
    ?>
    <li <?php if($url == 'schedule'){echo 'class="active"';} ?>>
        <a><span class="fui-calendar-solid"></span> Schedules</a>
        <ul class="list-item">
            <li><a href="<?php echo site_url('schedule'); ?>"><span class="fui-calendar-solid"></span> All Schedules</a></li>
            <?php
            if($this->session->userdata('position') != 0)
            {
                ?>
                <li><a href="<?php echo site_url('schedule/me'); ?>"><span class="fui-calendar-solid"></span> My Schedules</a></li>
                <?php
            }
            ?>
        </ul>
    </li>
    <?php 
    if($this->session->userdata('position') < 3)
    {
        ?>
        <li <?php if($url == 'settings' || $url == 'members' || $url == 'generation'){ echo 'class="active"'; }?>>
            <a><span class="fui-gear"></span> Options</a>
            <ul class="list-item">
                <li><a href="<?php echo site_url('settings'); ?>"><span class="fui-gear"></span> General Settings</a></li>
                <li><a href="<?php echo site_url('generation'); ?>"><span class="fui-user"></span> Generations</a></li>
                <li><a href="<?php echo site_url('members'); ?>"><span class="fui-user"></span> Members</a></li>
            </ul>
        </li>
        <?php    
    }
    ?>
</ul>