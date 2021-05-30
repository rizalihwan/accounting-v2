(function($) {
'use strict';
    // permission table
    $(document).ready(function()
    {
        var searchable = [];
        var selectable = []; 
        var token = $('#token').val();

        var dTable = $('#permission_table').DataTable({

            order: [],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            processing: true,
            responsive: false,
            serverSide: true,
            processing: true,
            language: {
              processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: 'permission/get-list',
                type: "get",
                headers: {
                      'X-CSRF-TOKEN': token
                }
            },
            columns: [
                {data:'name', name: 'name', orderable: false, searchable: false},
                {data:'roles', name: 'roles'},
                {data:'action', name: 'action'}

            ],
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
            ],
            /* 
             * create an element id to change permission names, while inline datatable updated
            */
            createdRow: function ( row, data, index ) {
                var td_index = data.DT_RowIndex;
                $('td', row).eq(0).attr('id', 'perm_'+data.id);
                $('td', row).eq(0).attr('title', 'Click to edit permission');
             },
            initComplete: function () {
                var api =  this.api();
                api.columns(searchable).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.setAttribute('placeholder', $(column.header()).text());
                    input.setAttribute('style', 'width: 140px; height:25px; border:1px solid whitesmoke;');

                    $(input).appendTo($(column.header()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });

                    $('input', this.column(column).header()).on('click', function(e) {
                        e.stopPropagation();
                    });
                });

                api.columns(selectable).every( function (i, x) {
                    var column = this;

                    var select = $('<select style="width: 140px; height:25px; border:1px solid whitesmoke; font-size: 12px; font-weight:bold;"><option value="">'+$(column.header()).text()+'</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function(e){
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^'+val+'$' : '', true, false ).draw();
                            e.stopPropagation();
                        });

                    $.each(dropdownList[i], function(j, v) {
                        select.append('<option value="'+v+'">'+v+'</option>')
                    });
                });
            }
        });


        // datatable inline cell edit
        // only those have manage_permission permission will get access
        // @can is a blade syntax
        dTable.MakeCellsEditable({
            "onUpdate": updatePermission, //call function to update in backend
            "inputCss":'form-control',
            "columns": [0],
            "confirmationButton": { // could also be true
                "confirmCss": 'btn btn-success',
                "cancelCss": 'btn btn-danger'
            },
            "inputTypes": [
                {
                    "column": 0,
                    "type": "text",
                    "options": null
                }
                
            ]
        });
        //end of permission area
    });
    // datatable inline cell edit callback function
    function updatePermission (updatedCell, updatedRow, oldValue) 
    {
        var id = updatedRow.data().id;
        var name = updatedRow.data().name;
        $.ajax({
            url: "permission/update",
            method: "GET",
            dataType: 'json',
            data: {
                'id' : id,
                'name' : name
            },/*
            headers: {
                'X-CSRF-TOKEN': token
            },*/
            success: function(data)
            {
                $('#perm'+updatedRow.data().id).text(data.name);
                updatedRow.data().name = data.name;
                
            }
        });
    }
    $('select').select2();
})(jQuery);