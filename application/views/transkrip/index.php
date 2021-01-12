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
                            <br>
                            <table class="table table-striped table-hover table-bordered" id="myTableTranskrip">
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
<div class="modal fade" id="Modal_Detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Transkrip Nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <table class="table table-borderless body-detail-data">

                    </table>
                </div>
                <br>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Mata Kuliah</th>
                            <th>Huruf Mutu</th>
                        </tr>
                    </thead>
                    <tbody class="body-detail-transkrip">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<form id="EditTranskrip" autocomplete="off">
    <div class="modal fade" id="Modal_Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Transkrip Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="mahasiswa" id="mahasiswa">
                            <input type="hidden" name="semester" id="semester">
                            <div class="form-group">
                                <label for="mata_kuliah">Pilih Mata Kuliah</label>
                                <input type="hidden" name="kd_detail_transkrip[]" id="kd_detail_transkrip1">
                                <input type="hidden" name="tmpng_detail_hapus[]" id="tmpng_detail_hapus1">
                                <select name="emata_kuliah[]" id="mata_kuliah1" class="select2matkulwhere form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mata_kuliah">Pilih Mata Kuliah</label>
                                <select name="ejml_mutu[]" class="select2mutu form-control" id="jml_mutu1">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="kd_supplier"></label><br>
                            <button type="button" id="tmbhfieldtranskrip" class="btn btn-success mt-2"> Tambah</button>
                        </div>
                    </div>

                    <div id="editDataTranskrip"></div>


                    <div id="bagianTranskrip"></div>

                    <!-- ini untuk max pembelian -->
                    <input type="hidden" id="jmlbarang" value="10">
                    <!-- ini untuk perhitungan looping di for nya -->
                    <input type="hidden" id="jmlbarang1" value="<?= count($transkrip) ?>">
                    <!-- ini untuk index pada pertambahan -->
                    <input type="hidden" id="jmlbarangplus" value="<?= count($transkrip) ?>">
                    <!-- ini untuk index pada pengurangan -->
                    <input type="hidden" id="jmlbarangminus" value="1">
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
<form id="hapusTranskrip">
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