<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/style/tailwind.min.css" rel="stylesheet">
  <title>Admin</title>
</head>
<body>
<div class="flex justify-center items-center h-screen bg-gray-500">
  <form action="" method="post" class="lg:w-1/4" >
    <div class="bg-white shadow-md rounded-lg  px-8 pt-6 pb-8 mb-4 flex flex-col">
        <div class="mb-4">
          <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
            Username
          </label>
          <input class="shadow appearance-none border border-blue-500 rounded w-full py-2 px-3 text-grey-darker" id="username" name="username" type="text" placeholder="Username">
        </div>
        <div class="mb-6">
          <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
            Password
          </label>
          <input class="shadow appearance-none border border-blue-500 rounded w-full py-2 px-3 text-grey-darker mb-3" id="password" name="password" type="password" placeholder="******************">
          <?php
          if (isset($_POST['login'])) {
            if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
              header("location: panel.php"); 
            }  
            elseif($_POST['username'] === '') {
              echo("<p class='text-sm text-red-500 font-bold'>Username Tidak boleh kosong!</p>");
            } 
            elseif($_POST['password'] === '') {
              echo("<p class='text-sm text-red-500 font-bold'>Password Tidak boleh kosong!</p>");
            } 
            else {
              echo("<p class='text-sm text-red-500 font-bold'>Username atau Password salah!</p>");
            }
          }
          ?>
        </div>
        <div class="flex items-center justify-between">
          <input type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded cursor-pointer" name="login" value="Sign In">
        </div>
    </div>
  </form>
</div>
</body>
</html>