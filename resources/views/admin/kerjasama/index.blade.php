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

        table.dataTable td.custom-width-2 {
            width: 20%;
            /* Or any specific width value */
        }

        table.dataTable td.custom-width-3 {
            width: 20%;
            /* Or any specific width value */
        }

        table.dataTable td.custom-width-4 {
            width: 5%;
            text-align: center;

            /* Or any specific width value */
        }

        table.dataTable td.custom-width-5 {
            width: 10%;
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
                        <h3 class="card-title">Kerjasama</h3>
                    </div>
                    <div class="card-body">

                        <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modal_kerjasama">
                            + Tambah Data kerjasama
                        </button>

                        <table id="example1" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Gambar</th>
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


    <div class="modal fade" id="modal_kerjasama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_kerjasama" class="row">
                        @csrf
                        <div class="form-group col-12">
                            <label for="nama">Nama</label>
                            <input name="nama" id="nama" class="form-control">
                            <div class="invalid-feedback" id="nama-error">

                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="">Gambar</label>
                            <input type="file" class="form-control" name="gambar" id="gambar"
                                onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                            <div class="invalid-feedback " id='gambar-error'>

                            </div>
                        </div>
                        <div class="form-group col-sm-4 mb-2">
                            <img src="https://pjm.unibamadura.ac.id/logo/logo.png" id="ba" alt="your image"
                                width="100" height="100">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="kembali" data-dismiss="modal">Kembali</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kerjasama</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" class="row">
                        @csrf
                        <div class="form-group col-6">
                            <label for="nama">Nama</label>
                            <input type="hidden" name="id" id="id_kerjasama" class="form-control">
                            <input type="hidden" name="old_gambar" id="old_gambar" class="form-control">
                            <input name="nama" id="nama_edit" class="form-control">
                            <div class="invalid-feedback" id="nama_edit-error">

                            </div>
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="">Gambar</label>
                            <input type="file" class="form-control" name="gambar" id="gambar_edit"
                                onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                            <div class="invalid-feedback " id='gambar-error'>

                            </div>
                        </div>
                        <div class="form-group col-sm-4 mb-2">
                            <img id="ba_edit" alt="your image" width="100" height="100">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="kembali"
                        data-dismiss="modal">Kembali</button>
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
                    },
                ],
                processing: true,
                serverSide: true,
                type: 'post',
                ajax: {
                    url: "{{ route('kerjasama.index') }}",
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
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



        $("#add_form_kerjasama").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('kerjasama.store') }}";
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
                        $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                    } else {
                        toastr.success(response.message);

                        $('#modal_kerjasama').modal('hide');
                        $("#add_form_kerjasama")[0].reset(); // Fix here
                        $('#example1').DataTable().ajax.reload();
                        $('#ba').attr('src', 'https://pjm.unibamadura.ac.id/logo/logo.png')

                    }
                },
            });
        });
        // modal edit
        $('#example1').on('click', '.edit_inline', function() {
            var rowId = $(this).data('id');
            console.log(rowId);

            $.ajax({
                type: 'GET',
                data: 'data=' + rowId,
                url: "{{ route('kerjasama.getData') }}",
                dataType: 'json',
                success: function(response) {
                    console.log(response.data);
                    $('#id_kerjasama').val(response.data.id);
                    $('#old_gambar').val(response.data.gambar);
                    $('#nama_edit').val(response.data.nama);
                    $('#ba_edit').attr('src', "{{ asset('gambar_kerjasama') }}/" + response.data
                    .gambar);

                    // Show the editModal
                    $('#editModal').modal('show');
                },
            });
        });

        $('#edit_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ route('kerjasama.updated') }}";
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
                        $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                        $('#btn_add').prop('disabled', false);

                    } else {
                        toastr.success(response.message);
                        $('#btn_add').prop('disabled', false);
                        $('#editModal').modal('hide');
                        $("#edit_form")[0].reset();
                        $('#example1').DataTable().ajax.reload();
                    }
                },
            });
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
                            url: "{{ route('kerjasama.delete') }}",
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
