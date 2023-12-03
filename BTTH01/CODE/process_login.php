<?php
if(isset($_POST['user']) && isset($_POST['pass'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
}
try
{
    $conn = new PDO("mysql:host=localhost;dbname=login","root","Hoang_271203");
    $sql = "SELECT * FROM users WHERE (username = '$user' OR email='$user')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount() > 0)   {
        $row = $stmt->fetch();
        $pass_saved = $row['pass'];
        if(password_verify($pass, $pass_saved)) {
            header("Location:admin/index.php");
        }else{
            header("Location:login.php?error=$error");
        }
    }else {
        header("Location:login.php?error=$error");
    }
}catch(PDOException $e){
    echo $e->getMessage();
}
?>
