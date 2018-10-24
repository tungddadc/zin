// Dom Ready
$(function() {
    datatables_columns = [{
        field: "id",
        title: "#",
        sortable: !1,
        width: 40,
        selector: !1,
        textAlign: "center"
    }, {
        field: "id",
        title: "ID",
        sortable: 'asc',
        filterable: !1,
        width: 150,
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
        format: "MM/DD/YYYY"
    }, {
        field: "created_time",
        title: "Created Time",
        type: "date",
        format: "MM/DD/YYYY"
    }, {
        field: "action",
        width: 110,
        title: "Actions",
        sortable: !1,
        overflow: "visible",
        template: function (t, e, a) {
            return '\t\t\t\t\t\t<div class="dropdown ' + (a.getPageSize() - e <= 4 ? "dropup" : "") + '">' +
                '\t\t\t\t\t\t\t<a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"><i class="la la-ellipsis-h"></i></a>' +
                '\t\t\t\t\t\t  \t<div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t    \t' +
                '<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\t\t\t\t\t\t    \t' +
                '<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\t\t\t\t\t\t    \t' +
                '<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\t\t\t\t\t\t  \t' +
                '</div>\t\t\t\t\t\t</div>\t\t\t\t\t\t' +
                '<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>' +
                '\t\t\t\t\t\t<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t'
        }
    }];
    AJAX_DATATABLES.init();
});