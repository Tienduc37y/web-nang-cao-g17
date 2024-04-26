<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pka_s";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thực hiện truy vấn để lấy dữ liệu
$sql = "SELECT SinhVien.MSSV, SinhVien.HoTen, DangKy.Ky, MonHoc.TenMH 
        FROM SinhVien 
        INNER JOIN DangKy ON SinhVien.MSSV = DangKy.MSSV 
        INNER JOIN MonHoc ON DangKy.MaMH = MonHoc.MaMH";
$data = $conn->query($sql);
    print "<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #a8dadc;
    }
</style>";
    print "<table>
    <tr>
    <th>MSSV</th>
    <th>Họ Tên</th>
    <th>Kỳ</th>
    <th>Đăng Ký</th>
    </tr>";
    while($row = mysqli_fetch_assoc($data)) {
    print "<tr>
            <td>{$row["MSSV"]}</td>
            <td>{$row["HoTen"]}</td>
            <td>{$row["Ky"]}</td>
            <td>{$row["TenMH"]}</td>
        </tr>";
    }
    print "</table>";


// Đóng kết nối
$conn->close();
?>
