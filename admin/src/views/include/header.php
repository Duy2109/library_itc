<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-center">
                <div class="logo">
                    <a href="index.php"><img src="./src/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <?php
        if (isset($_SESSION['tenadm'])) :
        ?>
            <div class="admin-info text-center">
                <?php echo '<h6>Admin: ' . $_SESSION['tenadm'] . '</h6>'; ?>
            </div>
        <?php endif; ?>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title fs-3">Menu</li>

                <li class="sidebar-item active ">
                    <a href="index.php" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Bảng điều khiển</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Quản lí sách</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="index.php?controller=book">Tất cả sách</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="index.php?controller=book&action=importbooks">Nhập thêm sách</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  ">
                    <a href="index.php?controller=category" class='sidebar-link'>
                        <i class="bi bi-list-stars"></i>
                        <span>Các thể loại</span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub ">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-puzzle"></i>
                        <span>QL hoạt động</span>
                    </a>
                    <ul class=" submenu ">
                        <li class=" submenu-item ">
                            <a href="index.php?controller=history">Trả sách</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="index.php?controller=book&action=findstudent">Đăng kí mượn</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="index.php?controller=history&action=lated">Đã quá hạn</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item ">
                    <a href="index.php?controller=thongke" class='sidebar-link'>
                        <i class="bi bi-bar-chart-line-fill"></i>
                        <span>Thống kê</span>
                    </a>
                </li>
                <li class="sidebar-item ">
                    <a href="index.php?controller=login&action=logout" class='sidebar-link'>
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>