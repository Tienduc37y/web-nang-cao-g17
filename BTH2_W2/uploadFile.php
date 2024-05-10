<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload and Display</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            cursor: pointer;
        }
        th:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>File Upload and Display</h1>

    <?php
    function displayFileDetails($directory) {
        $files = scandir($directory);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $directory . '/' . $file;
                echo "<tr>";
                echo "<td>{$file}</td>";
                echo "<td>" . mime_content_type($filePath) . "</td>";
                echo "<td>" . date("Y-m-d H:i:s", filemtime($filePath)) . "</td>";
                echo "<td>" . filesize($filePath) . " bytes</td>";
                echo "</tr>";
            }
        }
    }

    $uploadDirectory = 'upload';

    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
        $targetDirectory = $uploadDirectory . '/';
        $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Upload File">
    </form>

    <table>
        <thead>
            <tr>
                <th onclick="sortTable(0)">Tên tệp</th>
                <th onclick="sortTable(1)">Loại</th>
                <th onclick="sortTable(2)">Ngày tải lên</th>
                <th onclick="sortTable(3)">Kích thước</th>
            </tr>
        </thead>
        <tbody>
            <?php displayFileDetails($uploadDirectory); ?>
        </tbody>
    </table>

    <script>
        function sortTable(columnIndex) {
            const table = document.querySelector('table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            const isAscending = !table.rows[0].cells[columnIndex].classList.contains('ascending');
            rows.sort((a, b) => {
                const aValue = a.cells[columnIndex].textContent;
                const bValue = b.cells[columnIndex].textContent;
                return isAscending ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
            });

            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }

            rows.forEach(row => tbody.appendChild(row));
            table.rows[0].cells.forEach(cell => cell.classList.remove('ascending', 'descending'));
            table.rows[0].cells[columnIndex].classList.add(isAscending ? 'ascending' : 'descending');
        }
    </script>
</body>
</html>
