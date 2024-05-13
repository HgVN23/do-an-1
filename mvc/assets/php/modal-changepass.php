<div id="modalChangePass" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="wrap modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Đổi mật khẩu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="formchangepass form-group mb-0">
                    <div class="row p-2">
                        <label class="col-4" for="passold">Mật khẩu cũ</label>
                        <input class="col-5 p-1" type="password" require class="passold" id="passold" value="">
                    </div>
                    <div>
                        <p class="error mb-0"></p>
                    </div>
                    <div class="row p-2">
                        <label class="col-4" for="passnew">Mật khẩu mới</label>
                        <input class="col-5 p-1" type="password" require class="passnew" id="passnew" value="">
                    </div>
                    <div>
                        <p class="error mb-0"></p>
                    </div>

                    <div class="row p-2">
                        <label class="col-4" for="passnewconfirm">Nhập lại mật khẩu mới</label>
                        <input class="col-5 p-1" type="password" require class="passnewconfirm" id="passnewconfirm" value="">
                    </div>
                    <div>
                        <p class="error mb-0"></p>
                    </div>
                    <div class="p-2 mt-2 text-right">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>