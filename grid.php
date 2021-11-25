<div class="ui grid">
    <div class="eight wide centered column printable">
        <?php 
            $role = $_SESSION["role"]; 
            $id = $_SESSION["id"]; 
            $email = $_SESSION["email"]; 
            $username = $_SESSION["username"]; 
            if(!$role){
                header('location: /exam/logout.php');
            }
            include_once("menu.php");
        ?>