<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/admin/lib/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script>
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
$(document).ready(function() {
    $('#desk').summernote({
        height: 300,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
            ['font', ['fontname', 'fontsize', 'fontsizeunit', 'color',
                'strikethrough', 'superscript', 'subscript'
            ]],

            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],

            ['insert', ['table', 'hr', 'link', 'picture', 'video']],
            ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']],
        ]
    });

});

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax
}

table = new DataTable('#myTables', {
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
        "url": "<?php echo site_url('admin/portfolio/dataTables') ?>",
        "type": "POST"
    },
    columnDefs: [{
        "targets": [0],
        "orderable": false,
    }, ],

});

function deletes(id) {

    Swal.fire({
        title: "Are you sure to delete this Data ?",
        // text: "Data akan dihapus",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#17a2b8",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Delete"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?php echo site_url('admin/portfolio/delete_data/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == '00') {
                        Swal.fire({
                            position: "top-midle",
                            icon: "success",
                            title: data.mess,
                            showConfirmButton: false,
                            timer: 2000,

                        }).then((result) => {
                            reload_table();

                        })


                    } else {
                        Swal.fire({
                            position: "top-midle",
                            icon: "error",
                            title: data.mess,
                            showConfirmButton: false,
                            timer: 2000,

                        })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    });
}




$('#form').submit(function(e) {
    e.preventDefault();
    var form = $('#form')[0];
    var data = new FormData(form);
    if ($('[name="title"]').val() == '0') {
        toastr.error('Judul cannot be empty')
        return false;
    }

    if ($('[name="desk"]').val() == '0') {
        toastr.error('Meta deskripsi cannot be empty')
        return false;
    }

    if ($('[name="images"]').val() == '') {
        toastr.error('Images cannot be empty')
        return false;
    }
    $('#save').html(
        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
    ).attr('disabled', true);
    $.ajax({
        url: '<?php echo site_url('admin/portfolio/PostData') ?>',
        type: "POST",
        //contentType: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        data: data,
        dataType: "JSON",

        success: function(data) {
            if (data.status == '00') {
                setTimeout(function() {
                    $('#save').text('Post Data'); //change button text
                    $('#save').attr('disabled', false); //set button enable
                    Swal.fire({
                        position: "top-midle",
                        icon: "success",
                        title: data.mess,
                        showConfirmButton: false,
                        timer: 1500,

                    }).then((result) => {
                        window.location.reload();
                    })
                }, 2000);
            } else {
                setTimeout(function() {
                    $('#save').text('Post Data'); //change button text
                    $('#save').attr('disabled', false); //set button enable
                    Swal.fire({
                        position: "top-midle",
                        icon: "error",
                        title: data.mess,
                        showConfirmButton: false,
                        timer: 2000,

                    })
                }, 2000);
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            setTimeout(function() {
                $('#save').text('Post Data'); //change button text
                $('#save').attr('disabled', false); //set button enable
                toastr.error('Error Code....')
            }, 2000);
        }
    });

});
$('#form_update').submit(function(e) {
    e.preventDefault();
    var form = $('#form_update')[0];
    var data = new FormData(form);
    if ($('[name="title"]').val() == '0') {
        toastr.error('Judul cannot be empty')
        return false;
    }
    if ($('[name="meta_keyword"]').val() == '0') {
        toastr.error('Meta keyword cannot be empty')
        return false;
    }
    if ($('[name="meta_deskripsi"]').val() == '0') {
        toastr.error('Meta deskripsi cannot be empty')
        return false;
    }

    $('#update').html(
        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
    ).attr('disabled', true);
    $.ajax({
        url: '<?php echo site_url('admin/portfolio/updateData') ?>',
        type: "POST",
        //contentType: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        data: data,
        dataType: "JSON",

        success: function(data) {
            if (data.status == '00') {
                setTimeout(function() {
                    $('#update').text('Post Data'); //change button text
                    $('#update').attr('disabled', false); //set button enable
                    Swal.fire({
                        position: "top-midle",
                        icon: "success",
                        title: data.mess,
                        showConfirmButton: false,
                        timer: 1500,

                    }).then((result) => {
                        window.location.reload();
                    })
                }, 2000);
            } else {
                setTimeout(function() {
                    $('#update').text('Post Data'); //change button text
                    $('#update').attr('disabled', false); //set button enable
                    toastr.error(data.mess)
                }, 2000);
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            setTimeout(function() {
                $('#update').text('Post Data'); //change button text
                $('#update').attr('disabled', false); //set button enable
                Swal.fire({
                    position: "top-midle",
                    icon: "error",
                    title: data.mess,
                    showConfirmButton: false,
                    timer: 2000,

                })
            }, 2000);
        }
    });

});



function fileValidation() {
    var fileInput = document.getElementById('images');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }
}
</script>