<div class="container">
    <?php if (isset($_POST['luachon'])) : ?>
        <?php
        if ($_POST['luachon'] == 1) {
            echo "<form action='index.php?controller=thongke&action=quy' method='post'>";
            echo "<h1 >Thống kê theo quý</h1>";
        } else {
            echo "<form action='index.php?controller=thongke&action=thang' method='post'>";
            echo "<h1 >Thống kê theo tháng</h1>";
        }
        ?>
        <div class="d-flex gap-4 mt-5">
            <?php if ($_POST['luachon'] == 1) : ?>
                <div class="w-25">
                    <label for="" class="form-label">Quý</label>
                    <select class="form-select" aria-label="Default select example" name="quy">
                        <option value="1">Quý 1</option>
                        <option value="2">Quý 2</option>
                        <option value="3">Quý 3</option>
                        <option value="4">Quý 4</option>
                    </select>
                </div>
            <?php else : ?>
                <div class="w-25">
                    <label class="form-label">Tháng</label>
                    <?php
                    $month = date("m");
                    ?>
                    <select class="form-select" aria-label="Default select example" name="thang">
                        <?php
                        for ($i = 1; $i <= 12; $i++) :
                        ?>
                            <?php if ($i == $month) : ?>
                                <option value="<?php echo $i ?>" selected>Tháng <?php echo $i ?></option>
                            <?php else : ?>
                                <option value="<?php echo $i ?>">Tháng <?php echo $i ?></option>
                        <?php
                            endif;
                        endfor; ?>
                    </select>
                </div>
            <?php endif; ?>
            <div class="w-25">
                <?php
                $currentYear = date("Y");
                $yearOld = $currentYear - 10;
                $yearFur = $currentYear + 10;
                ?>
                <label for="" class="form-label">Năm</label>
                <select class="form-select" aria-label="Default select example" name="nam">
                    <?php
                    for ($i = $yearOld; $i <= $yearFur; $i++) :
                    ?>
                        <?php if ($i == $currentYear) : ?>
                            <option value="<?php echo $i ?>" selected><?php echo $i ?></option>
                        <?php else : ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php
                        endif;
                    endfor; ?>
                </select>
            </div>
            <div class="w-25">
                <label for="" class="form-label">Loại thống kê</label>
                <select class="form-select" aria-label="Default select example" name="loai">
                    <option value="danhsachmuon">Sách mượn</option>
                    <option value="danhsachmat">Sách mất</option>
                    <option value="sinhvien">Hoạt động sinh viên</option>
                </select>
            </div>
            <!-- class d-flex -->
        </div>
        <button class="btn btn-primary mt-3 ">Submit</button>
        <a class="btn btn-warning mt-3 " href="index.php?controller=thongke">Back</a>
        </form>
    <?php endif; ?>

    <div class="my-5">

    </div>
</div>