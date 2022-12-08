<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div>
    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'editbookform') {
            $ac = 1;
        } else {
            $ac = 2;
        }
    }

    if ($ac == 1) {
        echo '<div class="row col-md-8 col-md-offset-4" ><h3>CẬP NHẬT THÔNG TIN SÁCH</h3></div>';
    } else {
        echo '<div class="row col-md-8 col-md-offset-4" ><h3>THÊM SÁCH MỚI</h3></div>';
    }

    ?>
    <div class="row col-lg-10 col-md-offset-4">
        <?php
        if (isset($_GET['id'])) {
            $masach = $_GET['id'];
            $hh = new BookModel();
            $result = $hh->getBookID($masach);
            $masach = $result['masach'];
            $nhande = $result['nhande'];
            $tacgia = $result['tacgia'];
            $theloai = $result['theloai'];
            $bosuutap = $result['bosuutap'];
            $chuyennganh = $result['chuyennganh'];
            $anhbia = $result['anhbia'];
            $thongtinxb = $result['thongtinxb'];
            $vitri = $result['vitri'];
            $soluong = $result['soluong'];
            $gia = $result['gia'];
        }
        ?>
        <?php
        if ($ac == 1) {
            echo '
      <form action="index.php?controller=book&action=updatebook_action&id=<?php echo $masach; ?>" method="post" enctype="multipart/form-data">';
        } else {
            echo '
      <form action="index.php?controller=book&action=importbook_action" method="post" enctype="multipart/form-data">';
        }
        ?>
        <table class="table" style="border: 0px;">

            <tr>
                <td>Mã sách</td>
                <td> <input autocomplete="off" type="text" class="form-control" name="masach" readonly value="<?php if (isset($masach)) echo $masach; ?>" /></td>
            </tr>
            <tr>
                <td>Nhan đề</td>
                <td> <input autocomplete="off" type="text" class="form-control" name="nhande" value="<?php if (isset($masach)) echo $nhande; ?>" /></td>
            </tr>
            <tr>
                <td>Tác giả</td>
                <td> <input autocomplete="off" type="text" class="form-control" name="tacgia" value="<?php if (isset($masach)) echo $tacgia; ?>" /></td>
            </tr>
            <tr>
                <td>Thể loại</td>
                <td>
                    <select name="theloai" class="form-select">
                        <?php
                        $selected1 = "";
                        if (isset($theloai) && $theloai != "") {
                            $selected1 = $theloai;
                        }
                        $category = new CategoryModel();
                        $result = $category->getCategory();
                        while ($item = $result->fetch()) :
                        ?>
                            <option value="<?php echo  $item["tentheloai"] ?>" <?php if ($selected1 == $item['tentheloai']) echo "selected='selected'"; ?>><?php echo  $item["tentheloai"] ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Bộ sưu tập</td>
                <td>
                    <select name="bosuutap" class="form-select">
                        <?php
                        $selectedKhoa = "";
                        if (isset($bosuutap) && $bosuutap != "") {
                            $selectedKhoa = $bosuutap;
                        }
                        $khoa = $category->getKhoa();
                        while ($item = $khoa->fetch()) :
                        ?>
                            <option value="<?php echo  $item["tenkhoa"] ?>" <?php if ($selectedKhoa == $item['tenkhoa']) echo "selected='selected'"; ?>><?php echo  $item["tenkhoa"] ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Chuyên ngành</td>
                <td>
                    <select name="chuyennganh" class="form-select">
                        <?php
                        $selectedNganh = "";
                        if (isset($chuyennganh) && $chuyennganh != "") {
                            $selectedNganh = $chuyennganh;
                        }
                        $nganh = $category->getNganh();
                        while ($item = $nganh->fetch()) :
                        ?>
                            <option value="<?php echo  $item["tennganh"] ?>" <?php if ($selectedNganh == $item['tennganh']) echo "selected='selected'"; ?>><?php echo  $item["tennganh"] ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Ảnh bìa (link ảnh)</td>
                <td><input type="file" name="anhbia" id="anhbia" class="form-control"></td>
                <!-- <td> <input autocomplete="off" type="text" class="form-control" name="anhbia" value="<?php #if (isset($masach)) echo $anhbia; 
                                                                                                            ?>" /></td> -->
            </tr>
            <tr>
                <td>Thông tin xuất bản</td>
                <td> <input autocomplete="off" type="text" class="form-control" name="thongtinxb" value="<?php if (isset($masach)) echo $thongtinxb; ?>" /></td>
            </tr>
            <tr>
                <td>Vị trí</td>
                <td> <input autocomplete="off" type="text" class="form-control" name="vitri" value="<?php if (isset($masach)) echo $vitri; ?>" /></td>
            </tr>
            <tr>
                <td>Số lượng</td>
                <td> <input autocomplete="off" type="text" class="form-control" name="soluong" value="<?php if (isset($masach)) echo $soluong; ?>" /></td>
            </tr>
            <tr>
                <td>Giá</td>
                <td> <input autocomplete="off" type="text" class="form-control" name="gia" value="<?php if (isset($masach)) echo $gia; ?>" /></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <?php
                    if ($ac == 1) {
                        echo '<input class="btn btn-primary" type="submit" value="Cập nhật">';
                    } else {
                        echo '<input class="btn btn-success" type="submit" value="Thêm sách">';
                    }
                    ?>

                </td>
            </tr>
        </table>
    </div>
</div>