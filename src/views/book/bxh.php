<h1 class="text-center mt-3" id="bxh">BẢNG XẾP HẠNG</h1>
<div class=" container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#like">Yêu thích</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#read">Lượt đọc</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#rate">Điểm rating</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane container active mt-4" id="like">
            <h3 class="text-center titleofbxh">SÁCH NHIỀU LƯỢT YÊU THÍCH NHẤT</h3>
            <table class="table table-hover mb-5">
                <thead style="background-color: #006EA7; color: #fff">
                    <tr>
                        <th>Mã sách</th>
                        <th>Nhan đề</th>
                        <th>Tác giả</th>
                        <th>Ảnh bìa</th>
                        <th>Số lượt yêu thích</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $book = new BookModel();
                    $result = $book->getTop5Like();
                    while ($set = $result->fetch()) :
                    ?>
                        <tr onclick="intoDetailOf(<?php echo $set['masach']; ?>)" style="cursor: pointer;">
                            <td class="col-1"><?php echo $set['masach']; ?></td>
                            <td class="col-4"><?php echo substr($set['nhande'], 0, 45) . "..."; ?></td>
                            <td class="col-3"><?php echo substr($set['tacgia'], 0, 30) . "..."; ?></td>
                            <td class="col-2"><img src="<?php echo $set['anhbia'] ?>" alt="" width="90px"></td>
                            <td class="col-2"><?php echo $set['sl'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </div>
        <div class="tab-pane container fade mt-4" id="read">
            <!-- sách có lượng mượn nhiều nhất -->
            <h3 class="text-center titleofbxh">SÁCH NHIỀU LƯỢT ĐỌC NHIỀU NHẤT</h3>
            <table class="table table-hover mb-5">
                <thead style="background-color: #006EA7; color: #fff">
                    <tr>
                        <th>Mã sách</th>
                        <th>Nhan đề</th>
                        <th>Tác giả</th>
                        <th>Ảnh bìa</th>
                        <th>Số lượt yêu thích</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $t = new BookModel();
                    $res = $t->getTop5Read();
                    while ($set = $res->fetch()) :
                    ?>
                        <tr onclick="intoDetailOf(<?php echo $set['masach']; ?>)" style="cursor: pointer;">
                            <td class="col-1"><?php echo $set['masach']; ?></td>
                            <td class="col-4"><?php echo substr($set['nhande'], 0, 45) . "..."; ?></td>
                            <td class="col-3"><?php echo substr($set['tacgia'], 0, 30) . "..."; ?></td>
                            <td class="col-2"><img src="<?php echo $set['anhbia'] ?>" alt="" width="90px"></td>
                            <td class="col-2"><?php echo $set['sl'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane container fade mt-4" id="rate">
            <!-- sách có lượng mượn nhiều nhất -->
            <h3 class="text-center titleofbxh">SÁCH ĐIỂM ĐÁNH GIÁ CAO NHẤT</h3>
            <table class="table table-hover mb-5">
                <thead style="background-color: #006EA7; color: #fff">
                    <tr>
                        <th>Mã sách</th>
                        <th>Nhan đề</th>
                        <th>Tác giả</th>
                        <th>Ảnh bìa</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $t = new BookModel();
                    $res = $t->getTop5Read();
                    while ($set = $res->fetch()) :
                    ?>
                        <tr onclick="intoDetailOf(<?php echo $set['masach']; ?>)" style="cursor: pointer;">
                            <td class="col-1"><?php echo $set['masach']; ?></td>
                            <td class="col-4"><?php echo substr($set['nhande'], 0, 45) . "..."; ?></td>
                            <td class="col-3"><?php echo substr($set['tacgia'], 0, 30) . "..."; ?></td>
                            <td class="col-2"><img src="<?php echo $set['anhbia'] ?>" alt="" width="90px"></td>
                            <td class="col-2"><?php echo $set['sl'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function intoDetailOf(masach) {
        window.location.href = `index.php?controller=book&action=bookdetail&id=${masach}`;
    }
</script>
<style>
    #bxh,
    .titleofbxh {
        font-family: Nunito;
        color: #435EBE;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        font-weight: 500;
    }
</style>