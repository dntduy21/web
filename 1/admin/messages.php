<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tin nhắn</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- messages -->

   <section class="messages">

      <h1 class="heading">tin nhắn</h1>

      <div class="box-container">

         <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         if ($select_messages->rowCount() > 0) {
            while ($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box">
                  <p> tên : <span><?= $fetch_messages['name']; ?></span> </p>
                  <p> số điện thoại : <span><?= $fetch_messages['number']; ?></span> </p>
                  <p> email : <span><?= $fetch_messages['email']; ?></span> </p>
                  <p> tin nhắn : <span><?= $fetch_messages['message']; ?></span> </p>
                  <a href="messages.php?delete=<?= $fetch_messages['id']; ?>" class="delete-btn" onclick="return confirm('xóa tin nhắn này?');">xoá</a>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">bạn không có tin nhắn nào</p>';
         }
         ?>

      </div>

   </section>

   <!-- messages -->

   <script src="../js/admin_script.js"></script>

</body>

</html>