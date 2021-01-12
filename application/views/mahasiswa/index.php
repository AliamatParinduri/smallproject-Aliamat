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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_mahasiswa">
                                    Tambah Mahasiswa
                                </button>
                            </div>
                            <br>
                            <table class="table table-striped table-hover table-bordered" id="myTableMahasiswa">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Semester</th>
                                        <th>Jurusan</th>
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
<form id="addMahasiswa" autocomplete="off">
    <div class="modal fade" id="tambah_mahasiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kd_mahasiswa">No. Mahasiswa</label>
                        <input type="text" name="kd_mahasiswa" id="kd_mahasiswa" class="form-control" value="<?= $kd_mahasiswa ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nm_mahasiswa">Nama Mahasiswa</label>
                        <input type="text" name="nm_mahasiswa" id="nm_mahasiswa" class="form-control" placeholder="Masukan Nama Mahasiswa" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" class="form-control">
                            <?php for ($i = 1; $i <= 8; $i++) {  ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select name="jurusan" id="jurusan" class="select2jurusan form-control"></select>
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
<form id="editMahasiswa" autocomplete="off">
    <div class="modal fade" id="Modal_Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kd_mahasiswa">Kode Mahasiswa</label>
                        <input type="text" name="kd_mahasiswa" id="kd_mahasiswa_edit" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nm_mahasiswa">Nama Mahasiswa</label>
                        <input type="text" name="nm_mahasiswa" id="nm_mahasiswa_edit" class="form-control" placeholder="Masukan Nama Mata Kuliah" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester_edit" class="form-control">
                            <?php for ($i = 1; $i <= 8; $i++) {  ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select name="jurusan" id="jurusan_edit" class="select2jurusan form-control">
                            <?php foreach ($jurusan as $jur) { ?>
                                <option value="<?= $jur->kd_jurusan ?>"><?= $jur->nm_jurusan ?></option>
                            <?php } ?>
                        </select>
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
<form id="hapusMahasiswa">
    <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Mata Kuliah</h5>
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