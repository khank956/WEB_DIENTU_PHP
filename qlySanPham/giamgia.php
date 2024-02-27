<?php
// Assume you have a database connection named $connection
// You may need to include your database connection code here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure that $product_id is set and is a non-empty value
    $product_id = isset($_GET['id']) ? mysqli_real_escape_string($connection, $_GET['id']) : null;
    $discount_percentage = isset($_POST['GiaGiam']) ? floatval($_POST['GiaGiam']) : null;

    if ($product_id !== null && $discount_percentage !== null) {
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $get_product_query = "SELECT * FROM sanpham WHERE MaSanPham = $product_id";
        $get_product_result = mysqli_query($connection, $get_product_query);

        if ($get_product_result && mysqli_num_rows($get_product_result) > 0) {
            $product_info = mysqli_fetch_assoc($get_product_result);

            // Lấy giá gốc và tính giá giảm
            $original_price = $product_info['GiaSanPham'];
            $discounted_price = $original_price - ($original_price * $discount_percentage / 100);

            // Cập nhật giảm giá vào cơ sở dữ liệu
            $update_discount_query = "UPDATE sanpham SET GiaSauKhiGiam = $discounted_price WHERE MaSanPham = $product_id";
            mysqli_query($connection, $update_discount_query);

            echo "<div class='list'>
            Cập nhật giảm giá sản phẩm thành công. <a href='/qlySanPham/index.php?mod=panel'>Quay lại</a></div>";
            exit;
        } else {
            echo "Sản phẩm không tồn tại!";
        }
    } else {
        echo "Dữ liệu không hợp lệ!";
    }
}
?>
<form method="post" action="">
    <label for="GiaGiam">Chọn mốc mà bạn muốn giảm: </label>
    <select name="GiaGiam" id="discount_percentage">
        <option value="0">0</option>
        <option value="10">10%</option>
        <option value="15">15%</option>
        <option value="20">20%</option>
        <option value="30">30%</option>
        <option value="50">50%</option>
        <option value="70">70%</option>
    </select>
    <input type="submit" value="Cập nhật giảm giá">
</form>