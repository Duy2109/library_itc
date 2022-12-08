<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// kết quả tìm kiếm

?>


<div class="container mt-5" style="overflow-x: auto;font-size:13px;">

    <?php
    if (isset($result)) {
        echo "<h3 class='text-uppercase my-5 text-center'>kết quả</h3>";
    } else {
        echo "<h3 class='text-uppercase my-5 text-center'>tất cả sách trong thư viện</h3>";
    }
    ?>

    <!-- tìm kiếm -->
    <div class=" w-50 mx-auto">
        <form action="index.php?controller=book&action=search" class="d-flex" method="post">
            <input type="text" class="form-control" placeholder="Tựa đề tìm kiếm ..." name="text_search" required value="<?php echo isset($_POST['text_search']) ? $_POST['text_search'] : "" ?>" autocomplete="off">
            <button type="submit" class="btn btn-primary">Tìm</button>
        </form>
    </div>

    <!-- bộ lọc -->
    <div class="mb-5 ms-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filter">Bộ lọc</button>
        <div id="filter" class="collapse mt-5">
            <div class="d-flex justify-content-between ">
                <!-- tác giả  -->
                <div class="" id="tacgia">
                    <h4 class="mb-3">Thể loại</h4>
                    <?php
                    $category = new CategoryModel();
                    $listCategory = $category->getCategory();
                    while ($dataCategory = $listCategory->fetch()) :
                    ?>
                        <p><u><a href="index.php?controller=book&action=theloai&name_category=<?php echo $dataCategory['tentheloai']  ?>" class="text-capitalize text-dark"><?php echo $dataCategory['tentheloai'] ?></a></u></p>
                    <?php endwhile; ?>
                </div>

                <!-- thể loại -->
                <div class="" id="theloai">
                    <h4 class="mb-3">Tác giả</h4>
                    <?php
                    $book = new BookModel();
                    $listAuthor = $book->getAllAuthorBook();
                    while ($dataAuthor = $listAuthor->fetch()) :
                    ?>
                        <p><u><a href="index.php?controller=book&action=tacgia&name_author=<?php echo $dataAuthor['tacgia']  ?>" class="text-dark"><?php echo $dataAuthor['tacgia'] ?></a></u></p>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($result)) : ?>

        <table class="table table-borderless table-hover">
            <thead class="table-success fw-bold">
                <tr>
                    <td>Mã sách</td>
                    <td>Nhan đề</td>
                    <td>Tác giả</td>
                    <td>Thể loại</td>
                    <td>Bộ sưu tập</td>
                    <td>Chuyên ngành</td>
                    <td>Ảnh bìa</td>
                    <td>NXB</td>
                    <td>Vị trí</td>
                    <td>Số lượng</td>
                    <td>Giá tiền</td>
                    <td colspan="2"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($dataFilter = $result->fetch()) :
                ?>
                    <tr>
                        <td><?php echo $dataFilter['masach']; ?></td>
                        <td style="width:20%;"><?php echo $dataFilter['nhande']; ?></td>
                        <td><?php echo $dataFilter['tacgia']; ?></td>
                        <td><?php echo $dataFilter['theloai']; ?></td>
                        <td><?php echo $dataFilter['bosuutap']; ?></td>
                        <td><?php echo $dataFilter['chuyennganh']; ?></td>
                        <td><img src="<?php echo $dataFilter['anhbia']; ?>" alt="" class="w-75"></td>
                        <td><?php echo $dataFilter['thongtinxb']; ?></td>
                        <td><?php echo $dataFilter['vitri']; ?></td>
                        <td><?php echo $dataFilter['soluong']; ?></td>
                        <td><?php echo $dataFilter['gia']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="11" class="text-end"><a class="btn btn-warning" href="index.php?controller=book">Trở lại</a></td>
                </tr>
            </tfoot>
        </table>

    <?php else : ?>
        <table class="table table-borderless table-hover">
            <thead class="table-success fw-bold">
                <tr>
                    <td>Mã sách</td>
                    <td>Nhan đề</td>
                    <td>Tác giả</td>
                    <td>Thể loại</td>
                    <td>Bộ sưu tập</td>
                    <td>Chuyên ngành</td>
                    <td>Ảnh bìa</td>
                    <td>NXB</td>
                    <td>Vị trí</td>
                    <td>Số lượng</td>
                    <td>Giá tiền</td>
                    <td colspan="2"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $book = new BookModel();
                $allBook = $book->getAllBook();
                $countBook = count($allBook->fetchAll());

                $limit = 10;
                $page = ($countBook % $limit == 0) ? $countBook / $limit : ceil($countBook / $limit);
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                if (isset($_GET['page'])) {
                    $start = ($currentPage - 1) * $limit;
                } else {
                    $start = 0;
                    $_GET['page'] = 1;
                }

                $data = $book->getAllBookLimit($start, $limit);


                while ($set = $data->fetch()) :
                ?>
                    <tr>
                        <td><?php echo $set['masach']; ?></td>
                        <td style="width:20%;"><?php echo $set['nhande']; ?></td>
                        <td><?php echo $set['tacgia']; ?></td>
                        <td><?php echo $set['theloai']; ?></td>
                        <td><?php echo $set['bosuutap']; ?></td>
                        <td><?php echo $set['chuyennganh']; ?></td>
                        <td><img src="<?php echo $set['anhbia']; ?>" alt="" class="w-75"></td>
                        <td><?php echo $set['thongtinxb']; ?></td>
                        <td><?php echo $set['vitri']; ?></td>
                        <td><?php echo $set['soluong']; ?></td>
                        <td><?php echo $set['gia']; ?></td>
                        <td style="width:5px">
                            <a class="btn btn-primary p-1  d-flex align-items-center" href="index.php?controller=book&action=editbookform&id=<?php echo $set['masach']; ?>"><i class="bi bi-pencil fs-6 w-100"></i></a>
                        </td>
                        <!-- <td><a href="#"> <button class="btn btn-danger">Xoa</button> </a></td> -->
                        <?php echo "<td><a class='btn btn-danger p-1 d-flex align-items-center' onclick=confirmation('book','deletebook',$set[masach])><i class='bi bi-x'></i></a></td>" ?>
                    </tr>
                <?php
                endwhile;
                ?>
            </tbody>
        </table>


        <div class="d-flex justify-content-center mt-5">
            <ul class="pagination">
                <?php if ($currentPage > 1 || $_GET['page'] > 1) : ?>
                    <li class="page-item "><a class="page-link" href="index.php?controller=book&page=<?php echo ($currentPage - 1) ?>">Trước</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $page; $i++) : ?>
                    <li class="page-item <?php echo ($i == $_GET['page']) ? 'active' : '' ?>"><a class="page-link " href="index.php?controller=book&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endfor; ?>

                <?php if ($currentPage < $page && $page > 1) : ?>
                    <li class="page-item"><a class="page-link" href="index.php?controller=book&page=<?php echo ($currentPage + 1) ?>">Tiếp</a></li>
                <?php endif ?>
            </ul>
        </div>
    <?php endif ?>
</div>