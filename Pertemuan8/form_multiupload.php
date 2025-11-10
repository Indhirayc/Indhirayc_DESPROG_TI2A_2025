<!DOCTYPE html>
<html>
<head>
    <title>Multi Upload Gambar</title>
</head>
<body>
    <h2>Upload Beberapa Gambar Sekaligus</h2>
    <form action="proses_upload.php" method="post" enctype="multipart/form-data">
        Pilih beberapa gambar:
        <br><br>
        <input type="file" name="files[]" multiple>
        <br><br>
        <input type="submit" value="Upload Gambar" name="submit">
    </form>
</body>
</html>