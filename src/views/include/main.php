<!-- category -->
<div class="banner text-white">
    <div class="d-flex align-items-center justify-content-center" style="height: 450px;">
        <div>
            <h1 id="title_search" class="mb-4">Tìm kiếm sách trong thư viện</h1>
            <div class="d-flex justify-content-center align-items-center ">
                <form action="index.php?controller=book&action=onsearch" method="post" class="d-flex align-items-center w-100 bg-white  px-3 rounded  form-search">
                    <div class="py-2 w-50  border-end">
                        <select class="form-select border-0 border-end-2 w-100 " aria-label="Default select example" name="column_search">
                            <option value="nhande">Nhan đề sách</option>
                            <option value="tacgia">Tác giả</option>
                            <option value="theloai">Thể loại</option>
                        </select>
                    </div>
                    <input type="text" name="txtSearch" id="txtSearch" class=" form-control  border-0" placeholder="Bạn cần tìm..." required autofocus>
                    <button type="submit" class="btn btn-primary " style="background-color: #2075ba;"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="row category">
            <div class="col-lg-4 col-md-4">
                <div class="card border-0">
                    <div class="card-body ">
                        <img src="https://kenh14cdn.com/2018/9/26/hoatran-img8121-15379796122961009481384.jpg" alt="" class="w-100">
                    </div>
                    <div class="card-footer border-0 bg-white">
                        <h5>Hello world</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, quia.</p>
                        <button class="btn btn-primary">Learn more</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card border-0">
                    <div class="card-body ">
                        <img src="https://cafebiz.cafebizcdn.vn/2018/10/16/photo-1-15396557382171854642345.jpg" alt="" class="w-100">
                    </div>
                    <div class="card-footer border-0 bg-white">
                        <h5>Hello world</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, quia.</p>
                        <button class="btn btn-primary">Learn more</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="card border-0">
                    <div class="card-body ">
                        <img src="https://kenh14cdn.com/2018/9/26/hoatran-img8133-15379796123061389683964.jpg" alt="" class="w-100">
                    </div>
                    <div class="card-footer border-0 bg-white">
                        <h5>Hello world</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, quia.</p>
                        <button class="btn btn-primary">Learn more</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-5">
            <h3 class="text-center "><a href="" style="font-weight: 900;">7 đầu sách mới nhất</a></h3>
            <div class="slider my-5">
                <?php
                $book = new BookModel();
                $result  = $book->getNewBook();
                while ($data = $result->fetch()) :
                ?>
                    <div class="card border-0">
                        <div class="card-body">
                            <a href="index.php?controller=book&action=bookdetail&id=<?php echo $data['masach'] ?>">
                                <img class="w-100" src="<?php echo $data["anhbia"] ?>" alt="">
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="my-5">
    <div class="py-5" style="background: linear-gradient(206.57deg, #0083bf 0%, #00548B 100%);">
        <div class="container text-white">
            <h1 class="text-center mb-5">How to use</h1>
            <div class="row w-100 m-0">
                <div class="col-lg-6 col-md-6 mb-5">
                    <div class="card p-3 bg-secondary rounded border-0" style="background: linear-gradient(206.57deg, #0083bf 0%, #00548B 100%);">
                        <div class="cart-body border-0  ">
                            <h3>Welcome</h3>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid fugiat earum praesentium non officia in sunt quisquam ea at officiis, odit, iure iste voluptatem tenetur veniam obcaecati! Eligendi hic sit saepe voluptatibus? Ullam beatae delectus accusantium minima natus. Accusamus rem voluptas voluptates neque tempora. Magni laborum vel fugit beatae consectetur?</p>
                            <a href="" class="text-white">Learn more</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card p-3 bg-secondary rounded border-0" style="background: linear-gradient(206.57deg, #0083bf 0%, #00548B 100%);">
                        <div class="cart-body border-0  ">
                            <h3>Welcome</h3>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid fugiat earum praesentium non officia in sunt quisquam ea at officiis, odit, iure iste voluptatem tenetur veniam obcaecati! Eligendi hic sit saepe voluptatibus? Ullam beatae delectus accusantium minima natus. Accusamus rem voluptas voluptates neque tempora. Magni laborum vel fugit beatae consectetur?</p>
                            <a href="" class="text-white">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="my-5 bg-light ">
    <div class="container py-5 ">
        <h3 class="text-center mb-5">Explore resources in libraries worldwide</h3>
        <div class="row ">
            <div class="col-lg-4 col-md-6 mb-5 mb-3  px-2 py-3 ">
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <i class="fa fa-book fa-4x" style="color: #1472bc"></i>
                    <div>
                        <p class="mb-0 fw-bold ">
                            <a href=" index.php?controller=book&action=filtercategory3">Sách Tham Khảo</a>
                        </p>
                        <p class="fs-3 fw-bold mb-0">405 million</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-3  px-2 py-3 ">
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <i class="fa fa-leanpub fa-4x" style="color: #1472bc"></i>
                    <div>
                        <p class="mb-0 fw-bold ">
                            <a href="index.php?controller=book&action=filtercategory4">Đồ án TN ĐH-CĐ</a>
                        </p>
                        <p class="fs-3 fw-bold mb-0">405 million</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-3  px-2 py-3 ">
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <i class="fa fa-pencil-square-o fa-4x" style="color: #1472bc"></i>
                    <div>
                        <p class="mb-0 fw-bold ">
                            <a href=" index.php?controller=book&action=filtercategory3">Sách Giáo Trình</a>
                        </p>
                        <p class="fs-3 fw-bold mb-0">405 million</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-3  px-2 py-3 ">
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <i class="fa fa-newspaper-o fa-4x" style="color: #1472bc"></i>
                    <div>
                        <p class="mb-0 fw-bold ">
                            <a href=" index.php?controller=book&action=filtercategory3">Báo Tạp Chí</a>
                        </p>
                        <p class="fs-3 fw-bold mb-0">405 million</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-3  px-2 py-3 ">
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <i class="fa fa-microchip fa-4x" style="color: #1472bc"></i>
                    <div>
                        <p class="mb-0 fw-bold ">
                            <a href="index.php?controller=book&action=filtercategory1" class="text-capitalize">CNTT-DT</a>
                        </p>
                        <p class="fs-3 fw-bold mb-0">405 million</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-3  px-2 py-3 ">
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <i class="fa fa-square-poll-vertical fa-4x" style="color: #1472bc"></i>
                    <div>
                        <p class="mb-0 fw-bold ">
                            <a href="index.php?controller=book&action=filtercategory2" class="text-capitalize">Kinh tế</a>
                        </p>
                        <p class="fs-3 fw-bold mb-0">405 million</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<style>
    /* slider */
    .slider img {
        height: 250px !important;
    }

    .slick-list {
        padding-bottom: 50px;
    }

    .slick-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        border: 0px;
        color: #0c4470;
        padding: 5px 20px;
        font-size: 25px;
    }

    .slick-arrow:hover {
        background-color: #0c4470;
        color: #fff;
        transition: 0.5s;
    }

    .slick-next {
        right: 0;
    }

    .slick-prev {
        left: 0;
    }

    .slick-dots {
        position: absolute;
        left: 50%;
        bottom: 0;
        padding: 0;
        transform: translate(-50%, 0);
        list-style: none;
        display: flex !important;
        justify-items: center;
        justify-content: center;
        gap: 0 10px;
    }

    .slick-dots button {
        font-size: 0px;
        border: none;
        width: 15px;
        height: 15px;
        border-radius: 100rem;
        background-color: #eee;
        transition: all 0.2s linear;
    }

    .slick-dots .slick-active button {
        background-color: #105083;
    }

    /* form search */
    #txtSearch:focus {
        box-shadow: none !important;
    }

    .form-search div select:focus {
        box-shadow: none !important;
        border-right: 3px solid #144f7d !important;
        border-radius: 0;
    }

    /* responsive */
    @media only screen and (max-width: 390px) {
        #title_search {
            font-size: 15px !important;
            text-align: center;
        }

        .form-search {
            font-size: 10px !important;
            margin: 0 5px !important;
        }

        .form-search input::placeholder {
            font-size: 12px !important;
        }

        .form-search button {
            font-size: 12px;
        }

        .slider img {
            height: 320px !important;
        }
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $(".slider").slick({
            infinite: true,
            slidesToShow: 6,
            slidesToScroll: 1,
            prevArrow: "<button type='button' class='slick-prev slick-arrow'><i class='fa-solid fa-circle-left ' aria-hidden='true'></i></i></button>",
            nextArrow: "<button type='button' class='slick-next slick-arrow'><i class='fa-solid fa-circle-right ' aria-hidden='true'></i></button>",
            dots: true,
            responsive: [{
                    breakpoint: 1026,
                    settings: {
                        slidesToShow: 4,
                    },
                },
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 3,
                        infinite: false
                    },
                },
                {
                    breakpoint: 390,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        infinite: false
                    },
                },
            ],
        });
    });
</script>