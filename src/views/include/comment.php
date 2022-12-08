<div class="container">
    <?php
    $comment = new CommentModel();
    $result = $comment->getComment($set['masach']);
    $resultFetchAll = $result->fetchAll()

    ?>
    <div class=" mt-5">
        <div class="col-lg-8 ">
            <h5 class="fs-6"><?php echo isset($result) && isset($_SESSION['user']) ? count($resultFetchAll) : 0; ?> bình luận</h5>
            <div class="card p-3 border-0 shadow-sm">
                <form action="index.php?controller=comment&action=add_comment" method="post">
                    <textarea name="noidungbl" id="noidungbl" class="form-control" style="resize: none;" placeholder="Viết bình luận..." required></textarea>
                    <div class="d-flex  align-items-center py-3">
                        <!-- rating -->
                        <div id="rateYo"></div>
                        <button class="btn btn-outline-dark d-flex ms-auto">Phản hồi</button>
                        <input type="hidden" name="masach" value="<?php echo $set['masach'] ?>">
                        <input type="hidden" name="rating" id="rating">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- render comment -->

    <?php

    if (isset($_SESSION['user'])) :
        if (isset($resultFetchAll)) :
            foreach ($resultFetchAll as $key => $data) :
                $reply = $comment->getAllReplyComment($data['mabl'], $set['masach']);
                $replyFetchAll = $reply->fetchAll();
    ?>
                <div class="comment w-50 mx-auto mt-5">
                    <div class="comment__container opened" id="first-comment">
                        <div class="comment__card">
                            <p class="comment__title fw-bold"><?php echo $data["tensv"] ?><span class="ms-2 text-secondary" style="font-size: 12px;"><?php echo $data["ngaybl"] ?></span> </p>
                            <p><?php echo $data['noidung'] ?></p>
                            <div class="comment__card-footer">
                                <div class="show-replies"><?php echo isset($replyFetchAll) ? count($replyFetchAll) . " phản hồi" : "" ?></div>
                            </div>
                            <div id="feedback" class="check">
                                <div class="btn btn-primary feedback__btn " style="font-size: 12px;">trả lời</div>
                                <div class="form__feedback">
                                    <form action="index.php?controller=comment&action=add_reply" method="post">
                                        <input type="text" name="noidungbl" class="form-control" autofocus required>
                                        <button type="submit" class="btn btn-info d-flex ms-auto">gửi</button>
                                        <input type="hidden" value="<?php echo $data['mabl'] ?>" name="mabl_cha">
                                        <input type="hidden" value="<?php echo $set['masach'] ?>" name="masach">
                                    </form>
                                </div>
                            </div>
                            <!-- <img src="./src/assets/images/face/2.jpg" alt="" class="rounded-circle position-absolute top-0 start-0 translate-middle  border border-light" style="width:50px;height:50px"> -->
                        </div>
                        <?php
                        foreach ($replyFetchAll as $key => $getReply) :
                        ?>
                            <div class="comment__container" dataset="first-comment" id="first-reply">
                                <div class="comment__card">
                                    <p class="comment__title fw-bold"><?php echo $getReply["tensv"] ?><span class="ms-2 text-secondary" style="font-size: 12px;"><?php echo $data["ngaybl"] ?></span> </p>
                                    <p><?php echo $getReply['noidung'] ?></p>
                                    <div class="comment__card-footer">
                                        <div class="show-replies">113 phản hồi</div>
                                    </div>
                                    <div id="feedback" class="check">
                                        <div class="btn btn-primary feedback__btn">trả lời</div>
                                        <div class="form__feedback">
                                            <form action="index.php?controller=comment&action=add_reply" method="post">
                                                <input type="text" name="noidungbl" class="form-control" autofocus required>
                                                <button type="submit" class="btn btn-info d-flex ms-auto">gửi</button>
                                                <input type="hidden" value="<?php echo $getReply['mabl'] ?>" name="mabl_cha">
                                                <input type="hidden" value="<?php echo $getReply['masach'] ?>" name="masach">
                                            </form>
                                        </div>
                                    </div>
                                    <!-- <img src="./src/assets/images/face/2.jpg" alt="" class="rounded-circle position-absolute top-0 start-0 translate-middle  border border-light" style="width:50px;height:50px"> -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
    <?php
            // endif;
            endforeach;
        endif;
    endif;
    ?>
</div>

<style>
    .form__feedback {
        display: none !important;
        transition: 2s;
    }

    .view__form {
        display: block !important;
        margin-top: 10px;
        transition: ease-in 2s;
    }

    .view__form form {
        display: flex !important;
        justify-content: space-around;
    }

    .view__form input:focus {
        box-shadow: none;
    }

    .view__form button:focus {
        box-shadow: none;
    }

    #noidungbl:focus {
        box-shadow: none;
        border: 2px solid #000;
    }

    /* view detail */
    .bookdetail_information b {
        font-weight: 900;
    }

    @media only screen and (max-width:390px) {
        .img_bookdetail {
            display: flex;
            justify-content: center;
        }

        .img_bookdetail img {
            width: 50% !important;
        }
    }
</style>


<script>
    $(function() {
        $("#rateYo").rateYo({
            starWidth: "20px",
            normalFill: "#A0A0A0",
            fullStar: true,
            rating: 5,
            onSet: function(rating, rateYoInstance) {
                $("#rating").val(rating);
            }
        });
    });


    const showContainers = document.querySelectorAll(".show-replies");

    showContainers.forEach((btn) =>
        btn.addEventListener("click", (e) => {
            // tìm gần nhất bộ chọn css  (class, id ...) nếu nhiều bộ chọn thì phân tách bởi dấu phẩy
            let parentContainer = e.target.closest(".comment__container");
            let _id = parentContainer.id;
            if (_id) {
                let childrenContainer = parentContainer.querySelectorAll(
                    `[dataset=${_id}]`
                );
                childrenContainer.forEach((child) => child.classList.toggle("opened"));
            }
        })
    );

    const showFormFeedback = document.querySelectorAll(".feedback__btn");

    showFormFeedback.forEach(btn => {
        btn.addEventListener("click", (e) => {
            var _children = e.target.closest("#feedback").children;
            _children[1].classList.toggle("view__form")
        })
    });
</script>