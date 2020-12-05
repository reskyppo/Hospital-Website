<?php

  include("koneksi.php");

  if(isset($_POST['register'])){

      // filter data yang diinputkan
      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
      $username = $name . rand(1,100);
      // enkripsi password
      $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
      $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


      // menyiapkan query
      $sql = "INSERT INTO user (nama, username, email, password) 
              VALUES (:name, :username, :email, :password)";
      $stmt = $pdo->prepare($sql);

      // bind parameter ke query
      $params = array(
          ":name" => $name,
          ":username" => $username,
          ":password" => $password,
          ":email" => $email
      );

      // eksekusi query untuk menyimpan ke database
      $saved = $stmt->execute($params);

      // jika query simpan berhasil, maka user sudah terdaftar
      // maka alihkan ke halaman login
      if($saved) header("Location: index.php");
      else echo("error");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>register</title>
</head>
<body>
  <form action="" method="POST">

    <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input class="form-control" type="text" name="name" placeholder="Nama kamu" />
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email" placeholder="Alamat Email" />
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" type="password" name="password" placeholder="Password" />
    </div>

    <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />

  </form>
</body>
</html>
