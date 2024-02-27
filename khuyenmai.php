<?php
include("header.php");
?>

<div class="mainmenu">
    <div class="vienxanh">
        <div class="tit">KHUYẾN MÃI</div>
    </div>

    <?php
    //10 san pham bị ế

    $sql = "SELECT * FROM sanpham WHERE BiXoa = 0 AND GiaSauKhiGiam > 0 AND GiaSauKhiGiam != GiaSanPham ORDER BY MaLoaiSanPham DESC LIMIT 10";


    // 3. Thực thi câu truy vấn
    $result = mysqli_query($connection, $sql);
    echo '<div class="hang1">';

    // 4. Xử lý kết quả của câu truy vấn (SELECT)
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['MaSanPham'];
        $name = $row['TenSanPham'];
        $price = $row['GiaSanPham'];
        $sale = $row['GiaSauKhiGiam'];
        $hinh = $row['HinhURL'];
        $icongiam = (($price - $sale) / $price * 100);
        echo '<div class="list2">';
        echo '<a href="/SanPham/index.php?mod=sanpham&id=' . $id . '">';
        echo '<img src="/images/' . $hinh . '" width="215px" height="200px">';


        if ($icongiam > 0) {
            echo '<div class="htgg">-' . round($icongiam) . '%</div>';
        }

        echo '</a>';
        echo '<a id="tensp" href="/SanPham/index.php?mod=sanpham&id=' . $id . '"><p>' . $name . '</p></a>';
        echo '<span>';
        if ($row['GiaSauKhiGiam'] > 0 && $row['GiaSanPham'] != $row['GiaSauKhiGiam']) {
            $giaGiam = $row['GiaSanPham'] - ($row['GiaSanPham'] * $row['GiaSauKhiGiam'] / 100);
            echo '<del style="color:red;">Giá gốc: ' . number_format($row['GiaSanPham'], 0) . ' đ</del><br>';
            echo 'Chỉ còn: ' . number_format($row['GiaSauKhiGiam'], 0) . ' đ<br>';
        } else {
            echo '' . number_format($row['GiaSanPham'], 0) . ' đ<br>';
        }

        echo '</span></br></div>';
    }
    echo '</div>';
    echo '</div>';

    include("footer.php");
    ?>