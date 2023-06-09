<?php

include 'koneksi.php';

session_start();

if(isset($_POST['submit'])){

   $username = mysqli_real_escape_string($koneksi, $_POST['username']);
   $namalengkap = ($_POST['nama']);
   $username = ($_POST['username']);
   $email = ($_POST['email']);
   $nomortelepon = ($_POST['nomor']);
   $password = ($_POST['password']);
   $cpass = ($_POST['cpass']);
   $gender = ($_POST['gender']);

   $select = " SELECT * FROM identitas WHERE namalengkap = '$namalengkap' && username = '$username' && email = '$email' && nomortelepon = '$nomortelepon' && password = '$password' && gender = '$gender' ";

   $result = $koneksi->query($select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'user already exist';
   }else{
      if($password != $cpass){
         $error[] = 'password not mathched!';
      }else{
         $insert = "INSERT INTO identitas(namalengkap, username, email, nomortelepon, password, gender) VALUES('$namalengkap','$username','$email','$nomortelepon','$password','$gender')";
         $koneksi->query($insert);
         header('location:Login2.php');
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale1.0">
    <title>Halaman | Buat Akun</title>
    <link rel="stylesheet" href="regis.css">
</head>
<?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
<body>
    <div class="container">
        <div class="title">Buat Akun</div>
        <div class="content">
            <form action="regis.php" method="post">
                <div class="user-details">
                    <div class="input-inbox">
                        <span class="detais">Nama Lengkap</span>
                        <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required>
                    </div>

                    <div class="input-inbox">
                        <span class="detais">Username</span>
                        <input type="text" name="username" placeholder="Masukkan Username" required>
                    </div>

                    <div class="input-inbox">
                        <span class="detais">Email</span>
                        <input type="text" name="email" placeholder="Masukkan Email" required>
                    </div>

                    <div class="input-inbox">
                        <span class="detais">Nomor Telepon</span>
                        <input type="text" name="nomor" placeholder="Masukkan Nomor Telepon" required>
                    </div>

                    <div class="input-inbox">
                        <span class="detais">Password</span>
                        <input type="text" name="password" placeholder="Masukkan Password" required>
                    </div>

                    <div class="input-inbox">
                        <span class="detais">Ulangi Password</span>
                        <input type="text" name="cpass" placeholder="Masukkan Ulangi Password" required>
                    </div>
                </div>
                <div class="gender-details">
                    <input type="radio" name="gender" id="dot-1">
                    <input type="radio" name="gender" id="dot-2">
                    <span class="gender-title">Jenis Kelamin</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Pria</span>
                        </label>

                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Wanita</span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Daftar" name="submit">
                </div>
            </form>
        </div>
        </div>
    </div>
</body>
</html>