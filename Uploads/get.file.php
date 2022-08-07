<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['file-path'])) {
        $link = $_GET['file-path'];
    } else {
        header("location: ../");
    }
} else {
    header("location: ../");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Download</title>
</head>

<body style="display: none;">
    <a id="file" href="<?php echo $link; ?>" download></a>

    <script>
        document.getElementById("file").click();
    </script>
</body>

</html>