// Dom Ready
$(function() {
  datatables_columns = [{
    field: "checkID",
    title: "#",
    width: 50,
    sortable: !1,
    textAlign: "center",
    selector: {class: "m-checkbox--solid m-checkbox--brand"}
  },{
    field: "id",
    title: "Đơn hàng",
    textAlign: "center",
    sortable: 'asc',
    filterable: !1,
  }
  ,{
      field: "username",
      title: "tài khoản",
    }
  , {
    field: "fullname",
    title: "Họ và tên",
  },
    {
    field: "email",
    title: "Email",
  },{
      field: "bill_address",
      title: "Địa chỉ nhận hàng",
    },
    {
      field: "total_amount",
      title: "Tổng tiền",
    },{
    field: "is_status",
    title: "Status",
    textAlign: "center",
    width: 70,
    template: function (t) {
      var e = {
        0: {title: "Disable", class: "m-badge--danger"},
        1: {title: "Active", class: "m-badge--primary"},
      };
      return '<span data-field="is_status" data-value="'+(t.is_status == 1 ? 0 : 1)+'" class="m-badge ' + e[t.is_status].class + ' m-badge--wide btnUpdateField">' + e[t.is_status].title + "</span>"
    }
  }, {
    field: "updated_time",
    title: "Updated Time",
    type: "date",
    textAlign: "center",
    format: "MM/DD/YYYY"
  }, {
    field: "created_time",
    title: "Created Time",
    type: "date",
    textAlign: "center",
    format: "MM/DD/YYYY"
  }, {
    field: "action",
    width: 110,
    title: "Actions",
    sortable: !1,
    overflow: "visible",
    template: function (t, e, a) {
      return '' +
        '<a href="javascript:;" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill btnEdit" title="Edit"><i class="la la-edit"></i></a>' +
        '<a href="javascript:;" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill btnDelete" title="Delete"><i class="la la-trash"></i></a>'
    }
  }];
  AJAX_DATATABLES.init();
  AJAX_CRUD_MODAL.init();

  $('[name="is_status"]').on("change", function () {
    table.search($(this).val(), "is_status")
  }), $('[name="is_status"]').selectpicker();



  $('#modal_form').on('shown.bs.modal', function(e){
    loadCategory();
  });

  $(document).on('click','.btnEdit',function () {
    let modal_form = $('#modal_form');
    let id = $(this).closest('tr').find('input[type="checkbox"]').val();
    AJAX_CRUD_MODAL.edit(function () {
      $.ajax({
        url : url_ajax_edit,
        type: "POST",
        data: {id:id},
        dataType: "JSON",
        success: function(response) {
          $.each(response.data_info, function( key, value ) {
            let element = modal_form.find('[name="'+key+'"]');
            element.val(value);
            if(element.hasClass('switchBootstrap')){
              element.bootstrapSwitch('state',(value == 1 ? true : false));
            }
            if(key === 'thumbnail') element.closest('.form-group').find('img').attr('src',media_url + value);
          });

          $.each(response.data_language, function( i, value ) {
            let lang_code = value.language_code;
            $.each(value, function( key, val) {
              let element = modal_form.find('[name="language['+lang_code+']['+key+']"]');
              if(element.hasClass('tinymce') && val){
                tinymce.get(element.attr('id')).setContent(val);
              }
              element.val(val);
            });
          });

          loadCategory(response.data_category);
          modal_form.modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          console.log(errorThrown);
          console.log(textStatus);
          console.log(jqXHR);
        }
      });return false;
    });
  });
});

