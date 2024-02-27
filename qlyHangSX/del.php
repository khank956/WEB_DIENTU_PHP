<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM hangsanxuat WHERE MaHangSanXuat = '$id'";
    $result = mysqli_query($connection, $sql);
}
ChangeURL("../qlyHangSX");
?>