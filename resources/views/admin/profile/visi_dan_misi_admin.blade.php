@extends('layouts.app')
@section('content')
    <style>
        .error {
            color: red;
            font-size: 12px;
        }

        #btn_add[disabled] {
            opacity: 0.65;
            cursor: not-allowed;
        }

        table.dataTable td.custom-width {
            width: 2%;
            /* Or any specific width value */
        }

        table.dataTable td.custom-width-1 {
            width: 15%;
            /* Or any specific width value */
        }
        table.dataTable td.custom-width-3 {
            width: 15%;
            /* Or any specific width value */
        }
    </style>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toastContainer"></div>
    </div>

    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Visi Misi Tujuan</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#exampleModal">
                            + Tambah Data Visi Misi Tujuan
                        </button>
                        <table id="example1" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Isi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Isi</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- DataTable with Hover -->
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form">
                        @csrf
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="visi_misi_tujuan" id="visi_misi_tujuan" class="form-control">
                                <option selected disabled>-- Pilih Kategori --</option>
                                <option value="visi">Visi</option>
                                <option value="misi">Misi</option>
                                <option value="tujuan">Tujuan</option>
                            </select>
                            <div class="invalid-feedback" id="visi_misi_tujuan-error">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea name="isi" id="isi" rows="3" class="form-control"></textarea>
                            <div class="invalid-feedback" id="isi-error">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var newTable;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var newTable = $('#example1').DataTable({
                columnDefs: [{
                        "targets": '_all', // Apply to all columns
                        "orderable": false
                    },
                    {
                        "targets": [0],
                        "className": "custom-width",
                    },
                    {
                        "targets": [1],
                        "className": "custom-width-1",
                    },
                    {
                        "targets": [2],
                        "className": "custom-width-2",
                    },
                    {
                        "targets": [3],
                        "className": "custom-width-3",
                    }
                ],
                processing: true,
                serverSide: true,
                type: 'post',
                ajax: {
                    url: "{{ route('visi_misi_tujuan.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'isi',
                        name: 'isi'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });
        });


        $("#add_form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('visi_misi_tujuan.store') }}";
            $('#btn_add').prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 400) {
                        toastr.error(response.errors);
                        $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 401) {
                        toastr.error(response.errors);
                        $('#btn_add').prop('disabled', false);


                    } else if (response.status == 200) {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);
                        // 🔥 FORCE CLOSE MODAL (PASTI NUTUP)
    $('#exampleModal').removeClass('show');
    $('#exampleModal').css('display', 'none');

    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
                        $("#add_form")[0].reset(); // Fix here
                        $('#example1').DataTable().ajax.reload();
                    }
                },
            });
        });

        $("#add_new").on('click', '.edit_inline', function() {
            var btn = $(this);
            btn.closest("tr").find(".edit_inline").hide();

            $(this).closest("tr").find(".editSpan").hide();
            $(this).closest("tr").find(".editInput").show();
            $(this).closest("tr").find(".editCancel").show();
            $(this).closest("tr").find(".edit_inline").hide();
            $(this).closest("tr").find(".btnSave").show();
        });

        $("#add_new").on('click', '.editCancel', function(e) {
            e.preventDefault();

            $(this).closest("tr").find(".editSpan").show(); // mencari
            $(this).closest("tr").find(".editInput").hide();

            $(this).closest("tr").find(".edit_inline").show();
            $(this).closest("tr").find(".editCancel").hide();

            $(this).closest("tr").find(".btnSave").hide();
        });


        $("#add_new").on("click", '.btnSave', function(e) {
            e.preventDefault();
            var trObj = $(this).closest("tr");
            var ID = $(this).closest("tr").attr('id');
            var inputData = $(this).closest("tr").find(".editInput").serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('visi_misi_tujuan.updated') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'action=edit&id=' + ID + '&' + inputData,
                success: function(response) {
                    if (response.status == 200) {
                        trObj.find(".editSpan.visi_misi_tujuan").text(response.data.visi_misi_tujuan);
                        trObj.find(".editInput.visi_misi_tujuan").val(response.data.visi_misi_tujuan);

                        trObj.find(".editSpan.isi").text(response.data.isi);
                        trObj.find(".editInput.isi").val(response.data.isi);

                        trObj.find(".editInput").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".btnSave").hide();
                        trObj.find(".editCancel").hide();
                        trObj.find(".edit_inline").show();
                    } else {
                        $.each(response.data, function(field, errors) {
                            var inputElement = trObj.find(".editInput." +
                                field);
                            inputElement.addClass('is-invalid');
                            $('#' + field + ID + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                    }
                }
            });
        });



        $("#add_new").on('keyup', '.editInput', function() {
            $(this).removeClass('is-invalid'); // Remove is-invalid class on keyup
        });

        $("#add_new").on('click', '.editCancel', function() {
            // Find the associated input field within the same table row and remove 'is-invalid' class
            $(this).closest('tr').find('.editInput').removeClass('is-invalid');
        });


        function deleteData(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: 'Apakah Kamu ingin menghapus data ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('visi_misi_tujuan.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
                            },
                            success: function(response) {
                                toastr.success(response.message);
                                $('#example1').DataTable().ajax.reload();

                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Data is not deleted',
                        'error'
                    )
                }
            });
        }
    </script>
@endsection
