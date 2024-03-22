<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require('../koneksi.php');
$query = "SELECT title FROM configs";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
$title =  $row['title'];

if (isset($_SESSION['isLogin'])) {
    header("Location: index.php");
    exit(); 
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to fetch user with given username
        $query = "SELECT * FROM admin WHERE username = '$username'";
        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Verify the password using password_verify
            if (password_verify($password, $row['password'])) {
                // Password matches, set session and redirect
                $_SESSION['isLogin'] = true;
                echo "<script> window.location.href='index.php'</script>";
                exit();
            } else {
                $error = "Password salah";
                echo "<script> document.getElementById('username').value='" . $_POST['username'] . "';</script>";
            }
        } else {
            $error = "Username tidak terdaftar";
        }
        mysqli_close($koneksi);
    }
}
?>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Login -
            <?php echo $title ?>
        </title>
        <link rel="shortcut icon" href="" type="image/x-icon">
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <style>
            body{
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1440' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1001%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='rgba(78%2c 115%2c 223%2c 1)'%3e%3c/rect%3e%3cpath d='M0%2c553.211C107.717%2c559.086%2c212.185%2c528.613%2c308.528%2c480.079C413.186%2c427.356%2c528.609%2c370.229%2c575.994%2c263.048C623.261%2c156.135%2c574.505%2c35.482%2c556.125%2c-79.959C538.04%2c-193.547%2c533.713%2c-311.372%2c469.361%2c-406.704C400.548%2c-508.645%2c307.586%2c-620.627%2c184.939%2c-629.843C61.423%2c-639.124%2c-22.39%2c-508.275%2c-132.702%2c-451.942C-217.764%2c-408.503%2c-318.916%2c-402.009%2c-388.767%2c-336.868C-462.966%2c-267.673%2c-507.322%2c-174.549%2c-534.864%2c-76.902C-565.448%2c31.528%2c-603.353%2c151.697%2c-555.314%2c253.603C-507.358%2c355.333%2c-386.611%2c394.159%2c-287.631%2c447.562C-195.882%2c497.063%2c-104.096%2c547.533%2c0%2c553.211' fill='%232550cc'%3e%3c/path%3e%3cpath d='M1440 1127.138C1546.465 1125.375 1659.301 1092.074 1731.8600000000001 1014.143 1800.3899999999999 940.539 1763.15 817.925 1810.502 729.202 1862.909 631.008 2012.4740000000002 587.937 2018.6399999999999 476.804 2024.636 368.735 1914.202 292.115 1839.078 214.197 1767.511 139.969 1694.915 56.40300000000002 1593.809 36.17399999999998 1495.259 16.456000000000017 1404.856 83.95999999999998 1307.217 107.78300000000002 1203.537 133.07999999999998 1075.825 103.39499999999998 1002.091 180.55 928.377 257.684 931.088 382.59299999999996 943.299 488.585 953.871 580.349 1033.3890000000001 644.418 1065.512 731.023 1101.324 827.573 1071.117 949.081 1141.862 1023.912 1215.605 1101.914 1332.673 1128.915 1440 1127.138' fill='%23819be8'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1001'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
            }
            .rounded{border-radius: 1.5rem!important}
        </style>
    </head>

    <body class="">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5 rounded">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4"><b>Administrator</b><br> </h1>
                                            <img src="../img/logo-login.png" class="img-fluid" alt="">
                                            <p class="lead mt-3"><h5>Login to access <?php echo $title ?>  Administrator Dashboard</h5></p>
                                            <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger border-0 text-left" role="alert"><b>Gagal!</b><br>' . $error . '</div>';
                }
                ?>
                                        </div>
                                        <form class="user" method="POST">
                                            <div class="form-group">
                    <label for="username" class="form-label font-weight-bold"> Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username Admin" required autofocus>
                                            </div>
                                            <div class="form-group">
                    <label for="Password" class="form-label font-weight-bold"> Password <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="password" placeholder="Password Admin" required>
                                            </div>
                                            <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                                Login
                                            </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="../js/sb-admin-2.min.js"></script>

    </body>

</html>