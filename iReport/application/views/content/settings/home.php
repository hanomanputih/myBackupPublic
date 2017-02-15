<div class="list-options content">
    <div class="title">
        <div class="title-img">
            <img src="<?php echo base_url('assets/images/icons/png/gear.png'); ?>">
        </div>
        <div class="title-text">General Settings</div>
        <div class="date"><?php echo date('d M', time()); ?></div>
        <div class="clear"></div>
    </div>

    <div class="<?php echo $class; ?>">
        <?php echo $msg; ?>
    </div>

    <form class="form-horizontal" action="<?php echo site_url('settings/update'); ?>" method="post">
            <div class="control-group">
                <label class="control-label">Position</label>
                <div class="controls">
                    <?php
                    $temp_position = '';
                    if($options['position'])
                    {
                        $decode = json_decode($options['position']['option_value'], true);
                        foreach($decode as $num => $val)
                        {
                            $temp_position = $temp_position . $val . ',';
                        }
                    }
                    ?>
                    <input type="text" name="position" class="tags-input input-xxlarge" value="<?php echo $temp_position; ?>">
                    <p class="palette-paragraph">
                        Arrange from high position. It will take <strong>effect</strong> in whole system.
                    </p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Generation</label>
                <div class="controls">
                    <?php
                    $temp_generation = '';
                    if($options['generation'])
                    {
                        $decode = json_decode($options['generation']['option_value'], true);
                        foreach($decode as $num => $val)
                        {
                            $temp_generation = $temp_generation . $val . ',';
                        }
                    }
                    ?>
                    <input type="text" name="generation" class="tags-input input-xxlarge" value="<?php echo $temp_generation; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Active Generation</label>
                <div class="controls">
                    <?php
                    if($options['generation'])
                    {
                        $decode = json_decode($options['generation']['option_value'], true);
                        foreach($decode as $num => $val)
                        {
                            $active = '';
                            if(!empty($options['active_generation']['option_value']))
                            {
                                if($num == $options['active_generation']['option_value'])
                                {
                                    $active = 'checked';
                                }
                            }
                            ?>
                            <label class="radio <?php echo $active; ?>">
                                <span class="icons"><span class="first-icon fui-radio-unchecked"></span><span class="second-icon fui-radio-checked"></span></span><input type="radio" name="active-generation" value="<?php echo $num; ?>" data-toggle="radio">
                                <?php echo $val; ?>
                            </label>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <hr/>
            <div class="control-group">
                <label class="control-label">Module</label>
                <div class="controls">
                    <?php
                    $temp_module = '';
                    if(@$options['module'])
                    {
                        $decode = json_decode($options['module']['option_value'], true);
                        foreach($decode as $num => $val)
                        {
                            $temp_module = $temp_module . $val . ',';
                        }
                    }
                    ?>
                    <input type="text" name="module" class="tags-input input-xxlarge" value="<?php echo $temp_module?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Time Practicum</label>
                <div class="controls">
                    <?php 
                    $temp_time = '';
                    if(@$options['time_practicum'])
                    {
                        $decode = json_decode($options['time_practicum']['option_value'], true);
                        foreach($decode as $num => $val)
                        {
                            $temp_time = $temp_time . $val . ',';
                        }
                    }
                    ?>
                    <input type="text" name="time-practicum" class="tags-input input-xxlarge" value="<?php echo $temp_time; ?>">
                </div>
            </div>
            <hr>
            <div class="control-group">
                <label class="control-label">Default Reset Password</label>
                <div class="controls">
                    <?php
                    $temp_pass = '';
                    if($options['default_password'])
                    {
                        $temp_pass = $options['default_password']['option_value'];
                    }
                    ?>
                    <input type="text" id="reset-pass" name="reset-pass" class="input-large" value="<?php echo $temp_pass; ?>" required="">
                </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
        </form>
</div> 