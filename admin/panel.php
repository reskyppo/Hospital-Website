<?php
require_once("../conn.php");
?>
<?php	
	$pdo_statement = $pdo->prepare("SELECT * FROM control ORDER BY id ASC");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/style/tailwind.min.css" rel="stylesheet">
  <title>Admin Panel</title>
</head>
<body>
  <!-- component -->
  <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 ">
    <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard pt-3 rounded-bl-lg rounded-br-lg">
      <table class="min-w-full">
        <thead>
          <tr>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">ID</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Fullname</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Phone</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Status</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Created At</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Gambar</th>
            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider lg:pl-16">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
        <?php
        if(!empty($result)) { 
          foreach($result as $row) {
        ?>
          <tr>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                  <div class="flex items-center">
                      <div>
                          <div class="text-sm leading-5 text-gray-800"><?=
                          $row['id']
                          ?></div>
                      </div>
                  </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                  <div class="text-sm leading-5 text-blue-900"><?=
                  $row['nama']
                  ?></div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                  <div class="text-sm leading-5 text-blue-900"><?=
                  $row['nomor']
                  ?></div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                <?php
                if ($row['status'] === null) {
                  echo ('<span class="relative text-sm bg-red-200 p-2 rounded-md">Belum diverifikasi</span>' );
                } else {
                  echo ('<span class="relative text-sm bg-green-200 p-2 rounded-md">Terverifikasi</span>' );

                }
                ?>
              </span>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-blue-900 text-sm leading-5"><?=
              $row['date']
              ?></td>
              <td class="border-b border-gray-500 text-sm leading-5">
                  <button class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                    <a href="http://localhost/rumahsakit/file/<?=
                    $row['gambar']
                    ?>" target="_blank"> Lihat Gambar</a>
                  </button>
              </td>
              <td class="px-6 py-4 border-b border-gray-500 text-sm leading-5 flex  justify-start">
                <a href='edit.php?id=<?php echo $row['id']; ?>'>
                  <img src="../assets/img/checked.webp" alt="verify" class="cursor-pointer mx-2">
                </a>
                <a href='delete.php?id=<?php echo $row['id']; ?>&gambar=<?php echo $row['gambar']; ?>'>
                  <img src="../assets/img/delete.webp" alt="delete" class="cursor-pointer mx-2">
                </a>
              </td>
          </tr>
          <?php
            }
          }
          else {
          ?>
          <tr>
            <td colspan="7" class="whitespace-no-wrap border-b border-gray-500 py-4 leading-5 text-center">
              <p class="text-red-500 text-xl font-semibold">
                Data Kosong
              </p>
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>