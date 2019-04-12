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
  },{
    field: "title",
    title: "Đại lý",
    width: 200
  },{
    field: "address",
    title: "Địa chỉ",
    width: 200
  }, {
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
  AJAX_CRUD_MODAL.tinymce();

  $('[name="is_status"]').on("change", function () {
    table.search($(this).val(), "is_status")
  }), $('[name="is_status"]').selectpicker();

  $('#modal_form').on('shown.bs.modal', function(e){
    loadCity();
  });

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

            if(element.hasClass('tinymce') && value){
              tinymce.get(element.attr('id')).setContent(value);
            }

            if(element.hasClass('switchBootstrap')){
              element.bootstrapSwitch('state',(value == 1 ? true : false));
            }
            if(key === 'thumbnail' && value) element.closest('.form-group').find('img').attr('src',media_url + value);
          });
          if(response.city_id) loadCity(response.city_id);
          else loadCity();
          if(response.district_id) loadDistrict(response.city_id,response.district_id);
          else loadDistrict(response.city_id);
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

function loadCity(dataSelected) {
  $('form select[name="city_id"]').select2({
    allowClear: true,
    placeholder: "Chọn tỉnh/thành phố",
    data: dataSelected,
    ajax: {
      url: url_ajax_city,
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: data
        };
      },
      cache: true
    }
  });
  $('form select[name="city_id"]').change(function () {
    var city_id = $(this).val();
    loadDistrict(city_id);
  });
}

function loadDistrict(city_id, dataSelected) {
  $('form select[name="district_id"]').select2({
    allowClear: true,
    placeholder: "Chọn quận huyện",
    data: dataSelected,
    ajax: {
      url: url_ajax_district + '/' + city_id,
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results: data
        };
      },
      cache: true
    }
  });
}