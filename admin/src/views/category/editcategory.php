<div class="container">
    <?php
    if (isset($_GET["action"])) {
        if ($_GET['action'] == "editcategory") {
            $tmpaction = 1;
        } else {
            $tmpaction = 2;
        }
    }
    ?>



    <div class="w-50 m-auto">


        <?php
        if ($tmpaction == 1) {
            echo "<h1 class='text-center mb-5'>Chỉnh sửa danh mục</h1>";
            echo "<form action='index.php?controller=category&action=edit_action' method='post'>";
        } else {
            echo "<h1 class='text-center mb-5'>Thêm danh mục</h1>";
            echo "<form action='index.php?controller=category&action=add_action' method='post'>";
        }
        ?>
        <?php
        if (isset($_GET['id'])) {
            $category = new CategoryModel();
            $result = $category->getCategoryById($_GET['id']);
            $tentheloai = $result['tentheloai'];
        }
        ?>
        <div class="my-2">
            <label class="form-label">Tên thể loại</label>
            <input class="form-control" type="text" name="tentheloai" id="tentheloai" value="<?php echo isset($tentheloai) ? $tentheloai : "" ?>">
        </div>
        <input name="idmenu" type="hidden" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ""  ?>">
        <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</div>