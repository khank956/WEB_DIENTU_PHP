<?php
if (isset($_POST['ThanhToan'])) {
    
    $user = $_SESSION['username'];
    $nguoidung = "SELECT * FROM taikhoan WHERE TenDangNhap = '$user'";
    $ngdung = mysqli_query($connection, $nguoidung);
    $ngd = mysqli_fetch_array($ngdung);
    $users = $ngd['MaTaiKhoan'];

    $sql="SELECT * FROM sanpham WHERE MaSanPham IN ("; 
    foreach($_SESSION['cart'] as $id => $value) { 
        $sql.=$id.","; 
    } 
    $sql=substr($sql, 0, -1).") ORDER BY MaSanPham ASC"; 
    $query = mysqli_query($connection, $sql);
    $tongtien = 0.0;
    while ($row = mysqli_fetch_array($query)) {
    $soluong = $_SESSION['cart'][$row['MaSanPham']]['soluong'];
    $thanhtien = $soluong * $row['GiaSanPham'];
    $tongtien = $tongtien + $thanhtien;
    }
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $ngaylap = date("Y-m-d H:i:s");
    // tao don hang
    $them = "INSERT INTO dondathang (NgayLap, TongThanhTien, MaTaiKhoan, MaTinhTrang) VALUES ('$ngaylap','$tongtien','$users', 1)";
    $them2 = mysqli_query($connection, $them);
    // Lấy mã đơn đặt hàng vừa tạo
    $ddh = "SELECT * FROM dondathang ORDER BY MaDonDatHang DESC LIMIT 1";
    $tvddh = mysqli_query($connection, $ddh);
    $dondathang = mysqli_fetch_array($tvddh);
    $maddh = $dondathang['MaDonDatHang'];

    // Thêm chi tiết đơn hàng
    foreach ($_SESSION['cart'] as $id => $value) {
        $sl = $value['soluong'];
        $masp = $id;

        // Cập nhật số lượng đã bán
        $capNhatSoLuongDaBan = "UPDATE sanpham SET SoLuongDaBan = SoLuongDaBan + $sl WHERE MaSanPham = '$masp'";
        $result = mysqli_query($connection, $capNhatSoLuongDaBan);

        // Kiểm tra kết quả cập nhật (tùy chọn)
        if (!$result) {
            echo "Lỗi cập nhật số lượng đã bán: " . mysqli_error($connection);
        }
    }

    



    // chi tiet don hang
    $ddh = "SELECT * FROM dondathang ORDER BY MaDonDatHang DESC LIMIT 1";
    $tvddh = mysqli_query($connection, $ddh);
    $dondathang = mysqli_fetch_array($tvddh);
    $maddh = $dondathang['MaDonDatHang'];
    $tvsp="SELECT * FROM sanpham WHERE MaSanPham IN ("; 
    foreach($_SESSION['cart'] as $id => $value) { 
        $tvsp.=$id.","; 
    } 
    $tvsp=substr($tvsp, 0, -1).") ORDER BY MaSanPham ASC"; 
    $sp = mysqli_query($connection, $tvsp);
    while ($r = mysqli_fetch_array($sp)) {
        $sl = $_SESSION['cart'][$r['MaSanPham']]['soluong'];
        $giasp = $r['GiaSanPham'];
        $masp = $r['MaSanPham'];
        $add = "INSERT INTO chitietdondathang (
            SoLuong,
            GiaBan,
            MaDonDatHang,
            MaSanPham
            ) VALUES (
            '$sl',
            '$giasp',
            '$maddh',
            '$masp'
            )";
        $themct = mysqli_query($connection, $add);
        
    }
    echo '<script>
                    alert("Bạn đã đặt hàng thành công");
                    window.location.href = "../index.php";
                  </script>';
    unset($_SESSION['cart']);

}

    

?>