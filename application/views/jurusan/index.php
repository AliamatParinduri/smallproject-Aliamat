<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $judul ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $judul ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_jurusan">
                                    Tambah Jurusan
                                </button>
                            </div>
                            <br>
                            <table class="table table-striped table-hover table-bordered" id="myTableJurusan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Jurusan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<form id="addJurusan" autocomplete="off">
    <div class="modal fade" id="tambah_jurusan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kd_jurusan">Kode Jurusan</label>
                        <input type="text" name="kd_jurusan" id="kd_jurusan" class="form-control" value="<?= $kd_jurusan ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nm_jurusan">Nama Jurusan</label>
                        <input type="text" name="nm_jurusan" id="nm_jurusan" class="form-control" placeholder="Masukan Nama Jurusan" autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<form id="editJurusan" autocomplete="off">
    <div class="modal fade" id="Modal_Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kd_jurusan">Kode Jurusan</label>
                        <input type="text" name="kd_jurusan" id="kd_jurusan_edit" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nm_jurusan">Nama Jurusan</label>
                        <input type="text" name="nm_jurusan" id="nm_jurusan_edit" class="form-control" placeholder="Masukan Nama Jurusan" autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--MODAL DELETE-->
<form id="hapusJurusan">
    <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL DELETE-->