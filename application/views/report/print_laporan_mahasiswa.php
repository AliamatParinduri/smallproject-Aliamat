<!DOCTYPE html>
<html>

<head>

    <title><?= $judul ?></title>
    <style type="text/css">
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        td {
            font-size: 10px;
        }

        th {
            font-size: 10px;
        }
    </style>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
</head>

<body>

    <div class="page-content">
        <div class="container-fluid">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div align="center" class="header-mail">
                                    </div>
                                    <center>
                                        <h5>
                                            <b><?= $judul; ?></b><br>
                                            <!-- ganti dengan bahasa arab yang sama kaya formatnya-->
                                        </h5>
                                    </center>
                                    <hr width="100%" color="orange" style="border:solid; color:#000080;">
                                    <?php foreach ($mahasiswa as $mhs) { ?>
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr style=" width: 100%;">
                                                    <th>No. Mahasiswa</th>
                                                    <th> : </th>
                                                    <th><?= $mhs['no_mahasiswa'] ?></th>
                                                </tr>
                                                <tr style=" width: 100%;">
                                                    <th>Nama Mahasiswa</th>
                                                    <th> : </th>
                                                    <th><?= $mhs['nm_mahasiswa'] ?></th>
                                                </tr>
                                                <tr style=" width: 100%;">
                                                    <th>Semester</th>
                                                    <th> : </th>
                                                    <th><?= $mhs['semester'] ?></th>
                                                </tr>
                                                <tr style=" width: 100%;">
                                                    <th>Jurusan</th>
                                                    <th> : </th>
                                                    <th><?= $mhs['nm_jurusan'] ?></th>
                                                </tr>
                                            </tbody>

                                        </table>
                                        <br><br>
                                        <?php
                                        $no = 1;

                                        $this->db->select("*, sum(mata_kuliah.sks) as jmlsks");
                                        $this->db->from("transkrip_nilai");
                                        $this->db->join("detail_transkrip_nilai", "transkrip_nilai.kd_transkrip_nilai=detail_transkrip_nilai.kd_transkrip_nilai");
                                        $this->db->join("mahasiswa", "transkrip_nilai.no_mahasiswa=mahasiswa.no_mahasiswa");
                                        $this->db->join("mata_kuliah", "detail_transkrip_nilai.kd_matkul=mata_kuliah.kd_mata_kuliah");
                                        $this->db->where('mahasiswa.no_mahasiswa', $mhs['no_mahasiswa']);
                                        $data = $this->db->get()->result_array();
                                        ?>

                                        <table class="table table-hover table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>No. </th>
                                                    <th>Kode Mata Kuliah </th>
                                                    <th>Nama Mata Kuliah </th>
                                                    <th>SKS </th>
                                                    <th>Huruf Mutu </th>
                                                    <th>Angka Mutu </th>
                                                    <th>Nilai Mutu </th>
                                                </tr>
                                                <?php $asum = []; ?>
                                                <?php foreach ($data as $dt) { ?>

                                                    <?php
                                                    switch ($dt['mutu_matkul']) {
                                                        case 'A':
                                                            $angka = 4;
                                                            $nilai_mutu = $angka * $dt['sks'];
                                                            break;
                                                        case 'B':
                                                            $angka = 3;
                                                            $nilai_mutu = $angka * $dt['sks'];
                                                            break;
                                                        case 'C':
                                                            $angka = 2;
                                                            $nilai_mutu = $angka * $dt['sks'];
                                                            break;
                                                        case 'D':
                                                            $angka = 1;
                                                            $nilai_mutu = $angka * $dt['sks'];
                                                            break;
                                                        case 'E':
                                                            $angka = 0;
                                                            $nilai_mutu = 0;
                                                            break;
                                                    }

                                                    array_push($asum, $nilai_mutu)
                                                    ?>

                                                    <tr>
                                                        <td><?= $no++ ?> </td>
                                                        <td><?= $dt['kd_mata_kuliah'] ?> </td>
                                                        <td><?= $dt['nm_matkul'] ?> </td>
                                                        <td><?= $dt['sks'] ?> </td>
                                                        <td><?= $dt['mutu_matkul'] ?> </td>
                                                        <td><?= $angka ?> </td>
                                                        <td><?= $nilai_mutu ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                        <td><?= $dt['jmlsks'] ?></td>
                                                        <td colspan="2"></td>
                                                        <td><?= array_sum($asum) ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>

                                        </table>

                                        <br>
                                        <table>
                                            <dt>
                                                <tr>
                                                    <th style="font-size: 14px;">Indek Prestasi (IP)</th>
                                                    <th style="font-size: 14px;"> : </th>
                                                    <th style="font-size: 14px;"><?= array_sum($asum) / $dt['jmlsks'] ?></th>
                                                </tr>
                                                <tr>
                                                    <th style="font-size: 14px;">Total SKS</th>
                                                    <th style="font-size: 14px;"> : </th>
                                                    <th style="font-size: 14px;"><?= $dt['jmlsks'] . " SKS" ?></th>
                                                </tr>
                                            </dt>
                                        </table>

                                        <br>
                                        <table>
                                            <tr>
                                                <th style="font-size: 14px;" style="font-size: 15px;" colpan="3" width="20%">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 14px;" width="20%">A</th>
                                                <th style="font-size: 14px;" width="20%"> : </th>
                                                <th style="font-size: 14px;" width="20%">4</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 14px;" width="20%">B</th>
                                                <th style="font-size: 14px;" width="20%"> : </th>
                                                <th style="font-size: 14px;" width="20%">3</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 14px;" width="20%">C</th>
                                                <th style="font-size: 14px;" width="20%"> : </th>
                                                <th style="font-size: 14px;" width="20%">2</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 14px;" width="20%">D</th>
                                                <th style="font-size: 14px;" width="20%"> : </th>
                                                <th style="font-size: 14px;" width="20%">1</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 14px;" width="20%">E</th>
                                                <th style="font-size: 14px;" width="20%"> : </th>
                                                <th style="font-size: 14px;" width="20%">0</th>
                                            </tr>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</body>

</html>

<script>
    window.print();
</script>