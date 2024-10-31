$(".delete_btn").click(function() {
    var data = $(this).attr('data-action');
    var message = $(this).attr('message');
    var btn_msg = 'Yes, delete it!';

    if ($(this).attr('data-btn')) {
        var btn_msg = $(this).attr('data-btn');
    }

    swal({
            title: "Are you sure\n " + message + " ?",
            // text: "You will not be able to recover this data !",
            type: "error",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-danger',
            confirmButtonText: btn_msg,
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $('#' + data).submit();
            } else {
                swal.close();
                // swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
});