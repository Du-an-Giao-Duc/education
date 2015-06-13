$(function() {
    var w = Math.ceil($('.center_body').width() * 0.95);
    $('#wrapper').width(w);
    $('#steps').width(w);
    $('.step').width(w);
    $('#steps form legend').width(w - 10);
    $('#steps form p').width(Math.ceil(w * 3 / 4));

    /*
     number of fieldsets
     */
    var fieldsetCount = $('#formElem').children().length;

    /*
     current position of fieldset / navigation link
     */
    var current = 1;

    /*
     sum and save the widths of each one of the fieldsets
     set the final sum as the total width of the steps element
     */
    var stepsWidth = 0;
    var widths = new Array();
    $('#steps .step').each(function(i) {
        var $step = $(this);
        widths[i] = stepsWidth;
        stepsWidth += $step.width();
    });
    $('#steps').width(stepsWidth);

    /*
     to avoid problems in IE, focus the first input of the form
     */
    $('#formElem').children(':first').find(':input:first').focus();

    /*
     show the navigation bar
     */
    $('#navigation').show();

    /*
     when clicking on a navigation link 
     the form slides to the corresponding fieldset
     */
    $('#navigation a').bind('click', function(e) {
        var $this = $(this);
        var prev = current;
        $this.closest('ul').find('li').removeClass('selected');
        $this.parent().addClass('selected');
        /*
         we store the position of the link
         in the current variable	
         */
        current = $this.parent().index() + 1;
        //alert(widths[current - 1]);
        /*
         animate / slide to the next or to the corresponding
         fieldset. The order of the links in the navigation
         is the order of the fieldsets.
         Also, after sliding, we trigger the focus on the first 
         input element of the new fieldset
         If we clicked on the last link (confirmation), then we validate
         all the fieldsets, otherwise we validate the previous one
         before the form slided
         */
        $('#steps').stop().animate({
            marginLeft: '-' + widths[current - 1] + 'px'
        }, 500, function() {
            if (current == fieldsetCount) {
                validateSteps();
//                if ($('#formElem').data('errors')) { /// preview
//                    $('#p_preview_cau_hoi').html("Bạn chưa cung cấp hết các thông tin cần thiết về câu hỏi!");
//                } else {
                var txt_dap_an_dung = '';
                $(':checkbox:checked[name^=chb_dap_an_dung]').each(function() {
                    txt_dap_an_dung += (this.value + '#');
//                        alert(this.value);
                });
                $('#txt_dap_an_dung').val(txt_dap_an_dung);
//                    alert(txt_dap_an_dung);
                if (txt_dap_an_dung.length === 0) {
                    alert('Câu hỏi này chưa có đáp án đúng nào');
                }
                var input_type = 'checkbox';
                if (txt_dap_an_dung.length <= 2) {
                    input_type = 'radio';
                }

                var so_dap_an = $('#so_dap_an').val();
                var s = $('#editor_noi_dung').val();
                for (var i = 1; i <= so_dap_an; i++) {
                    s += "<label style='width:100%;display:block;float:none;font-weight:normal;'><input disabled='disabled' name='dap_an_display' style='float:none;width:70px;vertical-align:middle;' type='" + input_type + "' readonly";
                    if (txt_dap_an_dung.indexOf(i + '') > -1) {
                        s += " checked";
                    }
                    s += "/>";
                    s += $('#dap_an_' + i).html();
                    s += "</label>";
                }
                $('#p_preview_cau_hoi').html(s);
//                }
            } else {
                validateStep(prev);
            }
            $('#formElem').children(':nth-child(' + parseInt(current) + ')').find(':input:first').focus();
            //alert(widths[current - 1]);
        });
        e.preventDefault();
    });

    /*
     clicking on the tab (on the last input of each fieldset), makes the form
     slide to the next step
     */
//    $('#formElem > fieldset').each(function() {
//        var $fieldset = $(this);
//        alert($fieldset.children(':last').find(':textarea').prop("tagName"));
//        $fieldset.children(':last').find(':input').keydown(function(e) {
//        $fieldset.children(':last').keydown(function(e) {
//            if (e.which == 9) { /// tab
//                //alert('tab');
//                $('#navigation li:nth-child(' + (parseInt(current) + 1) + ') a').click();
//                alert('goi');
//                /* force the blur for validation */
//                $(this).blur();
//                e.preventDefault();
//            }
//        });
//    });

    /*
     validates errors on all the fieldsets
     records if the Form has errors in $('#formElem').data()
     */
    function validateSteps() {
        var FormErrors = false;
        for (var i = 1; i < fieldsetCount; ++i) {
            var error = validateStep(i);
            if (error == -1)
                FormErrors = true;
        }
        $('#formElem').data('errors', FormErrors);
    }

    /*
     validates one fieldset
     and returns -1 if errors found, or 1 if not
     */
    function validateStep(step) {
        if (step == fieldsetCount)
            return;

        var error = 1;
        var hasError = false;
        $('#formElem').children(':nth-child(' + parseInt(step) + ')').find(':input:not(input[type=button],input[type=submit],input[type=checkbox],button)').each(function() {
            var $this = $(this);
            var valueLength = jQuery.trim($this.val()).length;

            if (valueLength == '') {
                //alert(this.id);
                hasError = true;
                $this.css('background-color', '#FFEDEF');
            }
            else
                $this.css('background-color', '#FFFFFF');
        });
        var $link = $('#navigation li:nth-child(' + parseInt(step) + ') a');
        $link.parent().find('.error,.checked').remove();

        var valclass = 'checked';
        if (hasError) {
            error = -1;
            valclass = 'error';
        }
        $('<span class="' + valclass + '"></span>').insertAfter($link);

        return error;
    }

    /*
     if there are errors don't allow the user to submit
     */
    $('#submitButton').bind('click', function() {
        if ($('#formElem').data('errors')) {
            alert('Bạn chưa cung cấp hết các thông tin cần thiết về câu hỏi!');
            return false;
        }
    });
});