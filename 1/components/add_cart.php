<?php

if (isset($_POST['add_to_cart'])) {

   if ($user_id == '') {
      header('location:login.php');
   } else {
      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      if (empty($qty) || !is_numeric($qty) || $qty <= 0) {
         $message[] = 'Số lượng sản phẩm không hợp lệ.';
         exit;
      }
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      $check_cart_numbers = $conn->prepare(query: "SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if ($check_cart_numbers->rowCount() > 0) {
         //Cộng thêm số lượng sản phẩm vào nếu đã có
         $insert_cart = $conn->prepare("UPDATE `cart` SET quantity = quantity + ? WHERE user_id=? AND pid=?");
         $insert_cart->execute([$qty, $user_id, $pid]);
         $message[] = 'Đã được thêm vào giỏ hàng!';
      } else {
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
         $message[] = 'Đã thêm vào giỏ hàng!';
      }
   }
}
