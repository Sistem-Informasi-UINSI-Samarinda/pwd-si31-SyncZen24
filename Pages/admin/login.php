<?php
session_start();
include '../../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Container form */
form {
    width: 320px;
    margin: 60px auto;
    padding: 25px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
}

/* Label */
form label {
    font-weight: bold;
    font-size: 14px;
    color: #333;
}

/* Input style umum */
form input[type="text"],
form input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin: 8px 0 15px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    transition: .2s;
}

/* Fokus input */
form input:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 5px rgba(74,144,226,0.4);
    outline: none;
}

/* Tombol */
form button {
    width: 100%;
    padding: 10px;
    background: #4a90e2;
    color: #fff;
    border: none;
    font-size: 15px;
    border-radius: 6px;
    cursor: pointer;
    transition: .3s;
}

/* Hover tombol */
form button:hover {
    background: #357ab8;
}

    </style>
    
</head>
<body>
    <?php
    if(isset($_POST['login'])){
        $input = $_POST['username'];
        $password = $_POST['password'];

        // Cek Input ke database apakah sudah sesuai atau belum dengan data yang ada
        if(filter_var($input, FILTER_VALIDATE_EMAIL)){
            $query = "SELECT * FROM users WHERE email = '$input'";
        } else {
            $query = "SELECT * FROM users WHERE username = '$input'"; 
        }

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $row  = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
                $_SESSION['username'] = $row['username'];

                header("location: dashboard.php");
                exit();

            }
            else {
                echo "<p style=color:red' > Username/email tidak sesuai/p>";
            }
        }
        else{
                echo "<p style=color:red' > Email atau sername tidak sesuai/p>";
            }
        }

    
    ?>

    <form method="post" action="">
    <label>Usrername atau Email</label> <br>
    <input type="text" name="username" placeholder="Masukkan Username Email" required> <br>

    <label>Password</label> <br>
    <input type="password" name="password" placeholder="Masukkan Password" required>
    <br>

    <button type="submit" name="login">Login</button>
    </form>    

</body>
</html>