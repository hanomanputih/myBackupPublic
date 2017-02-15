<?php include 'header.php'; ?>
<input type="hidden" id="login-status" value="<?php echo json_encode($this->session->userdata('is_login')); ?>">
<div class="preload"></div>
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
	        					<a tabindex="-1" href="<?php echo site_url('account/'.$this->session->userdata('username')); ?>" class="opt ">
	        						<span class="pull-left"><span class="fui-user"></span>My Profile</span>
	        					</a>
	        				</li>
	        				<li>
	        					<a tabindex="-1" href="<?php echo site_url('account/'.$this->session->userdata('username').'/edit'); ?>" class="opt ">
	        						<span class="pull-left"><span class="fui-gear"></span>Change Password</span>
	        					</a>
	        				</li>
	        				<li rel="4">
	        					<div class="divider"></div>
	        					<a tabindex="-1" href="<?php echo site_url('signin/destroy'); ?>" class="opt ">
	        						<span class="pull-left"><span class="fui-lock"></span>Logout</span>
	        					</a>
	        				</li>
	        			</ul>
	        		</div>
        		</li>
	        </ul>
            <h4>System Reporting</h4>
          </div>
          <hr>

        <div class="row-fluid">
            <div class="span3 sidebar">
                <?php include 'sidebar.php' ?>
            </div>
            <div class="span9">
                <?php echo $content; ?>
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
    			// animate: make loading 100%
    			$(this).children('.progress-bar').animate({'width': '100%'}, 2000, 'easeInOutQuint', function(){
    				$(this).parent().slideUp(300, function(){
    					// animate: make loading 0%
    					$(this).children('.progress-bar').animate({'width': '0%'});
    					$(this).siblings('.text').html('');
    					$(this).siblings('.text').fadeOut(300);
    					$(this).siblings('.text').fadeIn(300);
    					$(this).siblings('.text').html(alert);

    					if(status)
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