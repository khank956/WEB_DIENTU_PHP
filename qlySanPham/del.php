<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql ="DELETE FROM sanpham WHERE MaSanPham = '$id'";
    $result = mysqli_query($connection, $sql);
    // echo "<div class='listdel'>Đã xóa sản phẩm <a href='/qlySanPham/index.php?mod=panel'>Quay lại</a></div>";
}
 ChangeURL("../qlySanPham");