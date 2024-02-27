<?php
$ok=1;
 if(isset($_SESSION['cart']))
 {
  foreach($_SESSION['cart'] as $k=>$v)
  {
   if(isset($v))
   {
   $ok=2;
   }
  }
 }

 ?>
<div id="vien">
    <div class="center">
        <div id="ban">
            <a id="ba" href="/index.php">Trang chủ</a> >
            <font color="#008744">Giỏ hàng</font>
        </div>
    </div>
</div>
<div class="list">
    <div class="ban">
        <h2><b>GIỎ HÀNG</b></h2>
    </div>
</div>
<div class="mainmenu">

    <?php
 if ($ok != 2)
  {
  echo '<div class="list">Không có sản phẩm nào. <a href="/index.php">Quay lại cửa hàng</a> để tiếp tục mua sắm.</div></div>';

 } else {

  $items = $_SESSION['cart'];
  $tongtien = 0;
  $tongtien = (double)$tongtien;
  $sql="SELECT * FROM sanpham WHERE MaSanPham IN ("; 
  foreach($_SESSION['cart'] as $id => $value) { 
      $sql.=$id.","; 
  } 
  $sql=substr($sql, 0, -1).") ORDER BY MaSanPham ASC"; 
  $query = mysqli_query($connection, $sql);

  echo '<table width="100%" style="border:1px solid #ebebeb;border-collapse:collapse;">';
  echo'<tr>
  <th colspan="1" style="border:1px solid #ebebeb; text-align: center;">Ảnh sản phẩm</th>
  <th colspan="1" style="border:1px solid #ebebeb; text-align: center;">Tên sản phẩm</th>
  <th colspan="1" style="border:1px solid #ebebeb; text-align: center;">Đơn giá</th>
  <th colspan="1" style="border:1px solid #ebebeb; text-align: center;">Số lượng</th>
  <th colspan="1" style="border:1px solid #ebebeb; text-align: center;" >Thành tiền</th>
  <th colspan="1" style="border:1px solid #ebebeb; text-align: center;">Xóa</th>
  </tr>';

  while ($row = mysqli_fetch_array($query)) {
    $soluong = $_SESSION['cart'][$row['MaSanPham']]['soluong'];
    echo'<tr><td width="20%" style="border:1px solid #ebebeb; text-align: center;"><img src="../images/'.$row['HinhURL'].'" width="100" height="100"></td>';
    echo'<td width="40%" style="border:1px solid #ebebeb;">'.$row['TenSanPham'].'</td>';
    echo'<td width="10%" style="border:1px solid #ebebeb; text-align: center;"><font color="##008744"><b>';
            if ($row['GiaSauKhiGiam'] > 0 && $row['GiaSanPham'] != $row['GiaSauKhiGiam']) {
                $giaGiam = $row['GiaSanPham'] - ($row['GiaSanPham'] * $row['GiaSauKhiGiam'] / 100);
                echo '' . number_format($row['GiaSauKhiGiam'], 0) . ' đ<br>';
            } else {
                echo '' . number_format($row['GiaSanPham'], 0) . ' đ<br>';
            }
    echo '<td width="10%" style="border:1px solid #ebebeb; text-align: center;">';
    echo'<form action="../giohang/index.php?mod=update&id='.$row['MaSanPham'].'" method="POST">';
?>

    <input type="number" style="width: 40px;" name="soluong" size="5"
        value="<?php echo $_SESSION['cart'][$row['MaSanPham']]['soluong'] ?>" />


    <?php
    echo'<input type="submit" name="update" value="Cập nhật sản phẩm">';
    echo '</form></td>';
        $giaSauKhiGiam = ($row['GiaSauKhiGiam'] > 0 && $row['GiaSanPham'] != $row['GiaSauKhiGiam']) ? $row['GiaSauKhiGiam'] : $row['GiaSanPham'];
        $thanhtien = $soluong * $giaSauKhiGiam;
        $tongtien = $tongtien + $thanhtien;

        // Kiểm tra trước khi giảm số lượng trong cơ sở dữ liệu
        if ($soluong > 0) {
            $soLuongConLai = $row['SoLuong'] - $soluong;
            $soLuongConLai = max(0, $soLuongConLai); // Đảm bảo số lượng không bao giờ âm

            // Thực hiện giảm số lượng trong cơ sở dữ liệu
            $updateQuery = "UPDATE sanpham SET SoLuong = $soLuongConLai WHERE MaSanPham = " . $row['MaSanPham'];
            mysqli_query($connection, $updateQuery);
        }

        // Kiểm tra trước khi xóa sản phẩm khỏi giỏ hàng
        if ($soluong <= 0) {
            // Lưu số lượng hiện tại trong giỏ hàng
            $soluongGioHang = $_SESSION['cart'][$row['MaSanPham']]['soluong'];

            // Nếu số lượng trong giỏ hàng là 0, xóa sản phẩm khỏi giỏ hàng
            if ($soluongGioHang == 0) {
                unset($_SESSION['cart'][$row['MaSanPham']]);
            } else {
                // Nếu số lượng trong giỏ hàng không phải là 0, cập nhật lại số lượng trong giỏ hàng
                $_SESSION['cart'][$row['MaSanPham']]['soluong'] = $soluongConLai;
            }
        }

    echo '<td width="10%"style="border:1px solid #ebebeb; text-align: center;"><font color="##008744"><b>';
    echo number_format($thanhtien, 0).' đ</b></font></td>';



            echo '<td width="5%" style="border:1px solid #ebebeb; text-align: center;">';
            echo '<a href="../giohang/index.php?mod=xoa&id=' . $row['MaSanPham'] . '" style="text-decoration: none; color: #444;"><i class="far fa-trash-alt" aria-hidden="true" style="font-size: 25px;"></i>';
            echo '</a>';
            echo '</td>';
            echo '</tr>'; 

  }
  
  echo'</table>';
  echo'<div class="tongtien"> Tổng tiền: <font color="##008744"><b>';
  echo number_format($tongtien, 0).' đ</b></font></td>';
  echo'</div>';
        //thong tin dat hag
        if (isset($_SESSION['username'])) {
            // Lấy thông tin người dùng từ session
            $username = $_SESSION['username'];

            // Hiển thị thông tin đặt hàng
            echo '<div id="checkout-container">';
            echo '<h2>Thông tin đặt hàng:</h2>';

            // Truy vấn cơ sở dữ liệu để lấy thông tin đặt hàng của người đăng nhập
            $sqltt = "SELECT * FROM taikhoan WHERE TenDangNhap='$username'";
            $resultt = mysqli_query($connection, $sqltt);

            $rowtt = mysqli_fetch_array($resultt);
                echo '<p><strong>Họ và tên:</strong> ' . $rowtt['HoTen'] . '</p>';
                // Chuyển định dạng ngày sinh
                $ngaySinh = $rowtt['NgaySinh'];
                $ngaySinhFormatted = date("d/m/Y", strtotime($ngaySinh));
                echo '<p><strong>Ngày Sinh:</strong> ' . $ngaySinhFormatted . '</p>';
                echo '<p><strong>Email:</strong> ' . $rowtt['Email'] . '</p>';
                echo '<p><strong>Địa chỉ:</strong> ' . $rowtt['DiaChi'] . '</p>';
                echo '<p><strong>Số điện thoại:</strong> ' . $rowtt['DienThoai'] . '</p>';

    echo '<div class="canhphai">';
        echo '<form action="../giohang/index.php?mod=thanhtoan" method="POST">';
            echo '<a class="submit" href="/index.php">Tiếp tục mua sắm</a>';
            echo '<input type="submit" name="ThanhToan" value="Thực hiện thanh toán"></div>
    </form>';
    echo '
</div>';
} else {
// Nếu người dùng chưa đăng nhập, bạn có thể xử lý nó ở đây
echo 'Bạn cần đăng nhập để xem thông tin đặt hàng.';
}
echo '</div>';


}
?>
</div>