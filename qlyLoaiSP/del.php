<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM loaisanpham WHERE MaLoaiSanPham = '$id'";
    $result = mysqli_query($connection, $sql);
}
ChangeURL("../qlyLoaiSP");
?>