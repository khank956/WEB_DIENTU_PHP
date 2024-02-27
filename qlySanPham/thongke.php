<div id="vien">
    <div class="center">
        <div id="ban">
            <a id="ba" href="../adminpanel/index.php">Trang chủ</a> > <a id="ba" href="/adminpanel/index.php">Admin
                Panel</a> >
            <font color="#008744"><a href="../qlySanPham/index.php">Quản lý sản phẩm</a></font>
        </div>
    </div>
</div>
<style>
.container {
    display: flex;
    justify-content: space-between;
    margin: 20px 0;
}

.table-container {
    flex-grow: 1;
    margin-right: 20px;
    text-align: center
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table,
th,
td {
    border: 1px solid #ddd;

}

th,
td {
    padding: 8px;
    text-align: center;
}
</style>
<div class="container">
    <div class="table-container">
        <?php
        $sql = "SELECT TenSanPham,GiaSanPham,GiaSauKhiGiam, SoLuongDaBan FROM sanpham where SoLuongDaBan>0 ORDER BY SoLuongDaBan DESC";
        $result = mysqli_query($connection, $sql);

        if ($result) {
            echo '<h2>  Những sản phẩm đã bán được</h2>';
            echo '<table>
             <tr>
                 <th>Tên Sản Phẩm</th>
                 <th>Giá sản phẩm</th>
                 <th>Số Lượng Đã Bán</th>
             </tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
             <td>' . $row['TenSanPham'] . '</td>';

                if ($row['GiaSauKhiGiam'] > 0) {
                    // Nếu có giảm giá, hiển thị giá sau khi giảm
                    echo '<td>' . number_format($row['GiaSauKhiGiam'], 0) . '</td>';
                } else {
                    // Nếu không có giảm giá, hiển thị giá sản phẩm
                    echo '<td>' . number_format($row['GiaSanPham'], 0) . '</td>';
                }

                echo '<td>' . $row['SoLuongDaBan'] . '</td>
          </tr>';
            }
            echo '</table>';
        } else {
            echo "Lỗi truy vấn: " . mysqli_error($connection);
        }
        ?>
    </div>
    <div class="table-container">
        <?php
        //tổng số lượng
        $sqlsl = "SELECT SUM(SoLuongDaBan) AS TongSoLuongDaBan FROM sanpham WHERE SoLuongDaBan>0";
        $resultsl = mysqli_query($connection, $sqlsl);
        $rowsldb = mysqli_fetch_assoc($resultsl);
        $tongsldaban = $rowsldb['TongSoLuongDaBan'];
        //tổng doanh thu\
        $sqldoanhthu = "SELECT SUM(CASE WHEN GiaSauKhiGiam > 0 THEN SoLuongDaBan * GiaSauKhiGiam ELSE SoLuongDaBan * GiaSanPham END) AS TongDoanhThu FROM sanpham WHERE SoLuongDaBan > 0";
        $resultdoanhthu = mysqli_query($connection, $sqldoanhthu);
        $rowdoanhthu = mysqli_fetch_assoc($resultdoanhthu);
        $tongDoanhThu = $rowdoanhthu['TongDoanhThu'];


        echo '<h2>Thống kê</h2>';
        echo '<table>
    <tr>
        <th>Tổng số lượng đã bán</th>
        <th>Doanh thu: </th>
    </tr>';
        echo '<tr>
            <td>' . $tongsldaban . '</td>
            <td>' . number_format($tongDoanhThu, 0) . '</td>
        </tr>';


        echo '</table>';
        echo '
    </div>';

        ?>
    </div>
    <?php
    $sql = "SELECT TenSanPham,SoLuongDaBan FROM sanpham WHERE SoLuongDaBan=0 ORDER BY SoLuongDaBan DESC";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo '<div class="full">';
        echo '<h2>  Những sản phẩm bị ế</h2>';
        echo '<table>
             <tr>
                 <th>Tên Sản Phẩm</th>
                 <th>Số Lượng Đã Bán</th>
             </tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                 <td>' . $row['TenSanPham'] . '</td>
                 <td>' . $row['SoLuongDaBan'] . '</td>
              </tr>';
        }
        echo '</table>';
    } else {
        echo "Lỗi truy vấn: " . mysqli_error($connection);
    }

    echo '</div>';
    ?>
</div>