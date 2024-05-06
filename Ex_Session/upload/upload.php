<?php
if(isset($_POST["submit"])) {
    if(isset($_FILES['fileUpload'])){
        $files = $_FILES['fileUpload'];
        $names = $files['name'];
        $tmp_names = $files['tmp_name'];
        $errors = $files['error'];
        $sizes = $files['size'];
        $numitems = count($names);
        $numfiles = 0;
        for ($i = 0; $i < $numitems; $i++) {
            if ($errors[$i] == 0) {
                $numfiles++;
                $uploadDate = filemtime($tmp_names[$i]);
                echo "<b>File $numfiles:</b><br>";
                echo "Ngày upload: " . date("Y-m-d H:i:s", $uploadDate) . "<br>";
                echo "Tên: $names[$i] <br>";
                echo "Kích Thước: $sizes[$i] bytes<br><hr>";
            }
        }
        echo "Số file upload : " .$numfiles . "<br>";
        echo "<a href='upload.html'>Back Upload</a>";
    }
}
?>