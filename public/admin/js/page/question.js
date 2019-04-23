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
    title: "ID",
    width: 50,
    textAlign: "center",
    sortable: 'asc',
    filterable: !1,
  }, {
    field: "title",
    title: "Tiêu đề",
    width: 100
  }, {
    field: "is_status",
    title: "Status",
    textAlign: "center",
    width: 70,
    template: function (t) {
      var e1 = {
        0: {title: "Disable", class: "m-badge--danger"},
        1: {title: "Active", class: "m-badge--primary"},
      };
      return '<span data-field="is_status" data-value="'+(t.is_status == 1 ? 0 : 1)+'" class="m-badge ' + (t.is_status != 1 ? 'm-badge--danger' : 'm-badge--primary') + ' m-badge--wide btnUpdateField">' + (t.is_status == 1 ? 'Active' : 'Disable') + "</span>"
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
  AJAX_CRUD_MODAL.tinymce();
  $('[name="is_status"]').on("change", function () {
    table.search($(this).val(), "is_status")
  }), $('[name="is_status"]').selectpicker();

  $(document).on('click','.btnEdit',function () {
    slug_disable = false;
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
            if(key === 'thumbnail' && value) element.closest('.form-group').find('img').attr('src',media_url + value);
          });
          if(response.account_id) loadUser(response.account_id);
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

  var modalForm = $('#modal_form');
  modalForm.on('shown.bs.modal', function(e){
    loadUser();
  });

});

function loadUser(dataSelected) {
  let selector = $('select[name="account_id"]');
  selector.select2({
    placeholder: 'Chọn tài khoản',
    allowClear: !0,
    multiple: !1,
    data: dataSelected,
    ajax: {
      url: url_ajax_load_user,
      dataType: 'json',
      delay: 250,
      data: function(e) {
        return {
          q: e.term,
          page: e.page
        }
      },
      processResults: function(e, t) {
        return t.page = t.page || 1, {
          results: e,
          pagination: {
            more: 30 * t.page < e.total_count
          }
        }
      },
      cache: !0
    }
  });
  if (typeof dataSelected !== 'undefined') selector.find('> option').prop("selected", "selected").trigger("change");
}