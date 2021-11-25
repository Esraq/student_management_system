<?php
	ob_start();
	session_start();
	include("db_connect.php");
    if(isset($_SESSION["role"])){
        if($_SESSION["role"] == 1){
            header('location: /exam/student/');
        }else if($_SESSION["role"] == 2){
            header('location: /exam/faculty/');
        }else if($_SESSION["role"] == 3){
            header('location: /exam/management/');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.3/dist/semantic.min.css">
	
    <style>
        .container{
            min-width: 100%;
        }

        .container > .row {
            margin: 0;
        }


        .container > .row > .col {
            padding: 0;
        }

        *{
            padding: 0px;
            margin: 0px;
            font-family: 'Changa';
        }

        .side_menu_a_link_color{
            color: white;
            font-size: 14px;
        }

        .side_menu_a_link_color:hover{
            color: grey;
        }

        .left_menu_color_dashboard{
            color: white;
        }

        .left_menu_color_dashboard:hover{
            color: grey;
        }

        .left_menu_active_color{
            color: grey;
            font-size: 14px;
        }

        .left_menu_active_color_dashboard{
            color: grey;
        }

        .left_menu_active_color_dashboard:hover{
            color: white;
        }

        .left_menu_active_color:hover{
            color: white;
        }

        .footer_bottom_link_text a:hover{
            text-decoration: underline;
        }

        body{
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
  <?php
    if(isset($_POST['submit'])){
      $user = $_POST['username'];
      $pass = $_POST['password'];
      $query=mysqli_query($conn, "SELECT * FROM user WHERE username = '$user' AND password = '$pass'");
      $num_rows=mysqli_num_rows($query);
      $row=mysqli_fetch_array($query);
      if ($num_rows>0){
        $role = $row["role"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"] = $role;
        $_SESSION["email"] = $row["email"];
        $_SESSION["id"] = $row["id"];
        if($role == 1){
          header('location: /exam/student/');
        }else if($role == 2){
          header('location: /exam/faculty/');
        }else if($role == 3){
          header('location: /exam/management/');
        }
      }else{
        $err_msg = "Unable to login with this credential!";
      }
    }
  ?>
  <div class="ui stackable grid">
      <div class="five wide centered column">
          <div class="ui segment" style="margin-top: 150px; padding: 20px;">
              <center>
                  <h1 style="color: navy">Login</h1>
              </center>

              <div class="ui stackable grid" style="margin-top: 50px; margin-bottom: 30px;">
                  <div class="ten wide centered column">
                      <form class="ui form" method="post">
                          <div class="field">
                              <label>* Username</label>
                              <input type="text" name="username" placeholder="Enter username" required />
                          </div>
                          <div class="field">
                              <label>* Password</label>
                              <input type="password" name="password" placeholder="Enter password" required />
                          </div>

                          <?php	
                            if(isset($err_msg)){
                              echo '<div class="ui red message">';
                                echo "*".$err_msg;
                              echo '</div>';
                            }
                          ?>
                          <button class="ui button" name="submit" type="submit">Login</button>
                      </form>
                  </div>
              </div>

          </div>
      </div>
  </div>

  <!--end body-->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.3/dist/semantic.min.js"></script>
</body>
</html>
<?php
  ob_end_flush();
?>