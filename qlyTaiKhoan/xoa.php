<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM taikhoan  WHERE MaTaiKhoan = '$id'";
    $result = mysqli_query($connection, $sql);
}
    ChangeURL('../qlyTaiKhoan');
?>