<div id="vien">
    <div class="center">
        <div id="ban">
            <a id="ba" href="/index.php">Trang chủ</a> > <a id="ba" href="/adminpanel/index.php">Admin Panel</a> >
            <font color="#008744">Quản lý thương hiệu</font>
        </div>
    </div>
</div>
<div class="list"><a href="/qlyHangSX/index.php?mod=add"><button class="button">Thêm thương hiệu</button></a></div>
<?php
// 2. Tạo câu truy vấn (Query): SELECT, INSERT, DELETE, UPDATE
    $sql = "SELECT * FROM hangsanxuat";

    // 3. Thực thi câu truy vấn
    $result = mysqli_query($connection, $sql);

    // 4. Xử lý kết quả của câu truy vấn (SELECT)
    while($row = mysqli_fetch_array($result))
    {
        $id = $row['MaHangSanXuat'];
        $name = $row['TenHangSanXuat'];
        $xoa = $row['BiXoa'];
        if($row['BiXoa'] == 1) {
            echo'<div class="listdel">';
        } else {
            echo '<div class="list">';
        }
        echo''.$id.'. '.$name.'';
        echo '<div class="tool"><a href="/qlyHangSX/index.php?mod=update&id='.$id.'"><i class="far fa-edit"></i></a>  ';
        if($xoa == 1) {
            echo '<a href="/qlyHangSX/index.php?mod=restore&id='.$id.'"><i class="fas fa-trash-restore-alt"></i></a>';
        } else {
            echo '<a href="/qlyHangSX/index.php?mod=del&id='.$id.'"><i class="far fa-trash-alt"></i></a>';
        }
    echo '</div>';
    // Add the form and buttons here
    echo '<div class="list">';
    echo '<a href="/qlyHangSX/index.php?mod=update&id=' . $row['MaHangSanXuat'] . '"><button class="button">Sửa sản phẩm</button></a>';
    echo '<a href="/qlyHangSX/index.php?mod=del&id=' . $row['MaHangSanXuat'] . '"><button class="button1">Xóa sản phẩm</button></a>';
    echo '</div>';


    echo '</div';
}

?>