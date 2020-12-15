<?php
  include("../conn.php");
  if(isset($_POST['submit'])){
      if($_POST['nama']==''){
          echo "</br>Nama tidak boleh kosong!";
      }
      elseif($_POST['alamat']==''){
          echo "</br>Alamat tidak boleh kosong!";
      }
      else{
        // filter data yang diinputkan
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $username = strtok($nama, " ") . rand(10000,20000);
        $nomor = filter_input(INPUT_POST, 'nomor', FILTER_SANITIZE_NUMBER_INT);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);


        // menyiapkan query
        $sql = "INSERT INTO user (nama, username, nomor, alamat) 
                VALUES (:nama, :username, :nomor, :alamat)";
        $stmt = $pdo->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":nama" => $nama,
            ":username" => $username,
            ":nomor" => $nomor,
            ":alamat" => $alamat
        );

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);

        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved) header("Location: step-2.php");
        else echo("error");
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/style/tailwind.min.css" rel="stylesheet">
  <title>Reservation</title>
</head>
<body>
  <header class=" text-blue-700 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <a href="/">
        <img src="../assets/img/logo.webp" class="h-12" alt="logo">
      </a>
      <nav class="md:ml-auto flex flex-wrap mt-2 items-center text-2xl justify-center">
        <a href="/" class="mr-5 font-bold hover:text-blue-900">Home</a>
        <a href="#" class="mr-5 font-bold hover:text-blue-900">About Us</a>
        <a href="#" class="mr-5 font-bold hover:text-blue-900">Services</a>
        <a href="#" class="mr-5 font-bold hover:text-blue-900">Contact</a>
      </nav>
    </div>
  </header>

  <main>
    <section class="text-gray-700 body-font">
      <div class="container px-5 py-24 mx-auto flex flex-wrap flex-col">
        <div class="flex mx-auto flex-wrap mb-20">
          <a class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium bg-gray-100 inline-flex items-center leading-none border-indigo-500 text-indigo-500 tracking-wider rounded-t">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5 mr-3" viewBox="0 0 24 24">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>Registration
          </a>
          <a class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none border-gray-200 hover:text-gray-900 tracking-wider">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5 mr-3" viewBox="0 0 24 24">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
            </svg>STEP 2
          </a>
          <a class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none border-gray-200 hover:text-gray-900 tracking-wider">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5 mr-3" viewBox="0 0 24 24">
              <circle cx="12" cy="5" r="3"></circle>
              <path d="M12 22V8M5 12H2a10 10 0 0020 0h-3"></path>
            </svg>STEP 3
          </a>
          <a class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none border-gray-200 hover:text-gray-900 tracking-wider">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5 mr-3" viewBox="0 0 24 24">
              <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>STEP 4
          </a>
        </div>
        <div class="lg:w-2/6 md:w-1/2 bg-gray-200 rounded-lg p-8 flex flex-col md:mx-auto mt-10 md:mt-0">
          <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Registration</h2>
          <form action="" method="POST">
            <div class="relative mb-4">
              <label for="nama" class="leading-7 text-sm text-gray-600">Nama Lengkap</label>
              <input type="text" id="nama" name="nama" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative mb-4">
              <label for="nomor" class="leading-7 text-sm text-gray-600">No. WhatsApp</label>
              <input type="number" id="nomor" name="nomor" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="relative mb-4">
              <label for="alamat" class="leading-7 text-sm text-gray-600">Alamat</label>
              <input type="text" id="alamat" name="alamat" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <input  type="submit" class="cursor-pointer text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" name="submit" value="Daftar"/>
            <p class="text-xs text-gray-500 mt-3">Literally you probably haven't heard of them jean shorts.</p>
          </form>
        </div>
      </div>
    </section>
  </main>
</body>
</html>