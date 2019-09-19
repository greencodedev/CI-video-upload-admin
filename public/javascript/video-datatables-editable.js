var TableDatatablesEditable = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            // var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            // jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            // jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            // jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            // jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
            jqTds[3].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[4].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            // oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            // oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            // oTable.fnUpdate(jqInputs[1].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 3, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 4, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            // oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            // oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            // oTable.fnUpdate(jqInputs[1].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 3, false);
            oTable.fnDraw();
        }

        function saveData(oTable, nRow, id, contents, origin_name) {
            var baseurl = $('#baseurl').val();
            $.post(baseurl + "index.php/video/editInfos", {'id': id, 'contents': contents, 'origin': origin_name}, function(data) {
                if (data == "success") {
                    saveRow(oTable, nRow)                    
                    toastr.success("Updated! ");
                } else { 
                    toastr.error("Failed! Please try again.");
                    restoreRow(oTable, nRow);
                }
            });
        }

        function deleteVideo(oTable, nRow, id) {
            var baseurl = $('#baseurl').val();
            $.post(baseurl + 'index.php/video/delete', {'id': id}, function(data) {
                if (data == "success") {
                    oTable.fnDeleteRow(nRow);
                    toastr.success("Deleted! ");
                } else {
                    toastr.error("Deleting was failed. Please try again.");
                    restoreRow(oTable, nRow);
                }
            })
        }

        var table = $('#sample_editable_1');

        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 5,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#sample_editable_1_wrapper");

        var nEditing = null;
        var nNew = false;

        $('#sample_editable_1_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previose row not saved. Do you want to save it ?")) {
                    select_id = $(this).parents('tr').attr('id');
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;
                    
                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }
            select_id = $(this).parents('tr').attr('id');
            var nRow = $(this).parents('tr')[0];
            
            deleteVideo(oTable, nRow, select_id);
            // oTable.fnDeleteRow(nRow);
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $(this).attr("background-color", "#4d7cf1")
            // copy clipboard.
            var nRow = $(this).parents('tr')[0];
            var copyUrl = $('#copyurl_input', nRow).val();
            $("#copy_input").val(copyUrl);
            $("#copy_input").attr("type", "text").select();
            document.execCommand("copy");
            $("#copy_input").attr("type", "hidden");
            toastr.success("Copy url was succeeded.");
            // end of copy clipboard

        //     e.preventDefault();
        //     nNew = false;
            
        //     /* Get the row as a parent of the link that was clicked on */
        //     var nRow = $(this).parents('tr')[0];

        //     if (nEditing !== null && nEditing != nRow) {
        //         /* Currently editing - but not this row - restore the old before continuing to edit mode */
        //         restoreRow(oTable, nEditing);
        //         editRow(oTable, nRow);
        //         nEditing = nRow;
        //     } else if (nEditing == nRow && this.innerHTML == "Save") {
        //         /* Editing this row and want to save it */
        //         select_id = $(this).parents('tr').attr('id');
        //         var contents = $('.contents input', nRow).val();
        //         var origin = $('.origin_name input', nRow).val();
                
        //         if (contents == "") {
        //             $('.contents', nRow).addClass('has-error');
        //         } else if (origin == "") {
        //             $('.origin_name', nRow).addClass('has-error');
        //         } else {
        //             saveData(oTable, nRow, select_id, contents, origin);
        //             nEditing = null;
        //         }                
        //     } else {
        //         /* No edit in progress - let's start one */
        //         editRow(oTable, nRow);
        //         nEditing = nRow;
        //     }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesEditable.init();
});

$('.goto-upload').click(function() {
    var baseurl = $('#baseurl').val();
    window.location.href = baseurl + "index.php/upload/index";
});

$('.goto-settings').click(function() {
    var baseurl = $('#baseurl').val();
    window.location.href = baseurl + "index.php/settings/index";
});