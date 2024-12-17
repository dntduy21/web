<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   try {
      $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
      $select_user->execute([$email, $number]);

      if ($select_user->rowCount() > 0) {
         $message[] = 'Email hoặc số điện thoại đã được sử dụng!';
      } else {
         $pattern = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/";

         if (!preg_match($pattern, $pass)) {
            $message[] = "Mật khẩu phải có ít nhất 8 ký tự, trong đó ít nhất 1 ký tự số, 1 ký tự thường,1 ký tự hoa";
         } else if ($pass != $cpass) {
            $message[] = 'Mật khẩu không khớp!';
         } else if (!preg_match('/^\d{10}$/', $number)) {
            $message[] = "Số điện thoại không hợp lệ";
         } else {
            $insert_user = $conn->prepare("INSERT INTO `users` (name, email, number, password, address) VALUES (?, ?, ?, ?, ?)");
            $insert_user->execute([$name, $email, $number, sha1($pass), $address]);

            $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
            $select_user->execute([$email, sha1($pass)]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);
            if ($select_user->rowCount() > 0) {
               $_SESSION['user_id'] = $row['id'];
               header('location:home.php');
            }
         }
      }
   } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng ký</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- header  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header -->

   <section class="form-container">

      <form action="" method="post">
         <h3>Đăng ký ngay</h3>
         <input type="text" name="name" required placeholder="Nhập tên của bạn" class="box" maxlength="50" value="<?= isset($name) ? htmlspecialchars($name) : ''; ?>">
         <input type="email" name="email" required placeholder="Nhập email của bạn" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= isset($email) ? htmlspecialchars($email) : ''; ?>">
         <input type="text" name="number" required placeholder="Nhập số điện thoại của bạn" class="box" minlength="10" maxlength="10" value="<?= isset($number) ? htmlspecialchars($number) : ''; ?>">
         <input type="password" name="pass" required placeholder="Nhập mật khẩu của bạn" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="cpass" required placeholder="Xác nhận mật khẩu của bạn" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="text" name="address" required placeholder="Nhập địa chỉ của bạn" class="box" maxlength="100" value="<?= isset($address) ? htmlspecialchars($address) : ''; ?>">
         <input type="submit" value="Đăng ký ngay" name="submit" class="btn">
         <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
      </form>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>