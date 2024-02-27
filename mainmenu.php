<div class="mainmenu">
    <div class="side">
        <div class="side1">
            <div class="qc">
                <!-- <img
                    src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2024/01/banner/trai-DCC-80x270.png"> -->

                <!-- <video controls autoplay muted>
		<source src="https://youtu.be/C2fX1pJrg3I">
	</video> -->

            </div>
            <div class="qc_right">

            </div>

        </div>

        <div class="qcdong">
            <?php
            include("side.php");
            ?>
        </div>

    </div>

    <div class="mainmenu" id="mainmenu">
        <div class="vienxanh">
            <div class="tit">HOT SALE CUỐI TUẦN</div>
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
        ?>
        <div class="vienxanh">
            <div class="tit">NEW</div>
        </div>

        <?php
        //lấy ngày hiện tại
        $date_hientai = date('Y-m-d');
        // tính ngày hiện tai cách ngày này 1 tháng. strtotime nhận 1 chuỗi thời gian và thực hiện pherp toán
        $date_1thangtruoc = date('Y-m-d', strtotime('-1 month', strtotime($date_hientai)));

        //10 san pham moi nhat 
        $sql = "SELECT * FROM sanpham WHERE BiXoa = 0 AND NgayNhap BETWEEN '$date_1thangtruoc' AND '$date_hientai' ORDER BY NgayNhap DESC LIMIT 10";

        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="hang1">';

            // 4. Xử lý kết quả của câu truy vấn (SELECT)
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['MaSanPham'];
                $name = $row['TenSanPham'];
                $price = $row['GiaSanPham'];
                $hinh = $row['HinhURL'];
                $sale = $row['GiaSauKhiGiam'];
                $icongiam = (($price - $sale) / $price * 100);
                echo '<div class="list2">';
                echo '<a href="/SanPham/index.php?mod=sanpham&id=' . $id . '">';
                echo '<img src="/images/' . $hinh . '" width="215px" height="200px">';
                if ($icongiam > 0 && $icongiam < 100) {
                    echo '<div class="htgg">-' . round($icongiam) . '%</div>';
                }
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
            echo '</div><div class="list"></div>';
            // echo'</div>';
        }
        ?>
        <!-- <div class="mainmenu"> -->
        <div class="vienxanh">
            <div class="tit">ANTEN</div>
        </div>

        <?php
        $sql = "SELECT * FROM sanpham WHERE BiXoa = 0 AND MaLoaiSanPham = 18 ORDER BY MaLoaiSanPham DESC LIMIT 10";

        // Thực thi câu truy vấn
        $result = mysqli_query($connection, $sql);
        echo '<div class="hang1">';

        // Xử lý kết quả của câu truy vấn (SELECT)
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['MaSanPham'];
            $name = $row['TenSanPham'];
            $price = $row['GiaSanPham'];
            $hinh = $row['HinhURL'];
            $sale = $row['GiaSauKhiGiam'];
            $icongiam = (($price - $sale) / $price * 100);

            echo '<div class="list2">';
            echo '<a href="/SanPham/index.php?mod=sanpham&id=' . $id . '">';
            echo '<img src="/images/' . $hinh . '" width="215px" height="200px">';

            // Kiểm tra nếu giá sau khi giảm bằng không
            if ($row['GiaSauKhiGiam'] > 0 && $row['GiaSanPham'] != $row['GiaSauKhiGiam']) {
                $giaGiam = $row['GiaSanPham'] - ($row['GiaSanPham'] * $row['GiaSauKhiGiam'] / 100);
                echo '<div class="htgg">-' . round($icongiam) . '%</div>';
                echo '<a id="tensp" href="/SanPham/index.php?mod=sanpham&id=' . $id . '"><p>' . $name . '</p></a>';
                echo '<span>';
                echo '<del style="color:red;">Giá gốc: ' . number_format($row['GiaSanPham'], 0) . ' đ</del><br>';
                echo 'Chỉ còn: ' . number_format($row['GiaSauKhiGiam'], 0) . ' đ<br>';
                echo '</span>';
            } else {
                echo '<a id="tensp" href="/SanPham/index.php?mod=sanpham&id=' . $id . '"><p>' . $name . '</p></a>';
                echo '<span>';
                echo '' . number_format($row['GiaSanPham'], 0) . ' đ<br>';
                echo '</span>';
            }

            echo '</a></div>';
        }
        ?>


        <div class="vienxanh">
            <div class="tit">LINH KIỆN</div>
        </div>

        <?php
        $sql = "SELECT * FROM sanpham WHERE BiXoa = 0 AND MaLoaiSanPham=16 ORDER BY MaLoaiSanPham DESC LIMIT 10";

        // 3. Thực thi câu truy vấn
        $result = mysqli_query($connection, $sql);
        echo '<div class="hang1">';

        // 4. Xử lý kết quả của câu truy vấn (SELECT)
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['MaSanPham'];
            $name = $row['TenSanPham'];
            $price = $row['GiaSanPham'];
            $hinh = $row['HinhURL'];
            $sale = $row['GiaSauKhiGiam'];
            $icongiam = (($price - $sale) / $price * 100);
            echo '<div class="list2">';
            echo '<a href="/SanPham/index.php?mod=sanpham&id=' . $id . '">';
            echo '<img src="/images/' . $hinh . '" width="215px" height="200px">';
            if ($icongiam > 0 && $icongiam < 100) {
                echo '<div class="htgg">-' . round($icongiam) . '%</div>';
            }
            echo '<a id="tensp" href="/SanPham/index.php?mod=sanpham&id=' . $id . '"><p>' . $name . '</p></a>';
            echo '<span>';
            if ($row['GiaSauKhiGiam'] > 0 && $row['GiaSanPham'] != $row['GiaSauKhiGiam']) {
                $giaGiam = $row['GiaSanPham'] - ($row['GiaSanPham'] * $row['GiaSauKhiGiam'] / 100);
                echo '<del style="color:red;">Giá gốc: ' . number_format($row['GiaSanPham'], 0) . ' đ</del><br>';
                echo 'Chỉ còn: ' . number_format($row['GiaSauKhiGiam'], 0) . ' đ<br>';
            } else {
                echo '' . number_format($row['GiaSanPham'], 0) . ' đ<br>';
            }
            echo '</span></br></br></div>';
        }
        echo '</div><div class="list"></div>';
        echo '</div>';

        ?>

        <div class="vienxanh">
            <div class="tit">TAI NGHE - MICROPHONE</div>
        </div>
        <?php

        //10 san pham moi nhat 
        // 2. Tạo câu truy vấn (Query): SELECT, INSERT, DELETE, UPDATE
        $sql = "SELECT * FROM sanpham WHERE BiXoa = 0 AND MaLoaiSanPham=17 ORDER BY MaLoaiSanPham DESC LIMIT 10";

        // 3. Thực thi câu truy vấn
        $result = mysqli_query($connection, $sql);
        echo '<div class="hang1">';

        // 4. Xử lý kết quả của câu truy vấn (SELECT)
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['MaSanPham'];
            $name = $row['TenSanPham'];
            $price = $row['GiaSanPham'];
            $hinh = $row['HinhURL'];
            $sale = $row['GiaSauKhiGiam'];
            $icongiam = (($price - $sale) / $price * 100);
            echo '<div class="list2">';
            echo '<a href="/SanPham/index.php?mod=sanpham&id=' . $id . '">';
            echo '<img src="/images/' . $hinh . '" width="215px" height="200px">';
            if ($icongiam > 0 && $icongiam < 100) {
                echo '<div class="htgg">-' . round($icongiam) . '%</div>';
            }
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
        echo '</div><div class="list"></div>';
        echo '</div>';
        ?>

        <div class="vienxanh">
            <div class="tit">TẤT CẢ SẢN PHẨM</div>
        </div>
        <?php

        $sql = "SELECT * FROM sanpham WHERE BiXoa = 0";
        $result = mysqli_query($connection, $sql);
        echo '<div class="hang1">';

        // 4. Xử lý kết quả của câu truy vấn (SELECT)
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['MaSanPham'];
            $name = $row['TenSanPham'];
            $price = $row['GiaSanPham'];
            $hinh = $row['HinhURL'];
            $sale = $row['GiaSauKhiGiam'];
            $icongiam = (($price - $sale) / $price * 100);
            echo '<div class="list2">';
            echo '<a href="/SanPham/index.php?mod=sanpham&id=' . $id . '">';
            echo '<img src="/images/' . $hinh . '" width="215px" height="200px">';
            if ($icongiam > 0 && $icongiam < 100) {
                echo '<div class="htgg">-' . round($icongiam) . '%</div>';
            }
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
        echo '<div class="list"></div>';
        ?>
    </div>
</div>