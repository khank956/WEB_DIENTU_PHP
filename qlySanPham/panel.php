<div id="vien">
    <div class="center">
        <div id="ban">
            <a id="ba" href="/index.php">Trang chủ</a> > <a id="ba" href="/adminpanel/index.php">Admin Panel</a> >
            <font color="#008744">Quản lý sản phẩm</font>
        </div>
    </div>
</div>
<div class="list"><a href="/qlySanPham/index.php?mod=add"><button class="button">Thêm sản phẩm</button></a>
    <a href="/qlySanPham/index.php?mod=thongke"><button class="button">Thống kê </button></a>
</div>
<div class="search1">
    <form action="../qlySanPham/timkiem.php" method="get">
        <input type="text" size="50" name="search" placeholder="Nhập sản phẩm bạn tìm kiếm"
            style="display: inline-block;">
        <button type="submit" name="ok">Tìm kiếm</button>
    </form>
</div>
<?php
/**Phân trang */

// 1Số sản phẩm hiển thị trên mỗi trang
$productsPerPage = 6;

// Xác định trang hiện tại
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Tính vị trí bắt đầu của sản phẩm trên trang hiện tại
$start = ($current_page - 1) * $productsPerPage;
// 2. Tạo câu truy vấn (Query): SELECT, INSERT, DELETE, UPDATE
// $sql = "SELECT * FROM sanpham ORDER BY MaSanPham DESC";
$sql = "SELECT * FROM sanpham WHERE BiXoa = 0 ORDER BY MaSanPham ASC LIMIT $start, $productsPerPage";

// 3. Thực thi câu truy vấn
$result = mysqli_query($connection, $sql);

// 4. Xử lý kết quả của câu truy vấn (SELECT)
while ($row = mysqli_fetch_array($result)) {
    $mahsx = $row['MaHangSanXuat'];
    $malsp = $row['MaLoaiSanPham'];

    $sql1 = "SELECT * FROM hangsanxuat WHERE MaHangSanXuat = '$mahsx'";
    $hangsx = mysqli_query($connection, $sql1);
    $hsx = mysqli_fetch_array($hangsx);
    $sql2 = "SELECT * FROM loaisanpham WHERE MaLoaiSanPham = '$malsp'";
    $loaisp = mysqli_query($connection, $sql2);
    $lsp = mysqli_fetch_array($loaisp);
    if ($row['BiXoa'] == 1) {
        echo '<div class="listdel">';
    } else {
        echo '<div class="list">';
    }
    echo '' . $row['MaSanPham'] . '. ' . $row['TenSanPham'] . ' - Giá: ';
    echo number_format($row['GiaSanPham'], 0) . '₫<br>';
    echo 'Số lượng hàng: ' . $row['SoLuong'] . ' - Ngày nhập: ' . $row['NgayNhap'] . '';
    echo '<br/>Thương hiệu: ' . $hsx['TenHangSanXuat'] . ' - Loại: ' . $lsp['TenLoaiSanPham'] . '';
    echo '<br/><img width="100" height="100" src="/images/' . $row['HinhURL'] . '"><br/>';
    echo '<div class="tool"><a href="/qlySanPham/index.php?mod=update&id=' . $row['MaSanPham'] . '"><i class="far fa-edit"></i></a>  ';
    if ($row['BiXoa'] == 1) {
        echo '<a href="/qlySanPham/index.php?mod=restore&id=' . $row['MaSanPham'] . '"><i class="fas fa-trash-restore-alt"></i></a>';
    } else {
        echo '<a href="/qlySanPham/index.php?mod=del&id=' . $row['MaSanPham'] . '"><i class="far fa-trash-alt"></i></a>';
    }
    echo '</div>';
    // Add the form and buttons here
    echo '<div class="list">
    <a href="/qlySanPham/index.php?mod=update&id=' . $row['MaSanPham'] . '"><button class="button">Sửa sản phẩm</button></a>';
    echo '<a href="/qlySanPham/index.php?mod=del&id=' . $row['MaSanPham'] . '"><button class="button1">Xóa sản phẩm</button></a>';
    echo '<a href="/qlySanPham/index.php?mod=giamgia&id=' . $row['MaSanPham'] . '"><button class="button2">Giảm giá sản phẩm</button></a>';

    echo '</div>';
    echo '</div>';
}
// Hiển thị các liên kết phân trang
$totalProductsQuery = "SELECT COUNT(*) as total FROM sanpham WHERE BiXoa = 0";
$totalProductsResult = mysqli_query($connection, $totalProductsQuery);
$totalProducts = mysqli_fetch_assoc($totalProductsResult)['total'];

$totalPages = ceil($totalProducts / $productsPerPage);

echo '<div class="pagination">';
if ($current_page > 1) {
    echo '<a href="/qlySanPham/index.php?page=' . ($current_page - 1) . '">Trở về</a>';
}

for ($i = max(1, $current_page - 2); $i <= min($current_page + 2, $totalPages); $i++) {
    if ($i == $current_page) {
        echo '<span class="current-page">' . $i . '</span>';
    } else {
        echo '<a href="/qlySanPham/index.php?page=' . $i . '">' . $i . '</a>';
    }
}

if ($current_page < $totalPages) {
    echo '<a href="/qlySanPham/index.php?page=' . ($current_page + 1) . '">Tiếp theo</i></a>';
}
echo '</div>';
?>