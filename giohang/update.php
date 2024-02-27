<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
if (isset($_POST['soluong'])) {
    $soluong = $_POST['soluong'];
    $sql = "SELECT * FROM sanpham WHERE MaSanPham = '$id'";
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($query);

    if ($soluong > $row['SoLuong']) {
            echo '<script>
                    alert("Số lượng bạn muốn mua lớn hơn số lượng hàng còn trong kho.");
                    window.location.href = "../giohang";
                  </script>';
    } else {
    if ($soluong == 0) {
        unset($_SESSION['cart'][$id]); 
    } else {
        $sql_s="SELECT * FROM sanpham WHERE MaSanPham='$id'"; 
        $query_s=mysqli_query($connection, $sql_s); 
        if($query_s != NULL){ 
            $row_s=mysqli_fetch_array($query_s); 
            $gia = (double)$row_s['GiaSanPham'];
            $_SESSION['cart'][$row_s['MaSanPham']]=array( 
                    "soluong" => $soluong
                ); 
        }
    }
    ChangeURL("../giohang");
}
}


}
?>