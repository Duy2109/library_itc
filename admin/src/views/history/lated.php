<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$history = new HistoryModel();
$result = $history->getListLated();

?>

<div class="container mt-5">
    <h3 class="my-5 text-center">TẤT CẢ SÁCH MƯỢN ĐÃ QUÁ HẠN</h3>
    <table class="table table-borderless table-hover">
        <thead class="table-primary fw-bold">
            <tr>
                <td>Mã sinh viên</td>
                <td>Tên sinh viên</td>
                <td>Sách đang mượn</td>
                <td>Ngày mượn</td>
                <td>Ngày hẹn trả</td>
                <td>Đã quá hạn</td>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($set = $result->fetch()) :
                //Kiểm tra xem có trễ hay không
                $d = (strtotime(date("Y-m-d")) - strtotime($set['ngaytra']));
                if ($d > 0) :
                    $ngaytre = floor($d / (60 * 60 * 24));
            ?>
                    <tr>
                        <td><?php echo $set['masv']; ?></td>
                        <td><?php echo $set['tensv']; ?></td>
                        <td class="w-25"><?php echo $set['nhande']; ?></td>
                        <td><?php echo $set['ngaymuon']; ?></td>
                        <td><?php echo $set['ngaytra']; ?></td>
                        <td><?php echo $ngaytre; ?></td>
                    </tr>
            <?php
                endif;
            endwhile;
            ?>
        </tbody>
    </table>
</div>