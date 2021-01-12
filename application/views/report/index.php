<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $judul; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <!-- <div class="card-header">
                            <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                        </div> -->
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="<?= base_url('report/produk_masuk') ?>" method="post">
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Pilih Mahasiswa</label>
                                        <select name="mahasiswa" id="mahasiswa_rpt" class="select2mahasiswa form-control"></select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <!-- <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div> -->
                        </form>
                    </div>

                </div>

            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <!--/.col (right) -->
        </div>
    </section>
    <!-- /.content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <a href="javascript:void(0);" id="buttonpdfmahasiswa" class="btn btn-warning"><i class="fa fa-download"></i> Download Pdf Report</a>
                            <br><br>
                            <table class="table table-hover text-nowrap table-striped table-bordered" id="report_mahasiswa">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Semester</th>
                                        <th>Jurusan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->