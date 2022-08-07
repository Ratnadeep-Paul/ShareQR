<?php

$date = date("Y-m-d");
$time = date("His");
$datetime1 = new DateTime($date);

include 'API/dbconnect.php';

$sql = "SELECT * FROM `uploads`";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

if ($num > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $link = str_replace("../", "", $row['link']);
        $date_get = $row['date'];
        $time_get = $row['time'];

        $datetime2 = new DateTime($date);
        $difference = $datetime1->diff($datetime2);
        $difference_between = $difference->format('%a');

        if ($difference_between > 0) {
            unlink($link);
            $sql_delete = "DELETE FROM `uploads` WHERE `id`='$id'";
            $result_delete = mysqli_query($conn, $sql_delete);
        } else {
            if (($time - $time_get) > 7100) {
                unlink($link);
                $sql_delete = "DELETE FROM `uploads` WHERE `id`='$id'";
                $result_delete = mysqli_query($conn, $sql_delete);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=1024">
    <title>ShareQR</title>
    <link rel="shortcut icon" href="Image/fav.svg" type="image/x-icon">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <section id="home" class="top-section">
        <div class="navigation">
            <div class="nav-logo">
                <img src="Image/logo.svg" alt="ShareQR">
            </div>
            <div class="nav-bar">
                <a href="#home" class="nav-items active">Home</a>
                <a href="#" class="nav-items">Pricing</a>
                <a href="#" class="nav-items">Login</a>
                <a href="#" class="nav-items">Create Account</a>
            </div>
        </div>
        <div class="hero-section">
            <div class="left">
                <h1 class="hero-text">Upload. Scan. Download.</h1>
                <button onclick="chooseFile()" class="file-choose-btn btn">Choose Your File <img src="Image/plus.svg" alt="plus"></button>

                <p class="hero-description">
                    Maximum Upload Size 25MB And Maximum 5 Files Allowed<br>
                    Files Will Be Saved In Our Cloud For 30 Minutes.
                </p>
                <p class="hero-description">
                    For Larger Size File and More Saving Duration, <br> Check Our Pricing.
                </p>
            </div>
            <div class="right">
                <img src="Image/upload-illustration.svg" alt="hero">
            </div>
        </div>
    </section>

    <section class="pricing-section" id="pricing">
        <h1 style="font-family: var(--secondary-font); width:100%; text-align:center; color: var(--primary-color)">Share Files From Your PC To Mobile Device Easily</h1>
    </section>


    <!-- Modal -->
    <div class="modal fade modal-upload" id="hidden-upload" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="API/uploaded-file.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-body">
                        <label for="uploading-file" id="uploading-file-label"></label>
                        <input type="file" id="uploading-file" name="files[]" multiple="multiple" hidden>

                        <h5>You Have Selected:</h5>
                        <span id="upload-filename"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="closeUpload()" class="btn btn-secondary">Close</button>
                        <button type="submit" onclick="submitUpload()" id="submit-upload" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="JS/script.js"></script>
</body>

</html>