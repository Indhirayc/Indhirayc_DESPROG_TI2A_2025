<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Upload</title>
</head>
<body>
    <h2>Upload gambar</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <p>Pilih file yang akan diinput</p>
        <input type="file" name="myfile">
        <input type="submit" name="submit">
    </form>
</body>
</html>