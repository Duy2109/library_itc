<div class=" my-5   ">
    <div class="login ">
        <div class="card border-0 shadow p-5">
            <h3 class=" text-center mb-4">Đăng nhập</h3>
            <form action="index.php?controller=login&action=login_action" method="post">
                <input type="text" placeholder="Tên đăng nhập" name="txtusername" class="form-control mb-4">
                <input type="password" placeholder="Mật khẩu" name="txtpassword" class="form-control mb-4">
                <button class="btn btn-primary w-100" name="login" type="submit">Đăng nhập</button>
            </form>
        </div>
    </div>
    <div></div>
</div>

<style>
    .login {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
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

    @media only screen and (max-width: 430px) {
        .login {
            width: 100% !important;
            margin: 0 auto;
        }
    }
</style>