<?php
require_once "config.php";

$username = $password = $phone = "";
$username_err = $password_err = $phone_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for phone field
if(empty(trim($_POST['phone']))){
    $phone_err = "phone cannot be blank";
}
else{
    $phone = trim($_POST['phone']);
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($phone_err))
{
    $sql = "INSERT INTO users (username, password, phone) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_phone);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_phone = $phone;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>




<!doctype html>
<html lang="en">
  <head>
    <title>PHP login system!</title>
  </head>
  <body>

<h3>Please Register Here:</h3>
<hr>
<form action="" method="post">
      <input type="text"  name="username"  placeholder="Username">
      <input type="password"  name ="password"  placeholder="Password">
      <input type="text"  name ="phone"  placeholder="Phone">
      <input type = "submit" name = "submit" value = "Submit">
</form>

  </body>
</html>
