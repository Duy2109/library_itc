<?php
$result = $result->fetchAll();

if (count($result) > 0) : ?>
    <div class="container py-5">
        <h1 class="text-center mb-5">Danh sách sinh viên đang mượn sách</h1>
        <div class="w-50 ">
            <form class="d-flex mb-5" method="post" action="index.php?controller=history&action=findstudent">
                <input type="text" placeholder="Nhập mã sinh viên" autocomplete="off" class="form-control" name="textSearch">
                <button type="submit" class="btn btn-primary ">Tìm</button>
            </form>
        </div>
        <table class="table table-bordered ">
            <thead class="table-danger">
                <tr>
                    <th>Mã sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Tổng mượn</th>
                    <th>Mã admin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $key => $value) :
                ?>
                    <tr>
                        <td><?php echo $value['masv'] ?></td>
                        <td><?php echo $value['tensv'] ?></td>
                        <td><?php echo $value['tongmuon'] ?></td>
                        <td><?php echo $value['maadm'] ?></td>
                        <td>
                            <a href="index.php?controller=history&action=borrowingbookbycode&masv=<?php echo $value['masv'] ?>">xem chi tiết</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
<?php else : ?>
    <div class="text-center  ">
        <h3 class="text-white alert-danger p-4 ">Không có sinh viên đang mượn</h3>
        <a class="btn btn-primary" href="index.php?controller=history">Trở lại tìm kiếm</a>
    </div>
<?php endif; ?>