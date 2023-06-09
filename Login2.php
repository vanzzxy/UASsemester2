
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Login2.css">
    <link rel="stylesheet" href="boxicons/css/boxicons.css">
    <title>Halaman | Login</title>
</head>
<body>
    <div class="box">
        <div class="container">
            <div class="top-header">
                <span>Sudah memiliki akun</span>
                <header>Login</header>
            </div>
<form method="post">
            <div class="input-field">
                <input type="text" class="input" placeholder="Username" required>
                <i class="bx-user"></i>
            </div>

            <div class="input-field">
                <input type="password" class="input" placeholder="Password" required>
                <i class="bx-lock-alt"></i>
            </div>

            <div class="input-field">
                <input type="submit" class="submit" value="Login" name="submit">
            </div>

            <div class="bottom">
                <div class="left">
                    <input type="checkbox" id="check">
                    <label for="check">Ingatkan saya</label>
                </div>
                <div class="right">
                    <label><a href="#"> Lupa password?</a></label>
                </div>
            </div>
        </div>    
    </div>
    </form>
    <?php

include 'koneksi.php';

session_start();

if(isset($_POST['submit'])){
    
   $username = $koneksi->real_escape_string($_POST['username']);
   $password = ($_POST['password']);

   $st=$koneksi->prepare("SELECT * FROM identitas WHERE username = ? && password = ?");
   $st->bind_param("ss",$username,$password);
   $st->execute();
   $hasil=$st->get_result();
  

   if($hasil){
      $_SESSION['username'] = $username;
      header('Location: crud.php');
   }else{
      echo "<script language='javascript'>";
        echo "alert('User atau Password tidak sesuai');";
        echo "window.location.href = 'Login2.php';";
        echo '</script>';
   }}

?>

</body>
</html>