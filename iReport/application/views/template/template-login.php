<?php include 'header.php'; ?>
<input type="hidden" id="login-status" value="<?php echo json_encode($this->session->userdata('is_login')); ?>">
<div class="container-fluid">
        <div class="masthead">
        	<ul class="nav nav-pills pull-right">
        		<li>
        			<div class="btn-group">
        				<button class="btn dropdown-toggle" data-toggle="dropdown">
        					<span class="pull-left title-member"><span class="fui-user"></span>howdy, <?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name'); ?></span>
        				</button>
        				<ul class="dropdown-menu" role="menu">
	        				<li>
	        					<a tabindex="-1" href="#" class="opt ">
	        						<span class="pull-left"><span class="fui-eye"></span>My Profile</span>
	        					</a>
	        				</li>
	        				<li>
	        					<a tabindex="-1" href="#" class="opt ">
	        						<span class="pull-left"><span class="fui-gear"></span>Change Password</span>
	        					</a>
	        				</li>
	        				<li rel="4">
	        					<div class="divider"></div>
	        					<a tabindex="-1" href="<?php echo site_url('signin/destroy'); ?>" class="opt highlighted fui-lock">
	        						<span class="pull-left"><span class="fui-lock"></span>Logout</span>
	        					</a>
	        				</li>
	        			</ul>
	        		</div>
        		</li>
	        </ul>
            <h4>System Reposting</h4>
          </div>
          <hr>

        <div class="row-fluid">
            <div class="span3">
                <?php include 'sidebar.php' ?>
            </div>
            <div class="span9">
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
                        <div class="list-menu">
                            <a href="<?php echo site_url('presence');?>">
                                <img src="<?php echo base_url('assets/images/icons/png/clipboard.png'); ?>">
                                <div class="title-text">My Presences</div>
                            </a>
                        </div>
                        <div class="list-menu">
                            <a href="<?php echo site_url('schedule/me'); ?>">
                                <img src="<?php echo base_url('assets/images/icons/png/calendar.png'); ?>">
                                <div class="title-text">My Schedules</div>
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
            </div>
        </div>

        <div class="form-login">
            <div id="modal-login" class="modal hide fade">
                  <div class="modal-header">
                    <h4 class="align-center"><span class="fui-lock"></span> LOGIN</h4>
                  </div>
                  <div class="modal-body">
                        <div class="form-presence">
                            <form class="form-horizontal" id="signin" action="" method="post">
                                <div class="text-center input">
                                    <input type="text" id="username" class="input-xlarge" name="username" placeholder="Username">
                                </div>
                                <div class="text-center input">
                                    <input type="password" id="password" class="input-xlarge" name="password" placeholder="Password">
                                </div>
                                <div class="text-center input" id="btn-login">
                                    <button type="submit" class="btn btn-block btn-primary">Login</button>
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
        </div>
    </div> 
<?php include 'footer.php'; ?>
    <script type="text/javascript">
    $(function(){
    	$('#signin').submit(function(){
    		var usr = $(this).find('input[name=username]').val();
    		var pass = $(this).find('input[name=password]').val();
    		var alert = '';

    		if(!usr)
    		{
    			alert += 'Username required. ';
    		}
    		if(!pass)
    		{
    			alert+= 'Password required.';
    		}
    		else
    		{
    			$.ajax('<?php echo base_url("index.php/signin/ajax_get_login"); ?>',{
    				data: {
    					username: usr,
    					password: pass
    				},
    				dataType: 'JSON',
    				type: 'POST',
    				success: function(e){
    					if(e.status)
    					{
    						alert += e.message;
    					}
    					else
    					{
    						alert += e.message;
    					}
    					status = e.status;
    					redirect = e.redirect;
    				},
    				error: function(){
    					alert += "Sorry, there's problem with server. Please try again later.";
    				}
    			});
    		}
    		$(this).find('#btn-login').slideUp(300);
    		$(this).siblings('.alert-message').find('.progress').slideDown(300, function(){
                $('.alert-message').slideDown(300);
    			// animate: make loading 100%
    			$(this).children('.progress-bar').animate({'width': '100%'}, 2000, 'easeInOutQuint', function(){
    				$(this).parent().slideUp(300, function(){
    					// animate: make loading 0%
    					$(this).children('.progress-bar').animate({'width': '0%'});
    					$(this).siblings('.text').html('');
    					$(this).siblings('.text').fadeOut(300);
    					$(this).siblings('.text').fadeIn(300);
    					$(this).siblings('.text').html(alert);

    					if(status == "true")
    					{
    						window.location.href = redirect;
    					}
    				});
    			});
    		});
       		return false;
    	});
    });
    </script>