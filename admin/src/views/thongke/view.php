<div class="container">
    <?php
    if (isset($result)) :
        $result = $result->fetchAll();
        if (count($result) > 0) :

    ?>

            <?php
            if (isset($_POST["thang"])) {
                if (isset($_POST['loai'])) {
                    if ($_POST['loai'] == "danhsachmuon") {
                        echo "<h3 class='text-center my-5'>Top 10 sách được mượn nhiều nhất trong tháng $_POST[thang] năm $_POST[nam] là</h3>";
                    } elseif ($_POST['loai'] == "danhsachmat") {
                        echo "<h3 class='text-center my-5'>Top 10 sách đã mất trong tháng $_POST[thang] năm $_POST[nam] là</h3>";
                    } else {
                        echo "<h3 class='text-center my-5'>Top 10 sinh viên mượn sách trong tháng $_POST[thang] năm $_POST[nam] là</h3>";
                    }
                }
            } elseif (isset($_POST["quy"])) {
                if ($_POST['loai'] == "danhsachmuon") {
                    echo "<h3 class='text-center my-5'>Top 10 sách được mượn nhiều nhất trong quý $_POST[quy] năm $_POST[nam] là</h3>";
                } elseif ($_POST['loai'] == "danhsachmat") {
                    echo "<h3 class='text-center my-5'>Top 10 sách đã mất trong quý $_POST[quy] năm $_POST[nam] là</h3>";
                } else {
                    echo "<h3 class='text-center my-5'>Top 10 sinh viên mượn sách trong quý $_POST[quy] năm $_POST[nam] là</h3>";
                }
            }

            ?>
            <table class="table table-bordered ">
                <?php
                if ($_POST['loai'] == "sinhvien") :
                ?>
                    <thead class="table-danger">
                        <tr>
                            <th>Mã sinh viên</th>
                            <th>Tên sinh viên</th>
                            <th>Số sách đã mượn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $key => $value) :

                        ?>
                            <tr>
                                <td style="width:200px !important"><?php echo $value['masv'] ?></td>
                                <td><?php echo $value['tensv'] ?></td>
                                <td><?php echo $value['soluong'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php else : ?>
                    <thead class="table-danger">
                        <tr>
                            <th>Mã sách</th>
                            <th>Nhan đề</th>
                            <th>Số lượng mượn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $key => $value) :

                        ?>
                            <tr>
                                <td style="width:100px !important"><?php echo $value['masach'] ?></td>
                                <td class="w-75"><?php echo $value['nhande'] ?></td>
                                <td><?php echo $value['soluong'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>

        <?php else : ?>
            <div class="my-5">
                <h3 class="text-center p-5 alert-danger">Không tìm thấy dữ liệu</h3>
            </div>
    <?php
        endif;
    endif;
    ?>
    <input type="button" onClick="history.go(-2);" class="btn btn-primary" value="Trở về trang thống kê">
</div>