<?php
  $profile_link = "";
  $index_link = "";

  if($role == 1){
    $profile_link = "/exam/student/profile.php";
    $index_link = "/exam/student/";
  }else if($role == 2){
    $profile_link = "/exam/faculty/profile.php";
    $index_link = "/exam/faculty/";
  }else if($role == 3){
    $profile_link = "/exam/management/profile.php";
    $index_link = "/exam/management/";
  }
?>
<div class="ui secondary  menu printable ppp" bis_skin_checked="1">
  <a href="<?php echo $index_link; ?>" class="item">
    <?php
        if($role == 1){
            echo "Student : ".$username;
        }else if($role == 2){
            echo "Faculty : ".$username;
        }else if($role == 3){
            echo "Management : ".$username;
        }
    ?>
  </a>
  <?php 
    if($role == 1){
  ?>
    <a 
      href="<?php echo $profile_link; ?>"
      class="item"
    >
      Profile
    </a>
  <?php
    }
  ?>
  <?php
    if($role == 1){
  ?>
    <a href="/exam/student/results.php" class="item">
        Results
    </a>
  <?php
    }
  ?>
  <?php
    if($role == 2){
  ?>
    <a href="/exam/faculty/exams/" class="item">
        Exams
    </a>
  <?php
    }
  ?>
  <?php
    if($role == 3){
  ?>
    <a href="/exam/management/users/" class="item">
        Users
    </a>
    <a href="/exam/management/exams/" class="item">
        Exams
    </a>
    <a href="/exam/management/exams/settings.php" class="item">
        Settings
    </a>
  <?php
    }
  ?>

  <div class="right menu">
    <a href="/exam/logout.php" class="ui item">
      Logout
    </a>
  </div>
</div>