<?php

include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $random = random_int(00000, 9999999) . "--";
    $links = array();
    $name_file = array();
    $total = count($_FILES['files']['name']);

    if ($total > 5) {
        header("location: ../");
    }

    // Loop through each file
    for (
        $i = 0;
        $i < $total;
        $i++
    ) {
        if ($_FILES["files"]["name"][$i] == "") {
            header("location: ../");
        } else {
            $uploading_dir = "../Uploads/";
            $uploading_file = $uploading_dir . basename($_FILES["files"]["name"][$i]);
            $imageFileType = strtolower(pathinfo($uploading_file, PATHINFO_EXTENSION));

            if ($_FILES["files"]['size'][$i] > 25000001) {
                echo "  <script>
                            alert('File Is Larger Than 25MB')
                            window.location = '../'
                        </script>";
            } else {

                if ($imageFileType != "php" || $imageFileType != "js" || $imageFileType != "html" || $imageFileType != "htm" || $imageFileType != "css") {
                    $target_file = $uploading_dir . $random . basename($_FILES["files"]["name"][$i]);
                } else {
                    $target_file = $uploading_dir . $random . basename($_FILES["files"]["name"][$i] . ".jpg");
                }


                if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], $target_file)) {
                    $time = date("His");
                    $date = date("Y-m-d");
                    $sql = "INSERT INTO `uploads`(`link`, `time`, `date`) VALUES ('$target_file','$time','$date')";
                    $result = mysqli_query($conn, $sql);

                    $spaceless_filename = str_replace(" ", "", $target_file);
                    $file_link = 'https://sharpwebtechnologies.in/ShareQR/Uploads/get.file.php?file-path=' . (str_replace("../Uploads/", "", $spaceless_filename));
                    array_push($links, $file_link);
                    array_push($name_file, $_FILES["files"]["name"][$i]);
                } else {
                    header("location: ../");
                }
            }
        }
    }
} else {
    header("location: ../");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="viewport" content="width=1024">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Uploaded QR</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="shortcut icon" href="../Image/fav.svg" type="image/x-icon">
    <script src="../JS/qrcode.js"> </script>
</head>

<body class="after-upload">

    <section id="home" class="top-section">
        <div class="navigation">
            <div class="nav-logo">
                <img src="../Image/logo.svg" alt="ShareQR">
            </div>
            <div class="nav-bar">
                <a href="../" class="nav-items active">Home</a>
                <a href="#" class="nav-items">Pricing</a>
                <a href="#" class="nav-items">Login</a>
                <a href="#" class="nav-items">Create Account</a>
            </div>
        </div>

    </section>

    <section class="uploaded-files-section">
        <h1>Your Uploaded Files</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">File Name</th>
                    <th scope="col" style="text-align: end;">QR Code</th>
                </tr>
            </thead>
            <tbody>

                <?php

                for ($c = 0; $c < (count($name_file)); $c++) {
                    $count =  $c + 1;
                    echo '  <tr>
                                <th scope="row">' . $count . '</th>
                                <td>' . $name_file[$c] . '</td>
                                <td class="cable-qr">
                                    <div id="qrcode' . $c . '" class="qr-code"></div>
                                </td>

                                <script type="text/javascript">
                                    new QRCode(document.getElementById("qrcode' . $c . '"), "' . $links[$c] . '");
                                </script>
                            </tr>';
                }

                ?>

            </tbody>
        </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


</body>

</html>