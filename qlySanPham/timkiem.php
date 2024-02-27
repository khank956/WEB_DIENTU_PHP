<?php
require("../adminpanel/header.php");

// Nếu người dùng submit form thì thực hiện
if (isset($_REQUEST['ok'])) {
    // Gán hàm addslashes để chống sql injection
    $search = addslashes($_GET['search']);

    // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
    if (empty($search)) {
        echo "Yeu cau nhap du lieu vao o trong";
    } else {
        // Dùng câu lệnh like trong SQL và sử dụng toán tử % của PHP để tìm kiếm dữ liệu chính xác hơn.
        $query = "SELECT * FROM sanpham WHERE TenSanPham like '%$search%'";

        // Thực thi câu truy vấn
        $sql = mysqli_query($connection, $query);

        // Đếm số dòng trả về trong SQL.
        $num = mysqli_num_rows($sql);
        echo '<div class="list"><a href="/qlySanPham/index.php?mod=add"><button class="button">Thêm sản phẩm</button></a></div>
<div class="search1">
    <form action="../qlySanPham/timkiem.php" method="get">
        <input type="text" size="50" name="search" placeholder="Nhập sản phẩm bạn tìm kiếm"
            style="display: inline-block;">
        <button type="submit" name="ok">Tìm kiếm</button>
    </form>
</div>';
        // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
        if ($num > 0 && $search != "") {
            // Dùng $num để đếm số dòng trả về.
            echo "<div class='mainmenu'><p><h2 style='font-weight: normal;'>Có <b>$num </b>kết quả trả về với từ khóa $search</h2></p>";

            // Vòng lặp while & mysqli_fetch_assoc dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.
            while ($row = mysqli_fetch_array($sql)) {
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
            echo '</div>';
        } else {
            echo "Khong tim thay ket qua!";
        }
    }
}