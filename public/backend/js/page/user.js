// Dom Ready
$(function() {
    datatables_columns = [{
        field: "checkID",
        title: "#",
        sortable: !1,
        textAlign: "center",
        selector: {class: "m-checkbox--solid m-checkbox--brand"}
    },{
        field: "id",
        title: "ID",
        width: 50,
        sortable: 'asc',
        filterable: !1,
    }, {
        field: "username",
        title: "User Name"
    }, {
        field: "fullname",
        title: "Full Name"
    }, {
        field: "is_status",
        title: "Status",
        template: function (t) {
            var e = {
                0: {title: "Disable", class: "m-badge--danger"},
                1: {title: "Active", class: "m-badge--primary"},
            };
            return '<span class="m-badge ' + e[t.is_status].class + ' m-badge--wide">' + e[t.is_status].title + "</span>"
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

    $('[name="is_status"]').on("change", function () {
        table.search($(this).val(), "is_status")
    }), $('[name="is_status"]').selectpicker();

    $('select[name="group_id"]').on("change", function () {
        table.search($(this).val(), "group_id")
    });

    loadGroup();
    AJAX_CRUD_MODAL.init();
});

function loadGroup(dataSelected) {
    let selector = $('select[name="group_id"]');
    selector.select2({
        placeholder: '',
        allowClear: !0,
        multiple: !0,
        data: dataSelected,
        ajax: {
            url: url_ajax_load_group,
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
