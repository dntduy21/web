<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
   exit;
};

if (isset($_POST['update_payment'])) {

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];

   $select_status = $conn->prepare("SELECT payment_status FROM `orders` WHERE id = ?");
   $select_status->execute([$order_id]);
   $current_status = $select_status->fetch(PDO::FETCH_ASSOC)['payment_status'];

   $valid_status = ['pending', 'paid', 'completed'];

   if (array_search($payment_status, $valid_status) > array_search($current_status, $valid_status)) {
      $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
      $update_status->execute([$payment_status, $order_id]);
      $message[] = 'Cập nhật trạng thái thanh toán thành công!';
   } else {
      $message[] = 'Không thể trở về trạng thái trước đó!';
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];

   $check_status = $conn->prepare("SELECT payment_status FROM `orders` WHERE id = ?");
   $check_status->execute([$delete_id]);
   $status = $check_status->fetch(PDO::FETCH_ASSOC)['payment_status'];

   if ($status === 'pending') {
      $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
      $delete_order->execute([$delete_id]);
      header('location:placed_orders.php');
      exit;
   } else {
      $message[] = 'Chỉ có thể xóa các đơn hàng ở trạng thái pending!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>đặt hàng</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">\

   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- placed orders  -->

   <section class="placed-orders">

      <h1 class="heading">đặt hàng</h1>

      <div class="box-container">

         <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
                  <p> ngày đặt : <span><?= $fetch_orders['placed_on']; ?></span> </p>
                  <p> tên : <span><?= $fetch_orders['name']; ?></span> </p>
                  <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
                  <p> số điện thoại : <span><?= $fetch_orders['number']; ?></span> </p>
                  <p> địa chỉ : <span><?= $fetch_orders['address']; ?></span> </p>
                  <p> tổng sản phẩm : <span><?= $fetch_orders['total_products']; ?></span> </p>
                  <p> tổng tiền : <span>$<?= $fetch_orders['total_price']; ?>vnđ</span> </p>
                  <p> phương thức thanh toán : <span><?= $fetch_orders['method']; ?></span> </p>
                  <!-- pending -> paid -> completed -->
                  <form action="" method="POST">
                     <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                     <select name="payment_status" class="drop-down">
                        <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
                        <option value="pending">pending</option>
                        <option value="paid">paid</option>
                        <option value="completed">completed</option>
                     </select>
                     <div class="flex-btn">
                        <input type="submit" value="cập nhật" class="btn" name="update_payment">
                        <?php if ($fetch_orders['payment_status'] === 'pending') { ?>
                           <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('xóa đơn hàng này?');">xoá</a>
                        <?php } ?>
                     </div>
                  </form>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">chưa có đơn đặt hàng nào được đặt!</p>';
         }
         ?>

      </div>

   </section>

   <!-- placed orders -->

   <script src="../js/admin_script.js"></script>

</body>

</html>