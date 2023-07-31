<?php
    // start session
    session_start();
    
    // connect to database
    include "db_connect.php";

    if(isset($_POST["image"])) {
        
        $id = $_SESSION['id']; // user's id

        // photo
        $data = $_POST["image"];

        // generate random name for image file in micro time with md5
        $time = md5(microtime());
        $month_day = date("d");
        $year = date("Y");
        $rand = rand(100, 999999);
        $name_file = $rand.$month_day.$year.$time.$id;

        // directory to save image file
        $dir = __DIR__."/../img/users/";

        // image file with directory, new name and extention
        $profile_photo = $name_file.".png";

        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);
      
        // prepare query
        // `users`
        $query = "UPDATE users SET profile_photo = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($db, $query)) {
            // bind variables to the prepared statement as parameters
            // `users`
            // $query = "UPDATE users_profile_photo SET image = ? WHERE id = ?";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "si", $profile_photo, $id);
            mysqli_stmt_execute($stmt);

            // store image in folder
            file_put_contents($dir.$profile_photo, $data);

            // echo uploaded image
            echo "<img src='assets/img/users/".$profile_photo."' alt='profile photo'>";
        }
        // close statement
        mysqli_stmt_close($stmt);
    }
    // close db connection
    mysqli_close($db);
?>