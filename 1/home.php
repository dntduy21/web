<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trang Chủ</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>
   <?php include 'components/user_header.php'; ?>

   <section class="hero">

      <div class="swiper hero-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide" data-swiper-autoplay="2000">
               <div class="content">
                  <span>Mua hàng online</span>
                  <h3>Levents® Baseball Jersey</h3>
                  <a href="product.php" class="btn">Xem sản phẩm</a>
               </div>
               <div class="image">
                  <img src="images/home-img-1.png" alt="">
               </div>
            </div>

            <div class="swiper-slide slide" data-swiper-autoplay="2000">
               <div class="content">
                  <span>Mua hàng online</span>
                  <h3>Levents® Flowers Window Tee</h3>
                  <a href="product.php" class="btn">Xem sản phẩm</a>
               </div>
               <div class="image">
                  <img src="images/home-img-2.png" alt="">
               </div>
            </div>

            <div class="swiper-slide slide" data-swiper-autoplay="2000">
               <div class="content">
                  <span>Mua hàng online</span>
                  <h3>Levents® Dolphin Tee</h3>
                  <a href="product.php" class="btn">Xem sản phẩm</a>
               </div>
               <div class="image">
                  <img src="images/home-img-3.png" alt="">
               </div>
            </div>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <section class="category">

      <h1 class="title">Danh Mục</h1>

      <div class="box-container">

         <a href="category.php?category=Baseball Snapback" class="box">
            <img src="images/clothing-1.png" alt="">
            <h3>Baseball Snapback</h3>
         </a>

         <a href="category.php?category=Denim Short Jeans" class="box">
            <img src="images/clothing-2.png" alt="">
            <h3>Denim Short Jeans</h3>
         </a>

         <a href="category.php?category=Hoodie" class="box">
            <img src="images/clothing-3.png" alt="">
            <h3>Hoodie</h3>
         </a>

         <a href="category.php?category=Baggy Jeans" class="box">
            <img src="images/clothing-4.png" alt="">
            <h3>Baggy Jeans</h3>
         </a>

      </div>

   </section>

   <section class="products">

      <h1 class="title">Mới Cập Nhật</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            $fetch_products_list = $select_products->fetchAll(PDO::FETCH_ASSOC);
            foreach ($fetch_products_list as $fetch_products) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="flex">
                     <div class="price"><?= $fetch_products['price']; ?><span>vnd</span></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">chưa có sản phẩm!</p>';
         }
         ?>
      </div>

      <div class="more-btn">
         <a href="product.php" class="btn">Xem tất cả</a>
      </div>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".hero-slider", {
         loop: true,
         grabCursor: true,
         autoplay: true,
         effect: "slide",
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });
   </script>

</body>

</html>