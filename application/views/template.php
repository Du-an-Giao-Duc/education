<?php // defined('ABSPATH') or define('ABSPATH', dirname(__FILE__), '\\/');    

?>
<!DOCTYPE html>
<html>
    <head>      
        <style>
.tblOverview,.tblOverview th,.tblOverview td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align:center;
}
.tablesorter,.tablesorter th,.tablesorter td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align:center;
}
</style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/styleLogin.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ddsmoothmenu.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ddsmoothmenu-v.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/styleCauHoi.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/flexigrid.pack.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>ckeditor/contents.css" />
        <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/jquery.leanModal.min.js"></script>

        <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>ckeditor/adapters/jquery.js"></script>

        <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/flexigrid.pack.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/sliding.form.js"></script>

        <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/jquery.tablesorter.js"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/ddsmoothmenu.js"></script>
        
        <script type="text/javascript">

            ddsmoothmenu.init({
                mainmenuid: "smoothmenu1", //menu DIV id
                orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
                classname: 'ddsmoothmenu', //class added to menu's outer DIV
                //customtheme: ["#1c5a80", "#18374a"],                
//                contentsource: ["smoothcontainer", "/smoothmenu.php"] //"markup" or ["container_id", "path_to_menu_file"]
                contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
            });

            ddsmoothmenu.init({
                mainmenuid: "smoothmenu2", //Menu DIV id
                orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
                classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
                method: 'toggle', // set to 'hover' (default) or 'toggle'
                arrowswap: true, // enable rollover effect on menu arrow images?
                //customtheme: ["#804000", "#482400"],
                contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
            });

            $(function() {

                $('#modaltrigger').leanModal({top: 110, overlay: 0.45});
                $('#modaltrigger1').leanModal({top: 110, overlay: 0.45});
            });

            function call_register() {
            	var form_data = {
                		username: $('#r_username').val(),
                		password: $('#r_password').val()	,
                		email	: $('#r_email').val(),
                		ajax: '1'
                	};
                	
                	$.ajax({
                		url: "<?php echo site_url('admin/ajax/register'); ?>",
                		type: 'POST',
                		data: form_data,
                		success: function(msg) {
                			$('#register_confirm').html(msg);
                		}
                	});
                	
                	return false;
            }
        </script>       

    </head>

    <body>

        <div class="main">
            <!-- TOP : start -->
            <div class="top"></div>
            <!-- TOP : end -->  

            <!-- HEADER : start --> 
            <div id="smoothcontainer">
                <?php
                
                $hMenus = $this->config->item('hMenu');
                if(isset($this->session->userdata['role'])) {
                	$hMenu = $hMenus[$this->session->userdata['role']];
                } else {
	                $hMenu = $hMenus[0];
                }?>
                <div id="smoothmenu1" class="ddsmoothmenu">
                    <ul>
                        <?php
                        if (isset($hMenu)) {
                            foreach ($hMenu as $name => $link) {
                                ?>
                                <li><?php echo anchor($link, $name);?></li>      
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    
                    <ul id="loginContainer">
                        <?php
                        if (isset($this->session->userdata['username'])) {
                            echo "<li><a href='#'>Xin chào " . $this->session->userdata['username'] . " &#12485;</a></li>";
                            ?>
                            <li><a href="<?php echo base_url();?>login/login_controller/logout">Đăng Xuất</a></li> 
                        <?php } else { ?>
                            <!-- LOG IN : start -->
                            <li><a href="#loginmodal" id="modaltrigger">Đăng Nhập</a>
                                <div id="loginmodal" style="display:none;">
                                    <h1>Thông tin đăng nhập</h1>
                                    <?php echo form_open('login/login_controller/login')?>
                                        <label for="username">Username:</label>
                                        <input type="text" name="username" id="username1" class="txtfield" tabindex="1" required autofocus
                                        <?php if ($this->input->cookie('username')) { ?>
                                                   value='<?php echo $this->input->cookie('username'); ?>'
                                                   <?php
                                                }
                                               ?>
                                               />

                                        <label for="password">Password:</label>
                                        <input type="password" name="password" id="password1" class="txtfield" tabindex="2" required
                                        <?php
                                        if ($this->input->cookie('password')) {
                                            $users = $this->user_model->get_record_by_username($this->input->cookie('username'));
                                            $user = $users['0'];
                                            $db_password = $user->password;
                                            if ($this->input->cookie('password') == md5($db_password)) {
                                                ?>
                                                       value='<?php echo $db_password ?>'
                                                       <?php
                                                   }
                                               } 
                                               ?>
                                               />

                                        <input type="checkbox" name="rememberme" id="rememberme" value="1" tabindex="3">Remember Me
                                        <br />
                                        <?php
                                        if (isset($this->session->userdata['login_error'])) {
                                            echo "<br /><div class='error_msg'>" . $this->session->userdata['login_error'] . "</div>";
                                            ?>
                                            <script type="text/javascript">
                                                $(function() {
                                                    $('#modaltrigger').click();
                                                });
                                            </script>
                                        <?php } ?>
                                        <br />
                                        <input type="submit" name="loginbtn" id="loginbtn" class="flatbtn-blu" value="Login" tabindex="4" />
                                    </form>                                    
                                </div>
                            </li> 
                            <!-- LOG IN : end -->  

                            <!-- REGISTER : Start -->                        
                            <li><a href="#registermodal" id="modaltrigger1">Đăng kí</a>
                                <div id="registermodal" style="display:none;">
                                    <h1>Thông tin đăng kí</h1>
<!--                                     <form id="registerform" name="registerform" method="post" action="login/login/register"> -->
                                        <label for="r_username">Username:</label>
                                        <input type="text" name="r_username" id="r_username" class="txtfield" tabindex="1" required autofocus />

                                        <script type='text/javascript'>
                                            function check() {
                                                var pass = document.getElementById('r_password');
                                                var cf_pass = document.getElementById('cf_password');
                                                if (pass.value.length < 5) {
                                                    pass.setCustomValidity('Mật khẩu phải dài hơn 5 ký tự');
                                                } else {
                                                    // input is valid -- reset the error message
                                                    pass.setCustomValidity('');
                                                }
                                                if (cf_pass.value != pass.value) {
                                                    cf_pass.setCustomValidity('Mật khẩu xác nhận không đúng');
                                                } else {
                                                    // input is valid -- reset the error message
                                                    cf_pass.setCustomValidity('');
                                                }
                                            }
                                        </script>
                                        <label for="password">Password:</label>
                                        <input type="password" name="r_password" id="r_password" 
                                               class="txtfield" tabindex="2" required oninput="check()" />

                                        <label for="cf_password">Confirm Password:</label>
                                        <input type="password" name="cf_password" id="cf_password" 
                                               class="txtfield" tabindex="3" required oninput="check()" />

                                        <label for="r_email">Email:</label>
                                        <input type="email" name="r_email" id="r_email" class="txtfield" tabindex="4" required />

                                        <input type="button" name="registerbtn" id="registerbtn" class="flatbtn-blu" value="Đăng kí" tabindex="5" onclick="call_register()"/>
                                        <p id='register_confirm'></p>
<!--                                     </form>                                     -->
                                </div>
                            </li> 
                            <!-- REGISTER : end -->                        
                        <?php } // end of check login ?> 
                    </ul>

                    <br style="clear: left" />
                </div>
            </div>
            <!-- HEADER : end -->  

            <!-- CONTENT : start -->                          
            <table style="width: 100%; text-align: center">
                <tr>
                    <td style="width: 15%; vertical-align: text-top;">
                        <!-- LEFT CONTENT : start -->  
                        <div id="smoothmenu2" class="ddsmoothmenu-v">
                            <ul>
                                <?php
                                if (isset($leftmenu)) {
                                    foreach ($leftmenu as $name => $link) {
                                        ?>
                                        <li><?php echo anchor($link, $name);?></li>      
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                            <br style = "clear: left" />
                        </div>
                        <!-- LEFT CONTENT : start -->  
                    </td>

                    <td style="width: 70%">
                        <div class="center_body">
                            <?php echo "</br>"?>
                            <?php echo $content ?>                                
                        </div>
                    </td>

                    <td style="vertical-align: text-top;">      
                        <!-- RIGHT CONTENT : start -->
                        <div class="right_content">
                                              
                        </div>
                        <!-- RIGHT CONTENT : end -->
                    </td>
                </tr>
            </table>
            <!--CONTENT : end -->

            <br /><br />

            <!--FOOTER : start -->
            <div class = "footer">Copyright &copy; 2014, by Author</div>
            <!--FOOTER : end -->
        </div>
    </body>

    <!-- Enable support for the placeholder attribute in INPUT fields -->
    <script type="text/javascript">

        // ref: http://diveintohtml5.org/detect.html
        function supports_input_placeholder()
        {
            var i = document.createElement('input');
            return 'placeholder' in i;
        }

        if (!supports_input_placeholder()) {
            var fields = document.getElementsByTagName('INPUT');
            for (var i = 0; i < fields.length; i++) {
                if (fields[i].hasAttribute('placeholder')) {
                    fields[i].defaultValue = fields[i].getAttribute('placeholder');
                    fields[i].onfocus = function() {
                        if (this.value == this.defaultValue)
                            this.value = '';
                    }
                    fields[i].onblur = function() {
                        if (this.value == '')
                            this.value = this.defaultValue;
                    }
                }
            }
        }

    </script>
</html>

