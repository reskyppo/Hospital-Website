<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/style/tailwind.min.css" rel="stylesheet">
  <title>Document</title>
</head>
<body>
  <header class=" text-blue-700 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <a href="/rumahsakit">
        <img src="../assets/img/logo.webp" class="h-12" alt="logo">
      </a>
      <nav class="md:ml-auto flex flex-wrap mt-2 items-center text-2xl justify-center">
        <a href="/rumahsakit" class="mr-5 font-bold hover:text-blue-900">Home</a>
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
          <a class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none border-gray-200 hover:text-gray-900 tracking-wider">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5 mr-3" viewBox="0 0 24 24">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>Registration
          </a>
          <a class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium bg-gray-100 inline-flex items-center leading-none border-indigo-500 text-indigo-500 tracking-wider rounded-t">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5 mr-3" viewBox="0 0 24 24">
              <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
            </svg>Instruction
          </a>
          <a class="sm:px-6 py-3 w-1/2 sm:w-auto justify-center sm:justify-start border-b-2 title-font font-medium inline-flex items-center leading-none border-gray-200 hover:text-gray-900 tracking-wider">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5 mr-3" viewBox="0 0 24 24">
              <circle cx="12" cy="5" r="3"></circle>
              <path d="M12 22V8M5 12H2a10 10 0 0020 0h-3"></path>
            </svg>Verifikasi
          </a>
        </div>
        <div class="lg:w-1/2 md:w-1/2 bg-gray-200 rounded-lg p-8 flex flex-col md:mx-auto mt-10 md:mt-0">
          <h2 class="text-gray-900 text-2xl font-medium title-font mb-5">Hello, <?php echo $_SESSION['nama'];  ?>!</h2>
          <h2 class="text-gray-900 text-2xl font-medium title-font mb-5">Hello, <?php echo $_SESSION['nomor']; ?>!</h2>
          <p class="py-2 text-lg text-gray-700">Terimakasih telah mendaftar untuk mengikuti tes Swab dari rumah dengan Rumah Sakit kami.</p>
          <p class="py-2 text-lg text-gray-700">Berikut ini ialah nomor rekening dan kode unik yang harus anda sertakan pada foto untuk verifikasi data</p>
          <p class="pt-2 text-lg font-medium text-gray-700">BCA 07776699 A.N RS Children Health</p>
          <p class="text-lg font-medium text-gray-700">Kode Unik anda <?php echo $_SESSION['username']; ?></p>
          <p class="text-lg font-medium text-gray-700">Sebesar Rp.150.000</p>
          <?php 
          include '../conn.php';
          if(isset($_POST['upload'])){

            $ekstensi_diperbolehkan = array('png','jpg');
            $nama                   = $_FILES['file']['name'];
            $x                      = explode('.', $nama);
            $ekstensi               = strtolower(end($x));
            $ukuran                 = $_FILES['file']['size'];
            $file_tmp               = $_FILES['file']['tmp_name'];
            $date = date("d-m-Y");

            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
              if($ukuran < 1044070){			
                move_uploaded_file($file_tmp, '../file/'.$nama);
                $sql = "INSERT INTO control (nama, nomor, gambar, date) 
                        VALUES (:nama, :nomor, :gambar, :date)";
                $stmt = $pdo->prepare($sql);

                // bind parameter ke query
                $params = array(
                    ":nama" => $_SESSION['nama'],
                    ":nomor" => $_SESSION['nomor'],
                    ":gambar" => $nama,
                    ":date" => $date
                );

                // eksekusi query untuk menyimpan ke database
                $saved = $stmt->execute($params);
                if($saved){
                  session_destroy();
                  header("location: step-3.php"); 
                }else{
                  echo 'GAGAL MENGUPLOAD GAMBAR';
                }
              }else{
                echo 'UKURAN FILE TERLALU BESAR';
              }
            }else{
              echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
            }
          }
          ?>
          <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" name="upload" value="Upload">
          </form>
        </div>
      </div>
    </section>
  </main>
</body>
</html>