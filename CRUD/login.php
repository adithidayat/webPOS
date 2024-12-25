<?php

include("db.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM tbl_user WHERE Username = '$user' and Password = '$pass'";
    $hasil = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($hasil);
    $data = mysqli_fetch_array($hasil);
    $level = $data['Level_User'];
    $id_user = $data['Id_User'];
    if ($count == 1) {
       
        $_SESSION['login_user'] = $user;
        $_SESSION['rool'] = $level;
        $_SESSION['Id_User'] = $id_user;
        if ($_SESSION['rool'] == "Admin") {
            header("Location: dashboard_admin.php");
       }
       else{
        header("Location: dashboard.php");
       }

    } else {
        $error = "Username atau Password Salah!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="d-flex vh-100">
        <div class="d-flex justify-content-center align-items-center bg-white flex-grow-1">
            <div class="card p-4 border-primary" style="width: 350px;">
                <h2 class="text-center mb-4">Login</h2>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center bg-primary text-white flex-grow-1">
            <h1 class="text-center" style="font-size: 30px; font-weight: bold;">Welcome to Our Website</h1>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
