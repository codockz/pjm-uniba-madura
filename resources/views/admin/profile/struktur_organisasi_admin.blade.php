@extends('layouts.app')
@section('content')
    <style>
        .preview-img {
            max-height: 400px;
            object-fit: contain;
        }

        <style>.toast-success {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #5cb85c;
            color: #fff;
            padding: 15px 20px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            z-index: 9999;
            box-shadow: 0 6px 15px rgba(0, 0, 0, .2);
            animation: slideIn 0.4s ease;
        }

        .toast-success i {
            font-size: 20px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Upload Struktur Organisasi</h3>
            </div>

            <div class="card-body text-center">


                <form method="POST" action="{{ route('admin_struktur_organisasi.upload') }}" enctype="multipart/form-data">
                    @csrf

                    <img id="preview" src="{{ asset('storage/struktur/struktur.png') }}"
                        onerror="this.src='{{ asset('images/default-struktur.png') }}'"
                        class="img-thumbnail mb-3 preview-img">


                    <input type="file" name="gambar" class="form-control mb-3" accept="image/*"
                        onchange="previewImage(event)">

                    <button class="btn btn-primary">
                        Simpan / Ganti Gambar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('preview').src = e.target.result;
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
