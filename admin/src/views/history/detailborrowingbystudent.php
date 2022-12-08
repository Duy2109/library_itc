<?php if (isset($result)) : ?>
    <div class="container py-5">
        <h1 class="text-center mb-5">Chi tiết mượn</h1>
        <table class="table table-bordered ">
            <thead class="table-danger">
                <tr>
                    <th>Mã sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Mã sách</th>
                    <th>Nhan đề</th>
                    <th>Mã admin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = $result->fetch()) :
                ?>
                    <tr>
                        <td><?php echo $data['masv'] ?></td>
                        <td><?php echo $data['tensv'] ?></td>
                        <td><?php echo $data['masach'] ?></td>
                        <td class="w-25"><?php echo $data['nhande'] ?></td>
                        <td><?php echo $data['maadm'] ?></td>
                        <td>
                            <a class="btn btn-primary " href="index.php?controller=history&action=returnaction&masach=<?php echo $data['masach'] ?>&mamuon=<?php echo $data["mamuon"] ?>&masv=<?php echo $data['masv'] ?>">Trả</a>
                            <?php echo "<a class='btn btn-danger ' onclick='confirmation2($data[masach],$data[masv])'>Mất</a>" ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>

        </table>
        <a href="index.php?controller=history" class="btn btn-warning float-end ">Trở lại</a>
    </div>
<?php else : ?>
    <div class="text-center alert-danger p-4 ">
        <h3 class="text-white">Không tồn tại sinh viên</h3>
    </div>
<?php endif; ?>