/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';

    config.skin = 'kama';
    config.entities_latin = false;
    config.language = 'vi';
    config.autoParagraph = false;
//    config.startupFocus = true;

//    config.extraPlugins = 'lineutils';
//    config.extraPlugins = 'widget';
    config.extraPlugins = 'eqneditor';
//    config.extraPlugins = 'preview';
    //config.extraPlugins = 'mathjax';
//    config.extraPlugins = 'serverpreview,eqneditor';
    config.serverPreviewURL = '/news.php#dt_modal';

//    config.extraPlugins = 'mathquill';
//    config.extraPlugins = 'stylesheetparser';
//    config.contentsCss = '/css/mathquill.css';
//    config.stylesheetParser_validSelectors = /\^(span)\.\w+/;


    config.filebrowserBrowseUrl = '/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = '/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = '/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = '/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = '/kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl = '/kcfinder/upload.php?type=flash';

    
    // Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
    config.toolbar = [
        {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source', '-', 'ServerPreview', '-', 'Templates']},
        {name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
        {name: 'editing', groups: ['find', 'selection'], items: ['Find', 'Replace', '-', 'SelectAll']},
        {name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']},
        '/',
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']},
        {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
        {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'EqnEditor', 'PageBreak']},
        '/',
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        {name: 'tools', items: ['Maximize', 'ShowBlocks']},
        {name: 'others', items: ['-']}
    ];

    // Toolbar groups configuration.
    config.toolbarGroups = [
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
        {name: 'forms'},
        '/',
        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
        {name: 'links'},
        {name: 'insert'},
        '/',
        {name: 'styles'},
        {name: 'colors'},
        {name: 'tools'},
        {name: 'others'}
    ];
};
