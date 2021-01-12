<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/plugins/sparklines/sparkline.js') ?>"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
<!-- DataTables -->
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url(); ?>assets/js/myscript.js"></script>
<script src="<?= base_url(); ?>assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('assets/dist/js/pages/dashboard.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/dist/js/demo.js') ?>"></script>
<!-- file select2 -->
<script src="<?= base_url('assets/js/select2.js') ?>"></script>
<!-- link base_url javascript -->
<script src="<?= base_url('assets/js/base_url.js') ?>"></script>
</body>

<script>
    $(document).ready(function() {
        var base_url = baseurl();

        function toast() {
            const flashData = $(".flash-data1").html();
            const errorData = $(".error-data1").html();

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 5000,
            });

            if (flashData == "Login" || flashData == "Logout") {
                Toast.fire({
                    icon: "success",
                    title: "Anda Berhasil " + flashData,
                });
            } else if (flashData) {
                Toast.fire({
                    icon: "success",
                    title: flashData,
                });
            } else if (errorData) {
                Toast.fire({
                    icon: "error",
                    title: errorData,
                });
            }
        }

        // Tabel Mata Kuliah
        $('#myTableMatkul').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?php echo base_url('mata_kuliah/get_matakuliah') ?>",
                type: 'post',
                dataType: 'json'
            },
            "columns": [{
                    data: "nm_matkul",
                    class: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "nm_matkul",
                    class: "text_center"
                },
                {
                    data: "sks",
                    class: "text_center"
                },
                {
                    data: "semester",
                    class: "text_center"
                },
                {
                    data: "nm_jurusan",
                    class: "text_center"
                },
                {
                    data: "aksi",
                    class: "text-center",
                    width: 150,
                    orderable: false
                }
            ],
        });

        $("#addMataKuliah").submit(function(e) {
            e.preventDefault();
            let dataString = $('#addMataKuliah').serialize();

            $.ajax({
                url: "<?php echo base_url("mata_kuliah/add_mata_kuliah") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.toast.response == "success") {
                        $('#tambah_matkul').modal('hide');
                        $('#myTableMatkul').DataTable().ajax.reload();
                        $('#addMataKuliah')[0].reset();
                        $("#kd_matkul").val(data.kd_matkul);
                        $(".flash-data1").html(data.toast.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.toast.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        });

        $('#myTableMatkul').on('click', '.edit_record', function() {
            let id = $(this).data('id');

            getMataKuliah(id, "Edit");
        });

        $('#myTableMatkul').on('click', '.hapus_record', function() {
            let id = $(this).data('id');

            getMataKuliah(id, "Delete");
        });

        function getMataKuliah(id, action) {
            $.ajax({
                url: "<?php echo base_url("mata_kuliah/getMataKuliahById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_mata_kuliah": id
                },
                success: function(data) {
                    console.log(data);
                    if (action == "Edit") {
                        $("#kd_matkul_edit").val(data.kd_mata_kuliah);
                        $("#nm_matkul_edit").val(data.nm_matkul);
                        $("#sks_edit").val(data.sks);
                        $("#semester_edit").val(data.semester);
                        $("#jurusan_edit")
                            .select2()
                            .val(data.jurusan)
                            .trigger("change");
                    }
                }
            });
            $('#Modal_' + action).modal({
                backdrop: 'static',
                keyboard: false
            })
        }

        $("#editMataKuliah").submit(function(e) {

            e.preventDefault();
            let dataString = $('#editMataKuliah').serialize();

            $.ajax({
                url: "<?php echo base_url("mata_kuliah/edit_mata_kuliah") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Edit').modal('hide');
                        $('#myTableMatkul').DataTable().ajax.reload();
                        $('#editMataKuliah')[0].reset();
                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })

        $("#hapusMataKuliah").submit(function(e) {
            e.preventDefault();
            let id = $('#product_code_delete').val();

            $.ajax({
                url: "<?php echo base_url("mata_kuliah/delete_mata_kuliah") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_mata_kuliah": id,
                },
                success: function(data) {

                    if (data.response == "success") {
                        $('#myTableMatkul').DataTable().ajax.reload();
                        $('#Modal_Delete').modal('hide');
                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        });
        // End Mata Kuliah

        // Tabel Mahasiswa
        $('#myTableMahasiswa').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?php echo base_url('mahasiswa/get_mahasiswa') ?>",
                type: 'post',
                dataType: 'json'
            },
            "columns": [{
                    data: "nm_mahasiswa",
                    class: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "nm_mahasiswa",
                    class: "text_center"
                },
                {
                    data: "semester",
                    class: "text_center"
                },
                {
                    data: "nm_jurusan",
                    class: "text_center"
                },
                {
                    data: "aksi",
                    class: "text-center",
                    width: 150,
                    orderable: false
                }
            ],
        });

        $("#addMahasiswa").submit(function(e) {
            e.preventDefault();
            let dataString = $('#addMahasiswa').serialize();

            $.ajax({
                url: "<?php echo base_url("mahasiswa/add_mahasiswa") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.toast.response == "success") {
                        $('#tambah_mahasiswa').modal('hide');
                        $('#myTableMahasiswa').DataTable().ajax.reload();
                        $('#addMahasiswa')[0].reset();
                        $("#kd_mahasiswa").val(data.kd_mahasiswa);
                        $(".flash-data1").html(data.toast.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.toast.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        });

        $('#myTableMahasiswa').on('click', '.edit_record', function() {
            let id = $(this).data('id');

            getMahasiswa(id, "Edit");
        });

        $('#myTableMahasiswa').on('click', '.hapus_record', function() {
            let id = $(this).data('id');

            getMahasiswa(id, "Delete");
        });

        function getMahasiswa(id, action) {
            $.ajax({
                url: "<?php echo base_url("mahasiswa/getMahasiswaById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_mahasiswa": id
                },
                success: function(data) {
                    console.log(data);
                    if (action == "Edit") {
                        $("#kd_mahasiswa_edit").val(data.no_mahasiswa);
                        $("#nm_mahasiswa_edit").val(data.nm_mahasiswa);
                        $("#semester_edit").val(data.semester);
                        $("#jurusan_edit").val(data.jurusan);
                    }
                }
            });
            $('#Modal_' + action).modal({
                backdrop: 'static',
                keyboard: false
            })
        }

        $("#editMahasiswa").submit(function(e) {

            e.preventDefault();
            let dataString = $('#editMahasiswa').serialize();

            $.ajax({
                url: "<?php echo base_url("mahasiswa/edit_mahasiswa") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Edit').modal('hide');
                        $('#myTableMahasiswa').DataTable().ajax.reload();
                        $('#editMahasiswa')[0].reset();
                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })

        $("#hapusMahasiswa").submit(function(e) {
            e.preventDefault();
            let id = $('#product_code_delete').val();

            $.ajax({
                url: "<?php echo base_url("mahasiswa/delete_mahasiswa") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_mahasiswa": id,
                },
                success: function(data) {

                    if (data.response == "success") {
                        $('#myTableMahasiswa').DataTable().ajax.reload();
                        $('#Modal_Delete').modal('hide');
                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        });
        // End Mahasiswa

        // Tabel Jurusan
        $('#myTableJurusan').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?php echo base_url('jurusan/get_jurusan') ?>",
                type: 'post',
                dataType: 'json'
            },
            "columns": [{
                    data: "nm_jurusan",
                    class: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "nm_jurusan",
                    class: "text_center"
                },
                {
                    data: "aksi",
                    class: "text-center",
                    width: 150,
                    orderable: false
                }
            ],
        });

        $("#addJurusan").submit(function(e) {
            e.preventDefault();
            let dataString = $('#addJurusan').serialize();

            $.ajax({
                url: "<?php echo base_url("jurusan/add_jurusan") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.toast.response == "success") {
                        $('#tambah_jurusan').modal('hide');
                        $('#myTableJurusan').DataTable().ajax.reload();
                        $('#addJurusan')[0].reset();
                        $("#kd_jurusan").val(data.kd_jurusan);
                        $(".flash-data1").html(data.toast.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.toast.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        });

        $('#myTableJurusan').on('click', '.edit_record', function() {
            let id = $(this).data('id');

            getJurusan(id, "Edit");
        });

        $('#myTableJurusan').on('click', '.hapus_record', function() {
            let id = $(this).data('id');

            getJurusan(id, "Delete");
        });

        function getJurusan(id, action) {
            $.ajax({
                url: "<?php echo base_url("jurusan/getJurusanById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_jurusan": id
                },
                success: function(data) {
                    console.log(data);
                    if (action == "Edit") {
                        $("#kd_jurusan_edit").val(data.kd_jurusan);
                        $("#nm_jurusan_edit").val(data.nm_jurusan);
                    }
                }
            });
            $('#Modal_' + action).modal({
                backdrop: 'static',
                keyboard: false
            })
        }

        $("#editJurusan").submit(function(e) {

            e.preventDefault();
            let dataString = $('#editJurusan').serialize();

            $.ajax({
                url: "<?php echo base_url("jurusan/edit_jurusan") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $('#Modal_Edit').modal('hide');
                        $('#myTableJurusan').DataTable().ajax.reload();
                        $('#editJurusan')[0].reset();
                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })

        $("#hapusJurusan").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?php echo base_url("jurusan/delete_jurusan") ?>",
                type: 'post',
                dataType: 'json',
                success: function(data) {

                    if (data.response == "success") {
                        $('#myTableJurusan').DataTable().ajax.reload();
                        $('#Modal_Delete').modal('hide');
                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        }); //End Jurusan

        // Transkrip Nilai
        $('#myTableTranskrip').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?php echo base_url('transkrip_nilai/get_transkrip') ?>",
                type: 'post',
                dataType: 'json'
            },
            "columns": [{
                    data: "nm_mahasiswa",
                    class: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "nm_mahasiswa",
                    class: "text_center"
                },
                {
                    data: "semester",
                    class: "text_center"
                },
                {
                    data: "nm_jurusan",
                    class: "text_center"
                },
                {
                    data: "aksi",
                    class: "text-center",
                    width: 150,
                    orderable: false
                }
            ],
        });

        $("#cariDataTranskrip").click(function() {
            var mahasiswa = $("#mahasiswa").val();
            if (mahasiswa) {
                $.ajax({
                    url: "<?php echo base_url("transkrip_nilai/cari_data") ?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'no_mahasiswa': $("#mahasiswa").val(),
                        'semester': $("#semester").val(),
                    },

                    success: function(data) {
                        if (data.data.length > 0) {
                            $(".flash-data1").html("Pencarian Ditemukan");
                            $(".error-data1").html("");
                            $("#add_mtkl").show();
                            // var html = '<div class="row"><div class="col-md-6"><div class="form-group"><label for="mata_kuliah">Pilih Mata Kuliah</label><select name="mata_kuliah[]" id="mata_kuliah" class="select2matkul form-control"></select></div></div><div class="col-md-4"><div class="form-group"><label for="mata_kuliah">Pilih Mata Kuliah</label><input type="text" name="jml_mutu[]" id="jml_mutu1" class="form-control" placeholder="Masukan Jumlah Mutu"></div></div><div class="col-md-2"><label for="kd_supplier"></label><br><button type="button" class="btn btn-success mt-2"> Tambah Matkul</button></div></div><button type="button" class="btn btn-primary mt-4">Save Data</button>';
                            // $("#hapusmtl1").append(html)
                        } else {
                            $(".error-data1").html("Tidak Ada Mata Kuliah Yang Terdaftar Untuk Semester " + $("#semester").val() + " dan jurusan " + data.jurusan);
                            $(".flash-data1").html("");
                        }
                        toast();
                    }
                });
            } else {
                $(".error-data1").html("Mahasiswa Harus Dipilih, Tidak Boleh Kosong!");
                $(".flash-data1").html("");
                toast();
            }
        })

        $("#tmbhfieldtranskrip").click(function() {
            var looping = parseInt($("#jmlbarang1").val()) + 1;
            var record = 1;
            var maxGroupbarang = 10;

            if (looping <= maxGroupbarang && record != maxGroupbarang) {
                $("#jmlbarang1").val(looping);
                $("#jumrecord").val(parseInt(record) + 1);

                var indexPlus = parseInt($("#jmlbarangplus").val());
                var indexMinus = parseInt($("#jmlbarangminus").val());

                for (let i = looping; i <= looping; i++) {
                    if (i != looping) continue;

                    indexMinus = i;
                    $("#jmlbarangminus").val(indexMinus);
                    i = ++indexPlus;
                    $("#jmlbarangplus").val(i);

                    var copy1 =
                        '<div id="bagianTranskriphapus' +
                        i +
                        '"><hr id="hr"> <div class="form-group"></div> <div class="row"><div class="col-md-6"><div class="form-group"><label for="mata_kuliah">Pilih Mata Kuliah</label><select name="mata_kuliah[]" id="mata_kuliah' +
                        i +
                        '" class="select2matkulwhere' +
                        i + ' form-control"></select></div></div><div class="col-md-4"><div class="form-group"><label for="mata_kuliah">Pilih Mata Kuliah</label><select name="jml_mutu[]" class="select2mutu' + i + ' form-control" id="jml_mutu' + i + '" class="form-control">' +
                        '<option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option></select></div></div><div class="col-md-2"><label for="kd_supplier"></label><br><a href="javascript:void(0)" class="btn btn-danger mt-2" id="hapusfieldtranskrip' + i + '"> <i class="fa fa-minus"></i> </a></div></div></div>';

                    $("#bagianTranskrip").append(copy1);

                    $(".select2mutu" + i).select2();

                    $(".select2matkulwhere" + i).select2({
                        placeholder: "Pilih Mata Kuliah",
                        ajax: {
                            url: base_url + "/mata_kuliah/get_json_where",
                            type: "post",
                            dataType: "json",
                            delay: 100,
                            data: function(params) {
                                return {
                                    searchTerm: params.term,
                                    no_mahasiswa: $("#mahasiswa").val(),
                                    semester: $("#semester").val(),
                                };
                            },
                            processResults: function(response) {
                                return {
                                    results: response,
                                };
                            },
                            cache: true,
                        },
                    });

                    $("body").on("click", "#hapusfieldtranskrip" + i, function() {
                        $("#jmlbarang1").val(parseInt($("#jmlbarang1").val()) - 1);

                        $(this)
                            .parents("#bagianTranskriphapus" + i)
                            .remove();
                    });
                }
            } else {
                // alert('Hanya Boleh '+batasbarang+' kali menambahkan.');
                $(".error-data1").html("Tidak Bisa Menambah Lagi");
                $(".flash-data1").html("");

                toast();
            }
        })

        $("#addTranskrip").submit(function(e) {
            e.preventDefault();

            let dataString = $('#addTranskrip').serialize();

            $.ajax({
                url: "<?php echo base_url("transkrip_nilai/add_transkrip_nilai") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {
                    if (data.response == "success") {
                        $("#kd_matkul").val(data.kd_matkul);
                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();

                    if (data.response == "success") {
                        setTimeout(function() {
                            window.location.href = "<?php echo base_url() ?>transkrip_nilai";
                        }, 500);
                    }
                }
            });
        })

        $('#myTableTranskrip').on('click', '.detail_record', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "<?php echo base_url("transkrip_nilai/getTranskripById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_transkrip": id
                },
                success: function(data) {
                    console.log(data);
                    var html1 = "",
                        html2 = "";

                    $("#transkripnilai").html("Berikut Adalah Detail Transkrip Nilai " + data[0].nm_mahasiswa);

                    html1 += '<tbody>' +
                        '<tr>' +
                        '<td width="30%">Nama Mahasiswa </td>' +
                        '<td width="5%"> : </td>' +
                        '<td>' + data[0].nm_mahasiswa + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td width="30%">No. Mahasiswa </td>' +
                        '<td width="5%"> : </td>' +
                        '<td>' + data[0].no_mahasiswa + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td width="30%">Semester </td>' +
                        '<td width="5%"> : </td>' +
                        '<td>' + data[0].semester + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td width="30%">Jurusan </td>' +
                        '<td width="5%"> : </td>' +
                        '<td>' + data[0].nm_jurusan + '</td>' +
                        '</tr>' +
                        '</tbody>';

                    $(".body-detail-data").html(html1);

                    data.forEach(data => {
                        console.log(data);
                        html2 += '<tr>' +
                            '<td>' + data.nm_matkul + '</td>' +
                            '<td>' + data.mutu_matkul + '</td>' +
                            '</tr>' +
                            '</div>';

                        $(".body-detail-transkrip").html(html2);

                    });

                    $('#Modal_Detail').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
                }
            });
        });

        $('#myTableTranskrip').on('click', '.edit_record', function() {
            let id = $(this).data('id');

            getTranskripNilai(id, "Edit");
        });

        $('#myTableTranskrip').on('click', '.hapus_record', function() {
            let id = $(this).data('id');

            getTranskripNilai(id, "Delete");
        });

        function getTranskripNilai(id, action) {
            $.ajax({
                url: "<?php echo base_url("transkrip_nilai/getTranskripById") ?>",
                type: 'post',
                dataType: 'json',
                data: {
                    "kd_transkrip": id
                },
                success: function(data) {
                    if (action == "Edit") {

                        var text1 = "";
                        var text3 = "";
                        var text4 = "";
                        var text5 = "";

                        $("#mahasiswa").val(data[0].no_mahasiswa);
                        $("#kd_detail_transkrip1").val(data[0].kd_detail);
                        $("#semester").val(data[0].semester);
                        text1 += '<option value="' + data[0].kd_matkul + '">' + data[0].nm_matkul + '</option>';
                        $("#mata_kuliah1").html(text1)
                        $("#jml_mutu1")
                            .select2()
                            .val(data[0].mutu_matkul)
                            .trigger("change");

                        if (data.length > 1) {
                            for (let i = 2; i <= data.length; i++) {

                                var j = i;
                                j--

                                text3 += '<div id="bagianTranskriphapus' + i + '"><hr id="hr"> <div class="form-group">' +
                                    '<div class="row" > ' +
                                    '<div class="col-md-6">' +
                                    '<input type="hidden" name="kd_detail_transkrip[]" value="' + data[j].kd_detail + '" id="kd_detail_transkrip' + i + '">' +
                                    '<div class="form-group">' +
                                    '<label for="mata_kuliah">Pilih Mata Kuliah</label>' +
                                    '<select name="emata_kuliah[]" id="mata_kuliah' + i + '" class="select2matkulwhere' + i + ' form-control"></select>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-md-4">' +
                                    '<div class="form-group">' +
                                    '<label for="mata_kuliah">Pilih Mata Kuliah</label>' +
                                    '<select name="ejml_mutu[]" class="select2mutu' + i + ' form-control" id="jml_mutu' + i + '">' +
                                    '<option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option>' +
                                    '</select>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-md-2">' +
                                    '<label for="kd_supplier"></label><br>' +
                                    '<a href="javascript:void(0)" class="btn btn-danger mt-2" id="hapusfieldtranskrip' + i + '"> <i class="fa fa-minus"></i> </a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';

                                var tampungan = [];

                                $("body").on("click", "#hapusfieldtranskrip" + i, function() {
                                    alert(i);
                                    $("#jmlbarang1").val(parseInt($("#jmlbarang1").val()) - 1);

                                    var kd_detail = $("#kd_detail_transkrip" + i).val();

                                    tampungan.push(kd_detail);

                                    $("#tmpng_detail_hapus1").val(tampungan);

                                    // $(this)
                                    //     .parents("#bagianTranskriphapus" + i)
                                    //     .remove();
                                    $("#bagianTranskriphapus" + i).remove()
                                });

                                $("#editDataTranskrip").html(text3);

                                $(".select2mutu" + i).select2();

                                $(".select2matkulwhere" + i).select2({
                                    placeholder: "Pilih Mata Kuliah",
                                    ajax: {
                                        url: base_url + "/mata_kuliah/get_json_where",
                                        type: "post",
                                        dataType: "json",
                                        delay: 100,
                                        data: function(params) {
                                            return {
                                                searchTerm: params.term,
                                                no_mahasiswa: $("#mahasiswa").val(),
                                                semester: $("#semester").val(),
                                            };
                                        },
                                        processResults: function(response) {
                                            return {
                                                results: response,
                                            };
                                        },
                                        cache: true,
                                    },
                                });

                                text4 += '<option value="' + data[j].kd_matkul + '">' + data[j].nm_matkul + '</option>';

                                $("#mata_kuliah" + i).html(text4)
                                $("#jml_mutu" + i)
                                    .select2()
                                    .val(data[j].mutu_matkul)
                                    .trigger("change");
                            }

                        }
                    }
                }
            });
            $('#Modal_' + action).modal({
                backdrop: 'static',
                keyboard: false
            })
        }

        $("#EditTranskrip").submit(function(e) {
            e.preventDefault();

            let dataString = $('#EditTranskrip').serialize();

            $.ajax({
                url: "<?php echo base_url("transkrip_nilai/edit_transkrip_nilai") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,
                success: function(data) {

                    if (data.response == "success") {
                        $('#myTableMatkul').DataTable().ajax.reload();
                        $('#Modal_Edit').modal('hide');
                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        });

        $("#hapusTranskrip").submit(function(e) {
            e.preventDefault();

            let dataString = $('#hapusTranskrip').serialize();

            $.ajax({
                url: "<?php echo base_url("transkrip_nilai/delete_transkrip_nilai") ?>",
                type: 'post',
                dataType: 'json',
                data: dataString,

                success: function(data) {

                    if (data.response == "success") {
                        $('#myTableTranskrip').DataTable().ajax.reload();
                        $('#Modal_Delete').modal('hide');
                        $(".flash-data1").html(data.message);
                        $(".error-data1").html("");
                    } else {
                        $(".error-data1").html(data.message);
                        $(".flash-data1").html("");
                    }
                    toast();
                }
            });
        })

        // Report
        $('#report_mahasiswa').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?php echo base_url('transkrip_nilai/get_transkrip') ?>",
                type: 'post',
                dataType: 'json'
            },
            "columns": [{
                    data: "nm_mahasiswa",
                    class: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "nm_mahasiswa",
                    class: "text_center"
                },
                {
                    data: "semester",
                    class: "text_center"
                },
                {
                    data: "nm_jurusan",
                    class: "text_center"
                },
            ],
        });

        $('#mahasiswa_rpt').on('change', function() {
            var mahasiswa = $('#mahasiswa_rpt').val();
            $('#report_mahasiswa').DataTable().destroy();
            report_mahasiswa(mahasiswa);
        });

        function report_mahasiswa(mahasiswa = '') {
            var dataTable = $('#report_mahasiswa').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?php echo base_url("report/get_datatable_mahasiswa") ?>",
                    type: "POST",
                    data: {
                        mahasiswa: mahasiswa
                    }
                },
                "columns": [{
                        data: "nm_mahasiswa",
                        class: "text-center",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "nm_mahasiswa",
                        class: "text_center"
                    },
                    {
                        data: "semester",
                        class: "text_center"
                    },
                    {
                        data: "nm_jurusan",
                        class: "text_center"
                    },
                ],
            });
        }

        $('#buttonpdfmahasiswa').on('click', function() {
            var mahasiswa = $('#mahasiswa_rpt').val();

            if (mahasiswa == "" || mahasiswa == null) {
                mahasiswa = "0";
            }
            window.location.href = "<?php echo base_url() ?>report/pdf_mahasiswa/" + mahasiswa;
        });


    }) // End Document Ready
</script>

</html>