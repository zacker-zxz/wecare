<?php
    session_start();
    $conn = mysqli_connect('localhost','root','','appointment');

    $username = $_POST['username'];
    $username = mysqli_real_escape_string($conn, $username);
    $_SESSION['username'] = $_POST['username'];

    $pass = $_POST['psw'];
    $pass = mysqli_real_escape_string($conn, $pass);

    $query = "SELECT username,password from patient where username='".$username."' and password= '".$pass."'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $num = mysqli_num_rows($result);

    if($num == 0)
    {
        // Login failed - redirect with error parameter
        header("Location: Home.php?login=error");
        exit();
    }
    else
    {
        $row = mysqli_fetch_array($result);
        $_SESSION['username'] = $row['username'];

        // Login successful - redirect with success parameter
        header("Location: Login.php?login=success");
        exit();
    }
?>