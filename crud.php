<?php
    //koneksi Database
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "register";

    //Buat Koneksi
    $koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

    //tombol simpan diklik
    if(isset($_POST['tsimpan'])){

        //data akan lama akan disimpan setelah diedit
        if(isset($_GET['hal']) == "edit") {
            //data akan diedit
            $edit = mysqli_query($koneksi, "UPDATE crud SET
                                                    namafilm = '$_POST[namafilm]',
                                                    namalengkap = '$_POST[namalengkap]',
                                                    email = '$_POST[email]',
                                                    nomort = '$_POST[nomort]',
                                                    gender = '$_POST[gender]',
                                                    tjumlah = '$_POST[tjumlah]',
                                                    twaktu = '$_POST[twaktu]',
                                                    ttanggal = '$_POST[ttanggal]'
                                            WHERE id = '$_GET[id]'
                                           ");
            //jika data simpan sukses
            if($edit){
                echo "<script>
                        alert('Edit Data Sukses!');
                        document.location='index.php';
                    </script>";            
            }else {
                echo "<script>
                        alert('Edit Data Gagal!');
                        document.location='index.php';
                    </script>";
            }
        }else{
            //data akan disimpan baru
            //data baru disimpan
        $simpan = mysqli_query($koneksi, " INSERT INTO crud (namafilm, namalengkap, email, nomort, gender, tjumlah, twaktu, ttanggal)
                                            VALUE (  '$_POST[namafilm]',
                                                    '$_POST[namalengkap]',
                                                    '$_POST[email]',
                                                    '$_POST[nomort]',
                                                    '$_POST[gender]',
                                                    '$_POST[tjumlah]',
                                                    '$_POST[twaktu]',
                                                    '$_POST[ttanggal]')
                              ");
            //jika data simpan sukses
            if($simpan){
                echo    "<script>
                            alert('Simpan Data Sukses!');
                            document.location='index.php';
                        </script>";            
            }else {
                echo    "<script>
                            alert('Simpan Data Gagal!');
                            document.location='index.php';
                        </script>";
            }
        }
    }

    //deklarasi variabel data yg akan diinput
    $vnamafilm = "";
    $vnamalengkap = "";
    $vemail = "";
    $vnomort = "";
    $vgender = "";
    $vtjumlah = "";
    $vtwaktu = "";
    $vttanggal = "";

    //tombol edit / hapus di klik
    if(isset($_GET['hal'])) {

        //tombol edit
        if($_GET['hal'] == "edit") {

            //tampilkan data yang aan diedit
            $tampil = mysqli_query($koneksi, "SELECT * FROM crud where id = '$_GET[id]'");
            $data = mysqli_fetch_array($tampil);
            if($data){
                //data ditemukan akan ditampung dalam variabel
                $vnamafilm = $data['namafilm'];
                $vnamalengkap = $data['namalengkap'];
                $vemail = $data['email'];
                $vnomort = $data['nomort'];
                $vgender = $data['gender'];
                $vtjumlah = $data['tjumlah'];
                $vtwaktu = $data['twaktu'];
                $vttanggal = $data['ttanggal'];
            }
        }else if ($_GET['hal'] == "hapus") {
            //hapus data
            $hapus = mysqli_query($koneksi, "DELETE  FROM crud where id = '$_GET[id]'");
            //jika data hapus sukses
            if($hapus){
                echo    "<script>
                            alert('Hapus Data Sukses!');
                            document.location='index.php';
                        </script>";            
            }else {
                echo    "<script>
                            alert('Hapus Data Gagal!');
                            document.location='index.php';
                        </script>";
            }
        }
    }
?>

<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman | Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3 class="text-center">CRUD</h3>
        <h3 class="text-center">PEMESANAN FILM</h3>

        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="card ">
                    <div class="card-header bg-info text-light">
                        Form input data Pengguna
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama Film</label>
                                <input type="text" name="namafilm" value="<?=$vnamafilm?>" class="form-control"
                                    placeholder="Masukkan Nama Film">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="namalengkap" value="<?=$vnamalengkap?>" class="form-control"
                                    placeholder="Masukkan Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="<?=$vemail?>" class="form-control"
                                    placeholder="Masukkan Email (example@gmail.com)">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No Telepon</label>
                                <input type="text" name="nomort" value="<?=$vnomort?>" class="form-control"
                                    placeholder="Masukkan Nomor Telepon">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender" aria-label="Default select example">
                                    <option selected>Pilih Gender</option>
                                    <option value="<?=$vgender?>"><?=$vgender?></option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Tiket</label>
                                        <input type="number" name="tjumlah" value="<?=$vtjumlah?>" class="form-control"
                                            placeholder="Masukkan Jumlah Tiket">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Waktu Penayangan</label>
                                        <input type="time" name="twaktu" value="<?=$vtwaktu?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Penayangan</label>
                                        <input type="date" name="ttanggal" value="<?=$vttanggal?>" class="form-control">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <hr>
                                    <button class="btn btn-primary" name="tsimpan">Simpan</button>
                                    <button class="btn btn-danger" name="tkosongkan">Kosongkan</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="card-footer bg-info">

                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-info text-light">
                Data barang
            </div>
            <div class="card-body">
                <div class="col-md-6 mx-auto">
                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="tcari" class="form-control" placeholder="Masukkan Kata Kunci">
                            <button class="btn btn-primary" name="tcari" type="submit">Cari</button>
                            <button class="btn btn-danger" name="treset" type="submit">Reset</button>
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>Nama Film</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Gender</th>
                        <th>Jumlah Tiket</th>
                        <th>Waktu Penayangan</th>
                        <th>Tanggal Penayangan</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                        //menampilkan data
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT * FROM crud order by id desc");
                        while($data = mysqli_fetch_array($tampil)) :
                    ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['namafilm'] ?></td>
                        <td><?= $data['namalengkap'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['nomort'] ?></td>
                        <td><?= $data['gender'] ?></td>
                        <td><?= $data['tjumlah'] ?></td>
                        <td><?= $data['twaktu'] ?></td>
                        <td><?= $data['ttanggal'] ?></td>
                        <td>
                            <a href="index.php?hal=edit&id=<?=$data['id']?>" class="btn btn-warning">Edit</a>

                            <a href="index.php?hal=hapus&id=<?=$data['id']?>" class="btn btn-danger" 
                            onclick="return confirm('Apakah anda yakin akan mengapus data ini?')" >Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                </table>



            </div>
            <div class="card-footer bg-info">

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="Diovantantra"></script>
</body>
</html>