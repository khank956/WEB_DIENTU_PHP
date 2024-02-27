<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sessionKey = 'post_' . $id;
    if (isset($_SESSION[$sessionKey])) {
    } else {
        $_SESSION[$sessionKey] = 1;
        $s = "UPDATE sanpham SET SoLuotXem = SoLuotXem + 1 WHERE MaSanPham = '$id'";
        $ss = mysqli_query($connection, $s);
    }

    $sql = "SELECT * FROM sanpham WHERE MaSanPham='$id'";
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($query);

    $th = "SELECT * FROM hangsanxuat WHERE MaHangSanXuat = '" . $row['MaHangSanXuat'] . "'";
    $th2 = mysqli_query($connection, $th);
    $thuonghieu = mysqli_fetch_array($th2);

    $lsp = "SELECT * FROM loaisanpham WHERE MaLoaiSanPham = '" . $row['MaLoaiSanPham'] . "'";
    $lsp2 = mysqli_query($connection, $lsp);
    $loaisp = mysqli_fetch_array($lsp2);
    // Update lượt xem
    $SoLuotXem = "SELECT SoLuotXem FROM sanpham WHERE MaSanPham='$id'";
    $countSoLuotXem = mysqli_query($connection, $SoLuotXem);

    if ($countSoLuotXem) {
        $rowSoLuotXem = mysqli_fetch_array($countSoLuotXem);
        $soLuotXemHienTai = $rowSoLuotXem['SoLuotXem'];

        // Tăng số lượt xem và cập nhật vào cơ sở dữ liệu
        $soLuotXemMoi = $soLuotXemHienTai + 1;
        $updateSoLuotXem = "UPDATE sanpham SET SoLuotXem = $soLuotXemMoi WHERE MaSanPham='$id'";
        $countUpdateSoLuotXem = mysqli_query($connection, $updateSoLuotXem);
    } else {
        echo "Lỗi truy vấn số lượt xem: " . mysqli_error($connection);
    }

    echo '<div id="vien"><div class="center"><div id="ban" style="font-size:25px;"><font color="#008744;">' . $row['TenSanPham'] . '</font></div></div></div>';
    echo '<div class="list">';
    echo '<table><tr><td class="ShowAnh" style="vertical-align: top;">'; // Adjusted style here
    echo '<img src="../images/' . $row['HinhURL'] . '"></td><td style="float: right;magin-right:-20px; vertical-align: top;">'; // Adjusted style here
    echo '<h2>' . $row['TenSanPham'] . '</h2>';
    echo 'Thương hiệu: <font color="#008744">' . $thuonghieu['TenHangSanXuat'] . '</font> | ';

    if ($row['SoLuong'] > 0) {
        echo 'Tình trạng: <font color="#008744">Còn hàng <sup>' . $row['SoLuong'] . '</sup> </font>';
        echo '<p style="font-size: 30px;line-height: 30px;color: #008744;font-weight: bold;margin-top: 20px;margin-bottom: 20px;">';

        if ($row['GiaSauKhiGiam'] > 0 && $row['GiaSanPham'] != $row['GiaSauKhiGiam']) {
            $giaGiam = $row['GiaSanPham'] - ($row['GiaSanPham'] * $row['GiaSauKhiGiam'] / 100);
            echo '<del style="color:red;">Giá gốc: ' . number_format($row['GiaSanPham'], 0) . ' đ</del><br>';
            echo 'Giá giảm còn: ' . number_format($row['GiaSauKhiGiam'], 0) . ' đ<br>';
        } else {
            echo 'Giá: ' . number_format($row['GiaSanPham'], 0) . ' đ<br>';
        }



        echo '</p>';
        echo '<p>- Loại sản phẩm: ' . $loaisp['TenLoaiSanPham'] . '<br />' . $row['MoTa'] .
        ' - Bảo hành: ' . $row['BaoHanh'] . ' năm';
        echo '<br />- Số lượt xem: ' . $row['SoLuotXem'] . '';
        echo '<br /><br /><br /><a class="submit3" href="../giohang/index.php?mod=them&item=' . $row['MaSanPham'] . '">Mua hàng</a>';
        echo '</p>';
    }
    echo '</td></tr></table>';
    echo '</div>';



$sqlsp="SELECT * FROM sanpham WHERE BiXoa = 0 AND MaLoaiSanPham = '" . $row['MaLoaiSanPham'] . "' AND MaSanPham !=
    '" . $row['MaSanPham'] . "' ORDER BY SoLuongDaBan ASC LIMIT 5";
$result=mysqli_query($connection,$sqlsp);
if(mysqli_num_rows($result)>0){
        echo '<div class="mainmenu">
    <div class="vienxanh">
        <div class="tit">SẢN PHẨM CÙNG LOẠI</div>
    </div>';
    while($show=mysqli_fetch_array($result)){
            $id = $show['MaSanPham'];
            $name = $show['TenSanPham'];
            $price = $show['GiaSanPham'];
            $hinh = $show['HinhURL'];
            echo '<div class="list2"><a href="/SanPham/index.php?mod=sanpham&id=' . $id . '">
            <img src="/images/' . $hinh . '" width="105px" height="200px"></a>';
            echo '<a id="tensp" href="/SanPham/index.php?mod=sanpham&id=' . $id . '">
            <p>' . $name . '</p>
            </a>';

            echo '<span>';
            if ($row['GiaSauKhiGiam'] > 0) {
                // Hiển thị giá giảm và giá gốc cùng lúc nếu có giảm giá
                $giaGiam = $row['GiaSanPham'] - ($row['GiaSanPham'] * $row['GiaSauKhiGiam'] / 100);
                echo '<del style="color:red;">Giá gốc: ' . number_format($row['GiaSanPham'], 0) . ' đ</del><br>';
                echo 'Giá giảm còn: ' . number_format($row['GiaSauKhiGiam'], 0) . ' đ<br>';
            } else {
                // Nếu không có giảm giá, hiển thị giá gốc như bình thường
                echo 'Giá: ' . number_format($row['GiaSanPham'], 0) . ' đ<br>';
            }
            echo '</span></div>';
    }
    
}
else{
        echo '<div class="mainmenu">
    <div class="vienxanh">
        <div class="tit">NHỮNG SẢN PHẨM KHÁC</div>
    </div>';
        $spcl ="SELECT * FROM sanpham WHERE BiXoa = 0 AND MaLoaiSanPham != '" . $row['MaLoaiSanPham'] . "' ORDER BY RAND() LIMIT 5";
        $tvspcl = mysqli_query($connection, $spcl);
        while ($showkhac = mysqli_fetch_array($tvspcl)) {
            $id = $showkhac['MaSanPham'];
            $name = $showkhac['TenSanPham'];
            $price = $showkhac['GiaSanPham'];
            $hinh = $showkhac['HinhURL'];
            echo '<div class="list2"><a href="/SanPham/index.php?mod=sanpham&id=' . $id . '">
            <img src="/images/' . $hinh . '" width="215px" height="200px"></a>';
            echo '<a id="tensp" href="/SanPham/index.php?mod=sanpham&id=' . $id . '">
            <p>' . $name . '</p>
        </a>';

            echo '<span>';
            echo number_format($price, 0) . ' đ<br>';
            echo '</span></div>';
        }
} 
    echo ' </div>';
include("../footer.php");
echo '</div>';
}