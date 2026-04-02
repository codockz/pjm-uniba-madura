<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Sertifikasi Dosen</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('sertifikasi_dosen.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Tahun Sertifikasi</label>
                        <input type="text" name="tahun" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Judul / Surat Keputusan</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Upload File (PDF)</label>
                        <input type="file" name="file" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
