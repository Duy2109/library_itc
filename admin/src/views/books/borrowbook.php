<?php if (isset($_SESSION["masv"])) : ?>
    <h3 class="text-center">Form mượn sách</h3>

    <!-- tìm kiếm sinh viên -->
    <div class="w-50 mx-auto">
        <div class="my-2">
            <label class="form-label">Mã số sinh viên</label>
            <input class="form-control" type="text" name="mssv" id="mssv" disabled value="<?php echo $_SESSION['masv'] ?>">
        </div>
        <div class="my-2">
            <label class="form-label">Tên sinh viên</label>
            <input class="form-control" type="text" name="mssv" id="mssv" disabled value="<?php echo $_SESSION['tensv'] ?>">
        </div>
        <form method="post" action="index.php?controller=book&action=findbook">
            <div class="my-3">
                <label class="form-label">Mã sách</label>
                <input class="form-control" type="text" name="masach" id="masach" placeholder="Tìm kiếm theo mã sách">
            </div>
            <button class="btn btn-primary">Tìm kiếm sách</button>
        </form>
    </div>

    <!-- hiển thị kết quả tìm kiếm theo mã sách -->
    <?php if (count($_SESSION['books']) != 0) : ?>
        <div class="row mt-5 bg-secondary py-3 text-white fw-bold">
            <div class="col-lg-3 col-md-3 col-3 text-center">Mã sách</div>
            <div class="col-lg-3 col-md-3 col-3">Nhan đề</div>
            <div class="col-lg-3 col-md-3 col-3">Tác giả</div>
            <div class="col-lg-3 col-md-3 col-3">Ảnh bìa</div>
        </div>

        <?php foreach ($_SESSION['books'] as $key => $value) : ?>
            <div class="row my-3 d-flex  align-items-center">
                <div class="col-lg-3 col-md-3 col-3 text-center"><?php echo $value['masach'] ?></div>
                <div class="col-lg-3 col-md-3 col-3 "><?php echo $value['nhande'] ?></div>
                <div class="col-lg-3 col-md-3 col-3"><?php echo $value['tacgia'] ?></div>
                <div class="col-lg-3 col-md-3 col-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <img src="<?php echo $value['anhbia'] ?>" alt="" class="w-50">
                        </div>
                        <div>
                            <a href="index.php?controller=book&action=remove_borrowbooks&masach=<?php echo $value['masach']  ?>" class="btn btn-danger">X</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
        <div class="text-end mt-5">
            <a href="index.php?controller=book&action=borrow_action" class="btn btn-primary">Đăng kí mượn</a>
        </div>
    <?php endif; ?>
<?php else : ?>
    <div class="my-5 w-75 mx-auto  text-center ">
        <h3 class="alert-danger py-4">Không tìm thấy sinh viên theo mã số đã cung cấp</h3>
        <a class="btn btn-primary" href="index.php?controller=book&action=findstudent">Trở lại tìm kiếm sinh viên</a>
    </div>
<?php endif ?>