@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div id="alert"></div>
            <form id="user-edit">
                @csrf
                    <label for="">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name}}" id="name">
                    <div class="invalid-feedback" id="name-error">

                    </div>
                    <label for="">Password Lama</label>
                    <input type="password" name="old_password" class="form-control" id="old_password">
                    <div class="invalid-feedback" id="old_password-error">

                    </div>
                    <label for="">Password Baru</label>
                    <input type="password" name="new_password" class="form-control" id="new_password">
                    <div class="invalid-feedback" id="new_password-error">

                    </div>
                    <div class="invalid-feedback" id="new_password-error1">

                    </div>
                    <label for="">Konfirmasi Password Baru</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                    <div class="invalid-feedback" id="confirm_password-error">

                    </div>
                    <button type="submit" class="btn btn-primary mt-2 float-right">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#user-edit').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        var formData = $(this).serialize();

        $.ajax({
            url: '/user/update',
            method: 'POST',
            data: formData,
            success: function(response) {
                if(response.status == 200){
                    $('#alert').append(`<div class="alert alert-primary" role="alert">
                        ${response.message}
                    </div>`);
                }else{
                    $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner(
                                "<strong />");
                        });
                }
            },
        });
    });
});

$("#name").on('keyup',function (e) {
     $("#name").removeClass('is-invalid');
});
$("#old_password").on('keyup',function (e) {
     $("#old_password").removeClass('is-invalid');
});
$("#new_password").on('keyup',function (e) {
     $("#new_password").removeClass('is-invalid');
});
$("#confirm_password").on('keyup',function (e) {
     $("#confirm_password").removeClass('is-invalid');
});

</script>


@endsection
