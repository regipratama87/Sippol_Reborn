<!DOCTYPE html>
<?php
session_start();
require('koneksi.php');

$query = "SELECT title FROM configs";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
$title =  $row['title'];

if (isset($_SESSION['login_user']) ) {
    header("Location: index.php");
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Hash password yang dimasukkan oleh pengguna
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Periksa apakah username ditemukan di database
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($result) == 1) {
        echo "1";
        $row = mysqli_fetch_assoc($result);
        
        // Verifikasi password yang di-hash
        if (password_verify($password, $row['password'])) {
            if ($row['status'] == 0) {
                $error = "Akun anda dinonaktifkan, hubungi Administrator!";
            } else {
                $_SESSION['login_user'] = $username;
                header("location: index.php");
            }
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "Username tidak terdaftar";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login Page - <?php echo $title ?></title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">    

</head>

<body id="page-top ">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" class="min-vh-100">
            <div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="my-5 bg-white rounded border p-4">
            <form id="user-login" method="post">
                <h1 class="text-center font-weight-bold text-dark">Welcome to <?php echo $title ?>!</h1><br>
                <div class="text-center">
                <img src="img/logo-login.png" alt="" class="img-fluid">
                </div>
                <p class="lead text-center mt-3">Login to access your account.</p>
                <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger border-0" role="alert"><b>Error!! </b>' . $error . '</div>';
                }
                ?>

                <div class="mb-3">
                    <label for="username" class="form-label font-weight-bold"> Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username..." required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label font-weight-bold"> Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password..." required>
                </div>
                <button type="submit" class="btn btn-primary btn-block rounded-pill">Login</button>
            </form>
        </div>
    </div>
</div>

            </div>

            <footer class="sticky-footer bg-white border-top">
                <div class="container my-auto">
                    <div class="text-center">
                        <span>&copy; <?php
                            require('koneksi.php');
                            $query = "SELECT title FROM configs";
                            $result = mysqli_query($koneksi, $query);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['title'];
                            mysqli_close($koneksi);
                            ?> 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>




