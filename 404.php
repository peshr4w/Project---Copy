<!DOCTYPE html>
<?php 
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location:index.php');
}
?>
<html lang="en">

<head>
    <?php
    include("./layout/head.php");
    include("./php/conf.php");
    ?>
    <title>Not found</title>
    <style>
   .notfound{
    font-size: 60px;
   }
    </style>
</head>

<body>
   <div class="container text-center pt-5">
      <div class="notfound">4<img src="icon-sm.png" alt="" width="60px">4</div>
      <div><bdo dir="rtl">هیچ پەڕەیەک نەدۆزرایەوە !</bdo></div>
      <div><a href="home.php" class="text-secondary"><bdo dir="rtl"></bdo>ماڵەوە</a></div>
   </div>
   <script src="js/home.js"></script>
</body>

</html>