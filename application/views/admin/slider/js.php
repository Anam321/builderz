<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
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

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    table = new DataTable('#myTables', {
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            "url": "<?php echo site_url('admin/slider/dataTables') ?>",
            "type": "POST"
        },
        columnDefs: [{
            "targets": [0],
            "orderable": false,
        }, ],

    });

    function edit(id) {
        $('#modaldata').modal('show');
        $('#form')[0].reset();
        $.ajax({
            url: "<?php echo site_url('admin/slider/get_data_ById/') ?>" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="title"]').val(data.title);
                $('[name="desk"]').val(data.desk);
                $('[name="link"]').val(data.link);
                $('[name="old_gambar"]').val(data.gambar);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    $('#form').submit(function(e) {
        e.preventDefault();
        var form = $('#form')[0];
        var data = new FormData(form);

        $('#save').html(
            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
        ).attr('disabled', true);
        $.ajax({
            url: '<?php echo site_url('admin/slider/updateData') ?>',
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
                            timer: 2000,

                        }).then((result) => {
                            $('#modaldata').modal('hide');
                            reload_table();
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