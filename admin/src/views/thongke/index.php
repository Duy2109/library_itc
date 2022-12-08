<div class="container">
    <div class="mb-5">
        <h1 class="my-5 text-center text-capitalize">thống kê</h1>

        <div class="mb-5 w-25 mx-auto">
            <form action="index.php?controller=thongke&action=luachon" method="post">
                <label class="form-label">Thống kê theo</label>
                <select class="form-select" aria-label="Default select example" name="luachon">
                    <option value="1">Theo quý</option>
                    <option value="2">Theo tháng</option>
                </select>
                <button type="submit" class="btn btn-primary mt-3">submit</button>
            </form>
        </div>
    </div>
</div>