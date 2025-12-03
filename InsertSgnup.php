<?php
require_once("includes.html");
$conn = mysqli_connect('localhost','root','','appointment');

if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $dob = $_POST['DOB'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $passwordr = $_POST['pwdr'];

    // Check if email already exists
    $query = "SELECT * FROM patient WHERE email='$email'";
    $data = mysqli_query($conn, $query);
    $num = mysqli_num_rows($data);

    if($num == 1){
        echo "<script>
        swal({
            title: 'Email already exists!',
            text: 'Please register using a different email ID',
            type: 'error'
            },
            function(){
                window.location.href = 'signup.php';
                });
                </script>";
    } else {
        // Insert new patient
        $sql = "INSERT INTO patient(name,gender,dob,phone,username,password,email) VALUES ('$name','$gender','$dob','$contact','$username','$password','$email')";
        $data = mysqli_query($conn, $sql);
        if($data){
            echo "<script>
            swal({
                title: 'Sign Up Successful!',
                text: 'Welcome!',
                type: 'success'
                },
                function(){
                    window.location.href = 'Login.php';
                    });
                    </script>";
        } else {
            echo "<script>
            swal({
                title: 'Registration Failed!',
                text: 'Please try again',
                type: 'error'
                },
                function(){
                    window.location.href = 'signup.php';
                    });
                    </script>";
        }
    }
}
?>