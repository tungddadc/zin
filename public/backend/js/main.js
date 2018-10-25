var win = $(window),
    body = $('body'),
    doc = $(document),
    meta_csrf_token = $('meta[id="csrf_token"]'),
    csrf_cookie_name = 'csrf_cookie_name',
    csrf_token_name = meta_csrf_token.attr('name'),
    csrf_token_hash = meta_csrf_token.attr('content'),
    method_modal = '',
    slug_disable = false,
    option_TinyMCE = {
        height: "300",
        selector: "textarea.tinymce",
        setup: function (ed) {
            ed.on('DblClick', function (e) {
                if (e.target.nodeName == 'IMG') {
                    tinyMCE.activeEditor.execCommand('mceImage');
                }
            });
        },
        plugins: [
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker template",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern moxiemanager link image",
        ],

        toolbar1: "newdocument | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect template",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft insertfile link image",

        templates: [
            {
                title: 'Textbox',
                description: 'Tạo Textbox',
                url: base_url + 'public/admin/plugins/tinymce/templates/text-box.html'
            }
        ],

        menubar: false,
        element_format: 'html',
        extended_valid_elements: "iframe[src|width|height|name|align], embed[width|height|name|flashvars|src|bgcolor|align|play|loop|quality|allowscriptaccess|type|pluginspage]",
        toolbar_items_size: 'small',
        relative_urls: false,
        remove_script_host: true,
        convert_urls: true,
        verify_html: false,
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

        external_plugins: {
            "moxiemanager": base_url + "/plugins/moxiemanager/plugin.min.js"
        }
    },
    datatables_columns = [];

/*Đây là các Function để dùng chung*/
var FUNC = {
    getCookie: function(name){
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    },
    getYoutubeKey: function(url){
        var rx = /^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/;
        if(url) var arr = url.match(rx);
        if(arr) return arr[1];
    },
    ajaxShowRequest: function (formData, jqForm, options) {
        jqForm.find('[type="submit"]').append('<i class="fa fa-spinner fa-spin ml-2" style="font-size:24px;color: #ffffff;"></i>');
        //let queryString = $.param(formData);
        return true;
    },
    ajaxShowResponse: function (response, statusText, xhr, $form) {
        if(response.csrf_form){
            $form.find('input[name="' + response.csrf_form.csrf_name + '"]').val(response.csrf_form.csrf_value);
            $('meta[name="csrf_form_token"]').attr('content',response.csrf_form.csrf_value);
        }
        $form.find('.fa-spin').remove();
        if (typeof response.type !== 'undefined') {
            toastr[response.type](response.message);
            if (response.type === "warning") {
                $form.find('.form-group').removeClass('has-danger');
                $form.find('.form-control-feedback').remove();
                $.each(response.validation, function (key, val) {
                    $form.find('[name="' + key + '"]').after(val).parent().addClass('has-danger');
                });
            } else {
                $form.find('.form-group').removeClass('has-danger');
                $form.find('.form-control-feedback').remove();
                //$form.reset();
                setTimeout(function () {
                    if(response.url_redirect) location.href = response.url_redirect;
                },2000);
            }
        }
    },
    ajaxShowError: function () {
        toastr['error']("The action you have requested is not allowed.");
    }
};
/*Đây là các Function liên quan Datatables*/
var table;
var AJAX_DATATABLES = {
    init: function () {
        table = $("#ajax_data").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: url_ajax_list,
                        params: {
                            csrf_form_token: FUNC.getCookie(csrf_cookie_name),
                        },
                        map: function (t) {
                            var e = t;
                            return void 0 !== t.data && (e = t.data), e
                        }
                    }
                },
                pageSize: 10,
                serverPaging: !0,
                serverFiltering: !0,
                serverSorting: !1
            },

            layout: {scroll: !1, footer: !1},
            sortable: !0,
            pagination: !0,
            toolbar: {items: {pagination: {pageSizeSelect: [10, 20, 30, 50, 100]}}},
            search: {
                input: $("#generalSearch"),
            },
            columns: datatables_columns,
        });
        $(table).on('m-datatable--on-init',function () {
           console.log('on init');
        });
    },
    reload: function () {
        table.load();
    }
};
/*Function CRUD Modal*/
var AJAX_CRUD_MODAL = {
    open: function(){
        $('#modal_form').on('hidden.bs.modal', function(e){
            window.onbeforeunload = null;
            /*$(this).find('form').trigger('reset');
            $(this).find('input[type=hidden]').val(0);
            $('.form-group span.text-danger').remove();
            $(".select2").empty().trigger('change');
            $('#gallery').html('');
            $('.alert').remove();
            $('.help-block').empty();
            $("input.tagsinput").tagsinput('removeAll');
            $('input[name="is_featured"]').bootstrapSwitch('state',false);
            for (var j = 0; j < tinyMCE.editors.length; j++){
                tinymce.get(tinyMCE.editors[j].id).setContent('');
            }*/
        });
    },
    close: function(){
        let modal_form = $('#modal_form');
        modal_form.on('shown.bs.modal', function(e){
            //initSEO();//Plugin SEO
            body.append('<style>.modal-footer-top-button{position:fixed;z-index:999999;top:0;right:50px;}</style>');
            let diaLogScroll = modal_form,
                diaLogScrollHeight = diaLogScroll.find('.modal-header').height(),
                diaLogScrollFooter = diaLogScroll.find('.modal-footer');
            diaLogScroll.find('.modal-footer').addClass('modal-footer-top-button');
            diaLogScroll.scroll(function(){
                if(diaLogScroll.scrollTop() <= diaLogScrollHeight + 35){
                    diaLogScrollFooter.addClass('modal-footer-top-button');
                }else{
                    diaLogScrollFooter.removeClass('modal-footer-top-button');
                }
            });
        });
    },
    disable_close: function(){
        $('#modal_form').modal({backdrop: 'static', keyboard: false,show: false});
    },
    add: function () {
        $('#modal_form').modal('show');
        return false;
    },
    edit: function (func) {
        return func();
    },
    save: function () {
        let modal_form = $('#modal_form');
        let url;

        modal_form.find('.btnSave').attr('disabled',true);
        if(modal_form.find('input[name="id"]').val() == 0) {
            url = url_ajax_add;
        } else {
            url = url_ajax_update;
        }

        $.ajax({
            url : url,
            type: "POST",
            data: modal_form.find('form').serialize(),
            dataType: "JSON",
            beforeSend: function(){
                $('div.form-control-feedback').remove();
                $('.form-group').removeClass('has-danger');
            },
            success: function(data){
                console.log(data);
                toastr[data.type](data.message);
                if(data.type === "warning"){
                    $.each(data.validation,function (i, val) {
                        let input = $('[name="'+i+'"]');
                        if(input.parent().hasClass('input-group')){
                            input.closest('.input-group').after(val);
                        }else{
                            input.after(val);
                        }
                        input.addClass('form-control-danger');
                        input.closest('.form-group').addClass('has-danger');
                    })
                } else {
                    modal_form.modal('hide');
                    AJAX_DATATABLES.reload();
                }
                modal_form.find('.btnSave').attr('disabled',false);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                modal_form.find('.btnSave').attr('disabled',false);
            }
        });return false;
    },
    delete: function () {
        return false;
    },
    tinymce: function(){
        tinymce.init(option_TinyMCE);
    },
    init: function () {
        AJAX_CRUD_MODAL.disable_close();
        AJAX_CRUD_MODAL.open();
        AJAX_CRUD_MODAL.close();

        doc.on('click','.btnReload',function (e) {
            e.preventDefault();
            AJAX_DATATABLES.reload();
        });

        doc.on('click','.btnAddForm',function (e) {
            e.preventDefault();
            AJAX_CRUD_MODAL.add();
        });
        doc.on('click','.btnDeleteAll',function (ev) {
            ev.preventDefault();
            let listChecked = table.getSelectedRecords();
            if(listChecked.length == 0){
                toastr.warning('Vui lòng chọn bản ghi bạn muốn xóa !');
                return false;
            }
            swal({
                title: "Bạn có chắc chắn xóa những bản ghi này ?",
                text: "Bạn không thể khôi phục những bản ghi này sau khi xóa!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Đúng, Xóa ngay !",
                cancelButtonText: "Không, Hủy nó !",
                reverseButtons: !0
            }).then(function(e) {
                let ids = [];
                $.each(listChecked, function (i,v) {
                    ids.push($(v).find('input[type="checkbox"]').val());
                });
                if(ids){
                    $.ajax({
                        url : url_ajax_delete,
                        type: "POST",
                        data: {id:ids},
                        dataType: "JSON",
                        success: function(data) {
                            if(data.type){
                                toastr[data.type](data.message);
                            }
                            if(data.type === 'success'){
                                e.value ? swal("Xóa thành công!", "Những bản ghi bạn chọn đã được xóa.", "success") : "cancel" === e.dismiss && swal("Hủy bỏ thành công !", "Các bản ghi của bạn đã được an toàn :)", "error")
                            }
                            AJAX_DATATABLES.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            console.log(errorThrown);
                            console.log(textStatus);
                            console.log(jqXHR);
                        }
                    });
                }
            })
        });
        doc.on('click','.btnDelete',function (ev) {
            ev.preventDefault();
            let id = $(this).closest('tr').find('input[type="checkbox"]').val();
            swal({
                title: "Bạn có chắc chắn xóa bản ghi này ?",
                text: "Bạn không thể khôi phục bản ghi này sau khi xóa!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Đúng, Xóa ngay !",
                cancelButtonText: "Không, Hủy nó !",
                reverseButtons: !0
            }).then(function(e) {
                $.ajax({
                    url : url_ajax_delete,
                    type: "POST",
                    data:{id:id},
                    dataType: "JSON",
                    success: function(data) {
                        if(data.type){
                            toastr[data.type](data.message);
                        }
                        if(data.type === 'success'){
                            e.value ? swal("Xóa thành công!", "Bản ghi đã được xóa.", "success") : "cancel" === e.dismiss && swal("Hủy bỏ thành công !", "Bản ghi của bạn đã được an toàn :)", "error")
                        }
                        AJAX_DATATABLES.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log(errorThrown);
                        console.log(textStatus);
                        console.log(jqXHR);
                    }
                });
            })
        });

        doc.on('click','.btnUpdateField',function (ev) {
            ev.preventDefault();
            let id = $(this).closest('tr').find('input[type="checkbox"]').val();
            let field = $(this).data('field');
            let value = $(this).data('value');
            $.ajax({
                    url : url_ajax_update_field,
                    type: "POST",
                    data:{id:id,field:field,value:value},
                    dataType: "JSON",
                    success: function(data) {
                        if(data.type){
                            toastr[data.type](data.message);
                        }
                        AJAX_DATATABLES.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log(errorThrown);
                        console.log(textStatus);
                        console.log(jqXHR);
                    }
                });
        });
        doc.on('click','.btnSave',function (e) {
            e.preventDefault();
            AJAX_CRUD_MODAL.save();
        });
    }
};
/*Function CRUD Modal*/

/*Đây là các Event Function để dùng chung*/
var UI = {
    activeMenu: function(){
        $('ul>li a[href="' + window.location.origin + window.location.pathname + '"]').parent().addClass('m-menu__item--active').closest('.m-menu__item--submenu').addClass('m-menu__item--open m-menu__item--expanded');
    },
    ajaxFormSubmit: function(){
        $('form[method="post"]').ajaxForm({
            //target:        '#output1',   // target element(s) to be updated with server response
            beforeSubmit:  FUNC.ajaxShowRequest,  // pre-submit callback
            success:       FUNC.ajaxShowResponse,  // post-submit callback
            type:      'POST',        // 'get' or 'post', override for form's 'method' attribute
            dataType:  'JSON'        // 'xml', 'script', or 'json' (expected server response type)
            //clearForm: true        // clear all form fields after successful submit
            //resetForm: true        // reset the form after successful submit
            // $.ajax options can be used here too, for example:
            //timeout:   3000
        });
    },

    bootstrapSwitch: function(){
        $("[data-switch=true]").bootstrapSwitch();
    },
    /*Cái nào cần load luôn thì gọi ở đây*/
    init: function(){
        UI.activeMenu();
        //UI.ajaxFormSubmit();
        UI.bootstrapSwitch();
    },
};
jQuery(function($) {
    UI.init();
});