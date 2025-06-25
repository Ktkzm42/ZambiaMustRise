<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "songs/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Allow only mp3 and jpg files for upload
    if ($fileType != "mp3" && $fileType != "jpg" && $fileType != "jpeg" && $fileType != "png") {
        echo "Sorry, only MP3, JPG, JPEG & PNG files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        echo "The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " has been uploaded.<br>";
        echo "You can access it here: <a href='$targetFile'>$targetFile</a>";
    } else if ($uploadOk) {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8" /><title>Upload Song</title></head>
<body>
  <h2>Upload MP3 or Image</h2>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    Select MP3 or Image to upload:<br><br>
    <input type="file" name="fileToUpload" required />
    <br><br>
    <input type="submit" value="Upload File" />
  </form>
</body>
</html>
