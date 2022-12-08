<div class="container mt-5">
    <h3 class="text-center">SÁCH ĐƯỢC BẠN YÊU THÍCH</h3>
    <table class="table table-hover mb-5">
        <thead style="background-color: #006EA7; color: #fff">
            <tr>
                <th>Mã sách</th>
                <th>Nhan đề</th>
                <th>Tác giả</th>
                <th>Ảnh bìa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $t = new BookModel();
            $res = $t->getMyLikeBook($_SESSION['user']);
            while ($set = $res->fetch()) :
            ?>
                <tr onclick="intoDetailOf(<?php echo $set['masach']; ?>)" style="cursor: pointer;">
                    <td class="col-1"><?php echo $set['masach']; ?></td>
                    <td class="col-4"><?php echo substr($set['nhande'], 0, 45) . "..."; ?></td>
                    <td class="col-3"><?php echo substr($set['tacgia'], 0, 30) . "..."; ?></td>
                    <td class="col-2"><img src="<?php echo $set['anhbia'] ?>" alt="" width="90px"></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script>
    function intoDetailOf(masach) {
        window.location.href = `index.php?controller=book&action=bookdetail&id=${masach}`;
    }
</script>