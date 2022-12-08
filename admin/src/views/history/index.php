<?php

if ($_GET['action'] == "getallborrowing") {
    $actiontmp = 1;
} else if ($_GET['action'] == "getall_losted") {
    $actiontmp = 2;
} else {
    $actiontmp = 3;
}

if (isset($result)) :

?>
    <div class="mb-5">

        <?php if ($actiontmp == 1) : ?>
            <h3 class="text-center mb-5">LỊCH SỬ MƯỢN </h3>
        <?php elseif ($actiontmp == 2) : ?>
            <h3 class="text-center mb-5">LỊCH SỬ BÁO MẤT </h3>
        <?php else : ?>
            <h3 class="text-center mb-5">LỊCH SỬ TRẢ </h3>

        <?php endif; ?>


        <table class="table table-bordered ">
            <thead class="table-success">
                <tr>
                    <th>Mã sinh viên</th>
                    <th>Mã sách</th>
                    <th>Nhan đề</th>

                    <?php if ($actiontmp == 1) : ?>
                        <th>Ngày mượn</th>
                        <th>Ngày trả</th>
                    <?php elseif ($actiontmp == 2) : ?>
                        <th>Ngày báo mất</th>
                        <th>Tiền đóng phạt</th>
                    <?php else : ?>
                        <th>Ngày trả</th>
                    <?php endif; ?>
                    <th>Mã admin</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $result->fetch()) :
                ?>
                    <tr>
                        <td><?php echo $item['masv'] ?></td>
                        <td><?php echo $item['masach'] ?></td>
                        <td class="w-50"><?php echo $item['nhande'] ?></td>

                        <?php if (isset($item['ngaymuon'])) : ?>
                            <td><?php echo $item['ngaymuon'] ?></td>
                        <?php endif; ?>

                        <?php if (isset($item['ngaytra'])) : ?>
                            <td><?php echo $item['ngaytra'] ?></td>
                        <?php endif; ?>


                        <?php if (isset($item['ngaybaomat'])) : ?>
                            <td><?php echo $item['ngaybaomat'] ?></td>
                        <?php endif; ?>

                        <?php if (isset($item['tienphat'])) : ?>
                            <td><?php echo $item['tienphat'] ?></td>
                        <?php endif; ?>

                        <td><?php echo $item['maadm'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <input type="button" class="btn btn-primary d-flex ms-auto" onClick="history.go(-1);" value="Trở lại">
    </div>
<?php endif; ?>