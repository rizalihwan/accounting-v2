(function($) {
'use strict';
	$(document).ready(function()
    {
        var dTable = $('#myAdvancedTable').DataTable({

            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            responsive: false,
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-sm btn-info', 
                    title: 'Permissions',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-success',
                    title: 'Permissions',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Permissions',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Permissions',
                    pageSize: 'A2',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-sm btn-default',
                    title: 'Permissions',
                    // orientation:'landscape',
                    pageSize: 'A2',
                    header: true,
                    footer: false,
                    orientation: 'landscape',
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ]
        });


        // datatable inline cell edit
        dTable.MakeCellsEditable({
            "onUpdate": myCallbackFunction,
            "inputCss":'form-control',
            "columns": [0,1,2,3],
            "allowNulls": {
                "columns": [3],
                "errorClass": 'error'
            },
            "confirmationButton": { // could also be true
                "confirmCss": 'btn-sm btn-success',
                "cancelCss": 'btn-sm btn-danger'
            },
            "inputTypes": [
                {
                    "column": 0,
                    "type": "text",
                    "options": null
                },
                {
                    "column":1, 
                    "type": "list",
                    "options":[
                        { "value": "Beaty", "display": "Beaty" },
                        { "value": "Doe", "display": "Doe" },
                        { "value": "Dirt", "display": "Dirt" }
                    ]
                },
                {
                    "column": 2,
                    "type": "datepicker", 
                    "options": {
                        "icon": "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif" // Optional
                    }
                }
                 // Nothing specified for column 3 so it will default to text
                
            ]
        });

    });
    // datatable inline cell edit callback function
    function myCallbackFunction (updatedCell, updatedRow, oldValue) {
        console.log("The new value for the cell is: " + updatedCell.data());
        console.log("The old value for that cell was: " + oldValue);
        console.log("The values for each cell in that row are: " + updatedRow.data());
    }

    function destroyTable() {
        if ($.fn.DataTable.isDataTable('#myAdvancedTable')) {
            table.destroy();
            table.MakeCellsEditable("destroy");
        }
    }
})(jQuery);