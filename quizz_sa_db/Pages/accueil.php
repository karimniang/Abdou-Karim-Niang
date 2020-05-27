essayon admin <br>
<?php
session_start();
echo $_SESSION['name'];
?>
<img src="<?php echo $_SESSION['photo']; ?>" style="width: 100px; height: 100px;" alt="">