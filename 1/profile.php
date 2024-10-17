<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>hồ sơ</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- header -->
   <?php include 'components/user_header.php'; ?>
   <!-- header -->

   <section class="user-details">

      <div class="user">
         <?php

         ?>
         <img src="images/user-icon.png" alt="">
         <p><i class="fas fa-user"></i><span><span><?= $fetch_profile['name']; ?></span></span></p>
         <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number']; ?></span></p>
         <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email']; ?></span></p>
         <a href="update_profile.php" class="btn">cập nhật thông tin</a>
         <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php if ($fetch_profile['address'] == '') {
                                                                           echo 'vui lòng nhập địa chỉ của bạn!';
                                                                        } else {
                                                                           echo $fetch_profile['address'];
                                                                        } ?></span></p>
         <a href="update_address.php" class="btn">cập nhật địa chỉ</a>
      </div>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>