<div id='wrapper'>
     <div id='steps'>
     <?php echo form_open('question/add','id="formElem" name="formElem" class="myFormContainer" style="padding:0px;border:none"');?>
        <?php echo form_fieldset('Câu Hỏi','class="step"');?>
				<p>
					<?php echo form_label('Chọn môn học:','class="myFormLabel"');?>
					<?php echo form_dropdown('mon_hoc_id', $subject_options, 
					set_value('mon_hoc_id', '0'), 'id="mon_hoc_id" class="myFormDropDown"'); ?>
				</p>
                <p>
                    <?php echo form_label('Nội dung:','class="myFormLabel"');?>
                    <?php echo form_textarea('editor_noi_dung', set_value('editor_noi_dung',''), 'id="editor_noi_dung" class="ckeditor"');?>
                </p>
         <?php echo form_fieldset_close(); ?>
         <?php echo form_fieldset('Các đáp án','class="step"');?>
                <p>
                    <?php $so_dap_an_options = array(
                    		'2' => '2',
                    		'3' => '3',
                    		'4' => '4',
                    		'5' => '5',
                    		'6' => '6'
                    );
                    echo form_label('Số đáp án:','class="myFormLabel"');?>
                    <?php $js='id="so_dap_an" onchange="onChangeSoDapAn(this.value)"';echo form_dropdown('so_dap_an', $so_dap_an_options, 
					set_value('so_dap_an', '4'), $js); ?>
				</p>
				<p id='cac_dap_an'></p>
				<p id='p_editor_dap_an' style='display:none'>
					<?php echo form_textarea('editor_dap_an', set_value('editor_dap_an',''), 'id="editor_dap_an" class="ckeditor"');?>
                </p>
         <?php echo form_fieldset_close(); ?>
         <?php echo form_fieldset('Lời giải','class="step"');?>
				<p id='dap_an_dung'></p>
				<p>
					<?php echo form_label('Lời giải:','class="myFormLabel"');?>
					<?php echo form_textarea('editor_loi_giai', set_value('editor_loi_giai',''), 'id="editor_loi_giai" class="ckeditor"');?>
				</p>
		 <?php echo form_fieldset_close(); ?>
		 <?php echo form_fieldset('Xác nhận','class="step"');?>
		 		<?php echo form_hidden('txt_dap_an_dung',set_value('txt_dap_an_dung',''),'id="txt_dap_an_dung"')?>
				<p id='p_preview_cau_hoi'></p>
				<p>
					<?php echo form_label('Trạng thái:','class="myFormLabel"');?>
					<?php echo form_dropdown('status', $question_status_options, 
					set_value('status', '0'), 'id="status" class="myFormDropDown"'); ?>
				</p>            
				<p class='submit'>
				<?php echo form_submit('submitButton','Tạo câu hỏi','id="Tạo câu hỏi"');?>
                </p>        
        <?php echo form_fieldset_close(); ?>    
		<?php echo form_close(); ?>
		<!--  </form> -->
    </div>
    <div id='navigation' style='display:none;'>
        <ul>
			<li class='selected'>
				<a href='#'>Câu hỏi</a>
			</li>
			<li>
				<a href='#'>Các đáp án</a>
			</li>
			<li>
				<a href='#'>Lời giải</a>
			</li>
			<li>
				<a href='#'>Xác nhận</a>
			</li>
        </ul>
    </div>
</div>
<script type='text/javascript'>
                        function onChangeSoDapAn(n) {
                            var str = "<table style='width:100%'>";
                            var str_dap_an_checkbox = "<label class='myFormLabel'>Chọn đáp án đúng:</label>";
                            for (var i = 1; i <= n; i++)
                            {
                                str += "<tr><td style='width:20%'>";
                                str += "<label style='width:100%' class='myFormLabel'>Đáp án ";
                                str += i;
                                str += ":</label>";
                                str += "</td><td><label style='width:100%' id='dap_an_";
                                str += i;
                                str += "'></label><input type='hidden' id='txt_dap_an_";
                                str += i;
                                str += "' name='txt_dap_an_";
                                str += i;
                                str += "' value='";
                                str += i;
                                str += "' /></td></tr>";
                                str += "<tr><td></td><td><input id='btn_";
                                str += i;
                                str += "' class='btn_dap_an' type='button' value='Sửa' style='width: 100px;margin: 10px 10px;'> ";
                                str += "<input id='";
                                str += i;
                                str += "' class='btn_xem' type='button' value='Hoàn tất' style='width: 100px;margin: 10px 10px;display:none';>";
                                str += "</td></tr>";  
                                
                                str_dap_an_checkbox += "<label style='float: none;width: 100px;' for='chb_dap_an_dung_";
                                str_dap_an_checkbox += i;
                                str_dap_an_checkbox += "'><input name='chb_dap_an_dung[]' type='checkbox' value=";
                                str_dap_an_checkbox += i;
                                str_dap_an_checkbox += " style='float: none;width: 40px;vertical-align: middle;' />Đáp án ";
                                str_dap_an_checkbox += i;
                                str_dap_an_checkbox += "</label>";
                            }                             
                            str += '</table>';
                            $('#cac_dap_an').html(str);
                            $('#dap_an_dung').html(str_dap_an_checkbox);                            
                            
                            $('#cac_dap_an').width(Math.ceil($('.center_body').width() * 0.95 * 3 / 4));
                            $('.btn_dap_an').click(function() {
                                $('#p_editor_dap_an').css('display','block');
                                $('.btn_dap_an').css('display','none');
                                $('#'+$(this).attr('id').slice(-1)).css('display','block');
                                var td_dap_an = '#dap_an_' + $(this).attr('id').slice(-1);
                                $('#editor_dap_an').val($(td_dap_an).html());
                                //$('#editor_dap_an').focus();
                                CKEDITOR.instances.editor_dap_an.document.focus();
                                $('html, body').animate({scrollTop:$('#p_editor_dap_an').offset().top}, 1000);
                            });
                            $('.btn_xem').click(function() {
                                var rs = $('#editor_dap_an').val();
                                $('#dap_an_'+$(this).attr('id')).html(rs);                                
                                $('#txt_dap_an_'+$(this).attr('id')).val(rs);                                
                                $('#p_editor_dap_an').css('display','none');
                                $(this).css('display','none');
                                $('.btn_dap_an').css('display','block');
                                //$('#btn_'+$(this).attr('id')).css('display','block');
                            });
                            $('#btn_'+n).keydown(function(e) {
                                if (e.which == 9) { /// tab
                                    $('#navigation li:nth-child(3) a').click();
                                    $(this).blur();
                                    e.preventDefault();
                                }
                            });
                        }

						$(function() {
                        
                        //$('#editor_noi_dung').val(' ');
                        $('#so_dap_an').val(4).change();
                        $('#status').val(0).change();
                        var config = {
                            toolbar : [
                                {name: 'basicstyles', groups: ['colors', 'basicstyles'], items: ['TextColor', '-', 'Bold', 'Italic', 'Underline']},
                                {name: 'paragraph', groups: ['list', 'align'], items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
                                {name: 'insert', groups: ['insert', 'links'], items: ['Image', 'Table', 'EqnEditor', '-', 'Link', 'Unlink']},
                            ],                        
                            toolbarGroups : [                                
                                {name: 'basicstyles', groups: ['colors', 'basicstyles']},
                                {name: 'paragraph', groups: ['list', 'align']},
                                {name: 'insert', groups: ['insert', 'links']},
                            ]
                        };
                        //$('#editor_noi_dung').ckeditor(config);
                        $('.ckeditor').ckeditor(config);
                        CKEDITOR.instances.editor_noi_dung.on('contentDom', function() {
                            //alert(CKEDITOR.instances.editor_noi_dung.name);
                            this.document.on('keydown', function (event) {
                                //alert(event.data.getKey());
                                if (event.data.getKey() == 9) { /// tab
                                    $('#navigation li:nth-child(2) a').click();
                                    $(this).blur();
                                    event.data.preventDefault();
                                }
                            });
                        });
                        CKEDITOR.instances.editor_loi_giai.on('contentDom', function() {
                            //alert(CKEDITOR.instances.editor_noi_dung.name);
                            this.document.on('keydown', function (event) {
                                //alert(event.data.getKey());
                                if (event.data.getKey() == 9) { /// tab
                                    $('#navigation li:nth-child(4) a').click();
                                    $(this).blur();
                                    event.data.preventDefault();
                                }
                            });
                        });                        
                    });
</script>                                
                         
