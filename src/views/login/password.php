<div class="container my-5">
    <div class="login">
        <div class="card border-0 shadow p-5">
            <h3 class=" text-center mb-4">Quên mật khẩu</h3>
            <form method="post" action="index.php?controller=password&action=password_action">
                <input type="text" placeholder="Mã số sinh viên" name="txtusername" class="form-control mb-3">
                <input type="text" placeholder="Email sinh viên" name="txtemail" class="form-control mb-3">
                <div class="mb-3 text-center">
                    <a href="index.php?controller=login">Trở lại </a>
                </div>
                <button class="btn btn-primary w-100" name="login" type="submit">Lấy lại mật khẩu</button>
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