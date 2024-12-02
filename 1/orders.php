<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

if (isset($_GET['msg']) && $_GET['msg'] !== ""){
   $message[] = $_GET["msg"];
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>đơn hàng</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- header -->
   <?php include 'components/user_header.php'; ?>
   <!-- header -->

   <div class="heading">
      <h3>đơn hàng</h3>
      <p><a href="html.php">trang chủ</a> <span> / đơn hàng</span></p>
   </div>

   <section class="orders">

      <h1 class="title">đơn hàng của bạn</h1>

      <div class="box-container">

         <?php
         if ($user_id == '') {
            echo '<p class="empty">vui lòng đăng nhập để xem đơn hàng của bạn</p>';
         } else {
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);
            if ($select_orders->rowCount() > 0) {
               while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
         ?>
                  <div class="box">
                     <p>ngày đặt : <span><?= $fetch_orders['placed_on']; ?></span></p>
                     <p>tên : <span><?= $fetch_orders['name']; ?></span></p>
                     <p>email : <span><?= $fetch_orders['email']; ?></span></p>
                     <p>số điện thoại : <span><?= $fetch_orders['number']; ?></span></p>
                     <p>địa chỉ : <span><?= $fetch_orders['address']; ?></span></p>
                     <p>phương thức thanh toán : <span><?= $fetch_orders['method']; ?></span></p>
                     <p>đơn đặt hàng của bạn : <span><?= $fetch_orders['total_products']; ?></span></p>
                     <p>tổng tiền : <span><?= $fetch_orders['total_price']; ?>vnđ</span></p>
                     <p> trạng thái thanh toán : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                                                                        echo 'red';
                                                                     } else {
                                                                        echo 'green';
                                                                     }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
                  </div>
         <?php
               }
            } else {
               echo '<p class="empty">chưa có đơn đặt hàng nào được đặt!</p>';
            }
         }
         ?>

      </div>

   </section>

   <!-- footer  -->
   <?php include 'components/footer.php'; ?>
   <!-- footer  -->

   <script src="js/script.js"></script>

</body>

</html>