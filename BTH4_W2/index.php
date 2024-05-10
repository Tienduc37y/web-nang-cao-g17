<!DOCTYPE html>
<html>

<head>
    <title>Quản lý tệp tin</title>
</head>

<body>
    <?php
    if (isset($_FILES['myfile'])) {
        $uploadDir = 'uploads/';
        $fileName = $_FILES['myfile']['name'];
        $fileSize = $_FILES['myfile']['size'];
        $fileType = $_FILES['myfile']['type'];
        $tmpName = $_FILES['myfile']['tmp_name'];

        if ($fileSize > 2097152) { // 2MB
            echo "Kích thước tệp tin vượt quá giới hạn cho phép.";
        } else {
            $newFileName = time() . '_' . bin2hex(random_bytes(8));
            $uploadFile = $uploadDir . $newFileName;

            if (move_uploaded_file($tmpName, $uploadFile)) {
                echo "Tải tệp tin lên thành công.";
            } else {
                echo "Lỗi khi tải tệp tin lên.";
            }
        }
    }

    if (isset($_GET['delete'])) {
        $deleteFile = 'uploads/' . $_GET['delete'];
        if (unlink($deleteFile)) {
            echo "Đã xoá tệp tin thành công.";
        } else {
            echo "Lỗi khi xoá tệp tin.";
        }
    }

    $uploadDir = 'uploads/';
    $files = scandir($uploadDir);
    echo "<h2>Danh sách các tệp tin đã tải lên:</h2>";
    echo "<table border='1'>";
    echo "<tr><th><a href='?sort=name'>Tên tệp</a></th><th><a href='?sort=date'>Ngày tải lên</a></th><th>Loại</th><th>Kích thước</th><th>Hành động</th></tr>";
    if (isset($_GET['sort']) && $_GET['sort'] == 'date') {
        usort($files, function ($a, $b) use ($uploadDir) {
            return filemtime($uploadDir . $a) < filemtime($uploadDir . $b);
        });
    } else {
        sort($files);
    }
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $filePath = $uploadDir . $file;
            echo "<tr>";
            echo "<td>$file</td>";
            echo "<td>" . date('Y-m-d H:i:s', filemtime($filePath)) . "</td>";
            echo "<td>" . mime_content_type($filePath) . "</td>";
            echo "<td>" . filesize($filePath) . " bytes</td>";
            echo "<td><a href='?delete=$file'>Xoá</a></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    ?>

    <h2>Tải lên tệp tin mới:</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="myfile">
        <input type="submit" value="Tải lên">
    </form>
</body>

</html>