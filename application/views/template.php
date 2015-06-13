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
                
                $hMenu = array("Admin" => 'admin',
                    'Review Question' => 'home',
                	'User Admin' => 'user_admin'
                );?>
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

