<div class="container my-5 d-flex align-items-center justify-content-center">
    <div class="login">
        <div class="card border-0 shadow p-5">
            <h3 class=" text-center mb-4">Đăng nhập</h3>
            <form action="index.php?controller=login&action=login_action" method="post">
                <div class="mb-4">
                    <input type="text" placeholder="Mã số sinh viên" name="txtcode" class="form-control mb-2" required>
                    <span class="text-danger"><?php echo isset($_GET['mess_code']) ? $_GET['mess_code'] : "" ?></span>
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="Mật khẩu" name="txtpassword" class="form-control mb-2" required>
                    <span class="text-danger "><?php echo isset($_GET['mess_pass']) ? $_GET['mess_pass'] : "" ?></span>
                </div>
                <div class="mb-3 text-center">
                    <a class="mb-3" href="index.php?controller=password">Quên mật khẩu ?</a>
                </div>
                <button class="btn btn-primary w-100" name="login" type="submit">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>

<style>
    .login {
        width: 30%;
        margin: 0 auto;
    }

    .login input:focus {
        box-shadow: none;
    }


    @media only screen and (max-width: 1024px) {
        .login {
            width: 40% !important;
            margin: 0 auto;
        }
    }

    @media only screen and (max-width: 768px) {
        .login {
            width: 50% !important;
            margin: 0 auto;
        }
    }

    @media only screen and (max-width: 390px) {
        .login {
            width: 100% !important;
            margin: 0 auto;
        }
    }
</style>