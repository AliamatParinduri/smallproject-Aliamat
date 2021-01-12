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
    <form id="addTranskrip">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <br>
                                <div class="form-group">
                                    <label for="kd_transkrip">Kode Transkrip</label>
                                    <input type="text" name="kd_transkrip" id="kd_transkrip" class="form-control" value="<?= $kd_transkrip ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="mahasiswa">Pilih Mahasiswa</label>
                                    <select name="mahasiswa" id="mahasiswa" class="select2mahasiswa form-control"></select>
                                </div>
                                <div class="form-group">
                                    <label for="semester">Pilih Semester</label>
                                    <select name="semester" id="semester" class="select2semesterr form-control">
                                        <?php for ($i = 1; $i <= 8; $i++) { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <button type="button" id="cariDataTranskrip" class="btn btn-primary">Cari Data</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="add_mtkl" style="display: none;">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mata_kuliah">Pilih Mata Kuliah</label>
                                            <select name="mata_kuliah[]" id="mata_kuliah1" class="select2matkulwhere form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mata_kuliah">Pilih Mata Kuliah</label>
                                            <select name="jml_mutu[]" class="select2mutu form-control" id="jml_mutu">
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
                                        <button type="button" id="tmbhfieldtranskrip" class="btn btn-success mt-2"> Tambah Matkul</button>
                                    </div>
                                </div>

                                <div id="bagianTranskrip"></div>

                                <button type="submit" class="btn btn-primary mt-4">Save Data</button>

                            </div>
                        </div>
                    </div>

                    <!-- ini untuk max pembelian -->
                    <input type="hidden" id="jmlbarang" value="10">
                    <!-- ini untuk perhitungan looping di for nya -->
                    <input type="hidden" id="jmlbarang1" value="1">
                    <!-- ini untuk index pada pertambahan -->
                    <input type="hidden" id="jmlbarangplus" value="1">
                    <!-- ini untuk index pada pengurangan -->
                    <input type="hidden" id="jmlbarangminus" value="1">
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </form>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<form id="addMataKuliah" autocomplete="off">
    <div class="modal fade" id="tambah_matkul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Transkrip Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
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