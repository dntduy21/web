<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

if (isset($_POST['submit'])) {

   $address = $_POST['street'] . ', ' . $_POST['ward'] . ', ' . $_POST['district'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ', ' . $_POST['cod_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'Đã lưu địa chỉ';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cập nhật địa chỉ</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php' ?>

   <section class="form-container">

      <form action="" method="post">
         <h3>Cập nhật địa chỉ</h3>
         <input type="text" class="box" placeholder="Tên đường" required maxlength="50" name="street">
         <input type="text" class="box" placeholder="Tên phường" required maxlength="50" name="ward">
         <input type="text" class="box" placeholder="Tên quận" required maxlength="50" name="district">
         <input type="text" class="box" placeholder="Tên thành phố" required maxlength="50" name="city">
         <input type="text" class="box" placeholder="Tên nước" required maxlength="50" name="country">
         <input type="number" class="box" placeholder="Mã cod" required max="999999" min="0" maxlength="6" name="cod_code">
         <input type="submit" value="Lưu địa chỉ" name="submit" class="btn">
      </form>

   </section>

   <?php include 'components/footer.php' ?>

   <script src="js/script.js"></script>

</body>

</html>