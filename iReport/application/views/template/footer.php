        <div class="form-login">
            <div id="modal-login" class="modal hide fade">
                  <div class="modal-header">
                    <h4 class="align-center"><span class="fui-lock"></span> LOGIN</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-presence">
                        <form class="form-horizontal" id="signin" action="" method="post">
                            <div class="control-group">
                                <label class="control-label">Username</label>
                                <div class="controls">
                                    <input type="text" id="username" name="username" placeholder="type here ...">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                    <input type="password" id="password" name="password" placeholder="type here ...">
                                </div>
                            </div>
                            <div class="control-group" id="btn-login">
                              <div class="controls">
                                <button type="submit" class="btn btn-primary">Login</button>
                              </div>
                            </div>
                        </form>
                        <div class="alert-message">
                            <div class="progress">
                                <div class="progress-bar" style="width: 0%;"></div>
                            </div>
                            <div class="text"></div>
                        </div>
                    </div>
                  </div>
                </div>
        </div>

    <footer>
      <div class="container">
        <div class="row">
            <h3 class="footer-title">Active Member(s)</h3>
            <div class="list-member">
                <?php 
                    if($footer['member'])
                    {
                        $no = 1;
                        ?>
                        <div class="span2">
                        <?php
                        foreach($footer['member'] as $result)
                        {
                            ?>
                            <div class="title-member"><a href="<?php echo site_url('account/'.$result['user_nicename']); ?>"><span class="fui-calendar-solid"></span> <?php echo trim($result['first_name'].' '.$result['last_name']); ?></a></div>
                            <?php
                            if($no % 5 == 0)
                            {
                                ?>
                                </div>
                                <div class="span2">
                                <?php
                            }
                            $no++;
                        }
                        ?>
                        </div>
                        <?php
                    }
                ?>
                <div class="clear"></div>
            </div>
         
        </div>
        <div class="row">
            <div class="copyright">Komputasi dan Sistem Cerdas &copy; Imam S Rifkan &middot; 2013</div>
        </div>
      </div>
    </footer>
    
    <!-- Load JS here for greater good =============================-->
    
    <script src="<?php echo base_url('assets/js'); ?>/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/bootstrap-select.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/bootstrap-switch.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/flatui-checkbox.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/flatui-radio.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/jquery.tagsinput.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/jquery.placeholder.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/jquery.stacktable.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/jquery.printElement.js"></script>
    <script src="http://vjs.zencdn.net/4.1/video.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/application.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/plug.js"></script>
    <script src="<?php echo base_url('assets/js'); ?>/engine.js"></script>
  </body>
</html>
