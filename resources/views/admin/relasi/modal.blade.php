<!-- Modal -->
<div class="modal fade" id="modal-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id">
                        <div class="col-md-12 col-12 mb-3">
                            <label>Nama Relasi</label>
                            <input class="form-control" name="nama_relasi" placeholder="Masukan Nama Relasi">
                            <span class="text-danger">
                                <strong id="nama_relasi"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Alamat</label>
                            <input class="form-control" name="alamat" placeholder="Masukan Alamat">
                            <span class="text-danger">
                                <strong id="alamat"></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- basic modal end -->