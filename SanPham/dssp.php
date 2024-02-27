<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // 2. Tạo câu truy vấn (Query): SELECT, INSERT, DELETE, UPDATE
    $sql = "SELECT * FROM sanpham WHERE MaLoaiSanPham = $id";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($connection, $sql);
    $loai = "SELECT * FROM loaisanpham WHERE MaLoaiSanPham = $id";
    $loaisp = mysqli_query($connection, $loai);
    $loaisp = mysqli_fetch_array($loaisp);
?>
<div id="vien">
    <div class="center">
        <div id="ban">
            <a id="ba" href="/index.php">Trang chủ</a> >
            <font color="#008744">
                <?php
                echo ''.$loaisp['TenLoaiSanPham'].'';
                ?>
            </font>
        </div>
    </div>
</div>
<?php
    echo '<div class="center">';
    echo'<div class="hang1">';

    // 4. Xử lý kết quả của câu truy vấn (SELECT)
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['MaSanPham'];
        $name = $row['TenSanPham'];
        $price = $row['GiaSanPham'];
        $hinh = $row['HinhURL'];
        $sale = $row['GiaSauKhiGiam'];
        $icongiam = (($price - $sale) / $price * 100);
        echo '<div class="list2"><a href="/SanPham/index.php?mod=sanpham&id=' . $id . '">
        <img src="/images/' . $hinh . '" width="215px" height="200px"></a>';

        if ($row['GiaSauKhiGiam'] > 0 && $row['GiaSanPham'] != $row['GiaSauKhiGiam']) {
            $giaGiam = $row['GiaSanPham'] - ($row['GiaSanPham'] * $row['GiaSauKhiGiam'] / 100);
            echo '<div class="htgg">-' . round($icongiam) . '%</div>';
            
        echo '<a id="tensp" href="/SanPham/index.php?mod=sanpham&id=' . $id . '"><p>' . $name . '</p></a>';
        echo '<span>';
            echo '<del style="color:red;">Giá gốc: ' . number_format($row['GiaSanPham'], 0) . ' đ</del><br>';
            echo 'Chỉ còn: ' . number_format($row['GiaSauKhiGiam'], 0) . ' đ<br>';
            echo '</span>';
        }else{
            echo '<a id="tensp" href="/SanPham/index.php?mod=sanpham&id=' . $id . '"><p>' . $name . '</p></a>';
            echo '<span>';
            echo '' . number_format($row['GiaSanPham'], 0) . ' đ<br>';
            echo '</span>';
        }

        echo '</span></div>';
    }
    echo'</div>';
}
echo'</div>';
include("../footer.php");
echo '</div>';
?>