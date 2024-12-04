<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Về Chúng Tôi</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <!-- header  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header  -->

   <div class="heading">
      <h3>Về chúng tôi</h3>
      <p><a href="home.php">Trang chủ</a> <span> / Về chúng tôi</span></p>
   </div>

   <!-- about  -->

   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/about-img.svg" alt="">
         </div>

         <div class="content">
            <h3>Tại sao chọn chúng tôi?</h3>
            <p>Chọn chúng tôi vì chất lượng sản phẩm cao cấp, dịch vụ chăm sóc khách hàng tận tâm, chính sách đổi trả linh hoạt và giá cả cạnh tranh, mang lại trải nghiệm mua sắm tuyệt vời.</p>
            <a href="product.php" class="btn">Sản phẩm</a>
         </div>

      </div>

   </section>

   <!-- about  -->

   <!-- steps   -->

   <section class="steps">

      <h1 class="title">Các bước đặt hàng</h1>

      <div class="box-container">
         <div class="box">
            <img src="images/step-1.png" alt="Chọn sản phẩm">
            <h3>Chọn sản phẩm</h3>
            <p>Khám phá danh mục đa dạng với nhiều sản phẩm chất lượng cao, phù hợp với nhu cầu của bạn.</p>
         </div>

         <div class="box">
            <img src="images/step-2.png" alt="Giao hàng">
            <h3>Giao hàng</h3>
            <p>Đặt hàng và chúng tôi sẽ giao tận nơi nhanh chóng, an toàn và đúng thời gian.</p>
         </div>

         <div class="box">
            <img src="images/step-3.png" alt="Nhận sản phẩm">
            <h3>Nhận sản phẩm</h3>
            <p>Nhận sản phẩm tại nhà, kiểm tra và tận hưởng chất lượng tuyệt vời từ dịch vụ của chúng tôi.</p>
         </div>
      </div>

   </section>

   <!-- steps -->

   <!-- reviews -->

   <section class="reviews">

      <h1 class="title">Đánh giá của khách hàng</h1>

      <div class="swiper reviews-slider">

         <div class="swiper-wrapper">
            <div class="swiper-slide slide">
               <img src="images/pic-1.png" alt="Đánh giá của Anh Minh">
               <p>Dịch vụ tuyệt vời, sản phẩm đúng mô tả và chất lượng cao. Mình rất hài lòng khi mua hàng tại đây!</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>Minh</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-2.png" alt="Đánh giá của Chị Lan">
               <p>Giao hàng nhanh chóng, nhân viên thân thiện và hỗ trợ nhiệt tình. Tôi sẽ tiếp tục ủng hộ!</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Lan</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-3.png" alt="Đánh giá của Anh Hoàng">
               <p>Sản phẩm đẹp, chất lượng tốt. Tôi rất hài lòng về dịch vụ chăm sóc khách hàng.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>Hoàng</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-4.png" alt="Đánh giá của Chị Mai">
               <p>Giá cả hợp lý, sản phẩm đúng chuẩn. Tôi sẽ giới thiệu đến bạn bè và gia đình.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Mai</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-5.png" alt="Đánh giá của Anh Tùng">
               <p>Dịch vụ rất tốt, sản phẩm giao đúng hẹn. Đây là nơi mua sắm đáng tin cậy!</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>Tùng</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-6.png" alt="Đánh giá của Chị Hương">
               <p>Chất lượng sản phẩm tuyệt vời, giao hàng nhanh và đúng giờ. Cảm ơn shop!</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Hương</h3>
            </div>
            <div class="swiper-pagination"></div>

         </div>

   </section>

   <!-- reviews -->

   <!-- footer -->
   <?php include 'components/footer.php'; ?>
   <!-- footer -->=

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         grabCursor: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            700: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>