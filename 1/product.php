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
   <title>Sản phẩm</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- header -->
   <?php include 'components/user_header.php'; ?>
   <!-- header -->

   <div class="heading">
      <h3>Sản phẩm của chúng tôi</h3>
      <p><a href="home.php">Trang chủ</a> <span> / Sản phẩm</span></p>
   </div>

   <!-- product -->

   <section class="products">

      <h1 class="title">Sản phẩm mới nhất</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            $fetch_products = $select_products->fetchAll(PDO::FETCH_ASSOC);
            foreach ($fetch_products as $product) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $product['id']; ?>">
                  <input type="hidden" name="name" value="<?= $product['name']; ?>">
                  <input type="hidden" name="price" value="<?= $product['price']; ?>">
                  <input type="hidden" name="image" value="<?= $product['image']; ?>">
                  <a href="quick_view.php?pid=<?= $product['id']; ?>" class="fas fa-eye"></a>
                  <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                  <img src="uploaded_img/<?= $product['image']; ?>" alt="">
                  <a href="category.php?category=<?= $product['category']; ?>" class="cat"><?= $product['category']; ?></a>
                  <div class="name"><?= $product['name']; ?></div>
                  <div class="flex">
                     <div class="price"><?= $product['price']; ?><span>vnđ</span></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                  </div>
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">Chưa có sản phẩm nào được thêm vào!</p>';
         }
         ?>

      </div>

   </section>

   <!-- footer  -->
   <?php include 'components/footer.php'; ?>
   <!-- footer -->

   <script src=" js/script.js"></script>

</body>

</html>