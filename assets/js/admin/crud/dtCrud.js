var oTable;

$( function() {

    var fhc = $("input[name=csrf_test_name]").val();

    oTable = $("#tb_crud").dataTable({
    	"language": {
            // "url": "bower_components/datatables-plugins/i18n/Portuguese-Brasil.lang"
            "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            'url'  : 'admin/crud/getDataItem',
            'type' : 'post',
            'data' : {
                "csrf_test_name" : fhc
            }
        },

        "order": [[ 0, 'asc' ]],

        "columns": [
            { "data": "name" },
            { "data": "description" },
            { "data": "actions" }
        ],

        "columnDefs": [
            { "width": "100px", "orderable": false, "searchable" : false, 'className' : 'text-center',  "targets": -1 } // actions
        ],

        "drawCallback": function( settings ) {

            // open modal to remove item at the datatables
            $('a.delete_row_dt').click(function(e) {
                var item_id = $(this).data('id');
                $('#delete').load('admin/crud/delete', {'item_id':item_id, 'csrf_test_name':fhc}, function(){
                    $('#delete').modal();
                    removeDialogHidden("#delete");
                });
            });

        }

    });
});



// action remove
$(document).on('click', "#remove" , function (event) {
    event.preventDefault();

    var form = $('form#form-delete-crud');
    var data = form.serialize();

    $.ajax({
        type: "POST",
        url: form.attr('action'),
        data: data,
        success: function (i) {
            var obj = $.parseJSON(i);
            if (obj.success == true) {

                if(typeof oTable !== "undefined") parent.oTable.api().ajax.reload(null, false);
                
            }

        },
        error: function (err) {
            alert('Ocorreu um erro ao apagar o item, tente novamente, atualize a página ou entre em contato.');
        },
        complete : function() {
            $("#delete").modal('hide');
        }
    });
});
