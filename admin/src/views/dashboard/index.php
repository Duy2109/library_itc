<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="page-heading">
    <h5>Thống kê sơ lược</h5>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Profile Views</h6>
                                    <h6 class="font-extrabold mb-0">112.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Followers</h6>
                                    <h6 class="font-extrabold mb-0">183.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Following</h6>
                                    <h6 class="font-extrabold mb-0">80.000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Saved Post</h6>
                                    <h6 class="font-extrabold mb-0">112</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="my-5">
    <div class="mb-5">
        <h5>LỊCH SỬ MƯỢN </h5>

        <table class="table table-bordered ">
            <thead class="table-success">
                <tr>
                    <th>Mã sinh viên</th>
                    <th>Mã sách</th>
                    <th>Nhan đề</th>
                    <th>Ngày mượn</th>
                    <th>Hẹn trả</th>
                    <th>Mã Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $BookModel = new HistoryModel();
                $month = date('m');
                $result = $BookModel->getBorrowList();

                while ($item = $result->fetch()) :
                ?>
                    <tr>
                        <td><?php echo $item['masv'] ?></td>
                        <td><?php echo $item['masach'] ?></td>
                        <td class="w-50"><?php echo $item['nhande'] ?></td>
                        <td><?php echo $item['ngaymuon'] ?></td>
                        <td><?php echo $item['ngaytra'] ?></td>
                        <td><?php echo $item['maadm'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6 " class="text-end"><a href="index.php?controller=history&action=getallborrowing">Xem chi tiết</a></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mb-5">
        <h5>LỊCH SỬ TRẢ </h5>
        <table class="table table-bordered ">
            <thead class="table-danger">
                <tr>
                    <th>Mã sinh viên</th>
                    <th>Mã sách</th>
                    <th>Nhan đề</th>
                    <th>Mã admin</th>
                    <th>Ngày trả</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $BookModel->getReturnList();
                while ($item = $result->fetch()) :
                ?>
                    <tr>
                        <td><?php echo $item['masv'] ?></td>
                        <td><?php echo $item['masach'] ?></td>
                        <td class="w-50"><?php echo $item['nhande'] ?></td>
                        <td><?php echo $item['maadm'] ?></td>
                        <td><?php echo $item['ngaytra'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6 " class="text-end"><a href="index.php?controller=history&action=getallreturn">Xem chi tiết</a></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mb-5">
        <h5>LỊCH SỬ BÁO MẤT GẦN NHẤT</h5>
        <table class="table table-bordered ">
            <thead class="table-secondary">
                <tr>
                    <th>Mã sách</th>
                    <th>Nhan đề</th>
                    <th>Mã sinh viên</th>
                    <th>Ngày báo mất</th>
                    <th>Tiền đóng phạt</th>
                    <th>Mã Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $BookModel->getLoseBook();
                while ($item = $result->fetch()) :
                ?>
                    <tr>
                        <td><?php echo $item['masach'] ?></td>
                        <td class="w-50"><?php echo $item['nhande'] ?></td>
                        <td><?php echo $item['masv'] ?></td>
                        <td><?php echo $item['ngaybaomat'] ?></td>
                        <td><?php echo $item['tienphat'] ?></td>
                        <td><?php echo $item['maadm'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" class="text-end"><a href="index.php?controller=history&action=getall_losted">Xem chi tiết</a></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- con footer phía dưới bên trong -->