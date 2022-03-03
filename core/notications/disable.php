<?php
session_start();
include_once("../../config.php");
if($trangthai != 'disabled'){
  header("Location: $WEBSITE_URL");
}
include_once("../../main/head.php");
?>
<style>
  body {
    background: -webkit-linear-gradient(left, #212529d1 0%, #212529 100%);
     color:#fff;
     padding: 10;
  }
    h2 {
        color: #fff;
        font-size: 50px;    
  }
   .container-fluid {
        margin-top:20px;
   }
</style>

      <!-- loader END -->
        <!-- Wrapper Start -->
            <div class="container-fluid p-8">
                <div class="row no-gutters">
                    <div class="col-sm-12 text-center">
                        <div class="iq-error">
                          <h1 class="text-white"></h1>
                            <h2 class="mb-0">Tài khoản đã bị vô hiệu hóa</h2>
                            <b style="font-size:14px" class="error-title-title text-white">Xin chào, <h style="color:orange"><?= $hoten ?></h><br>Chúng tôi đã áp dụng các hình phạt sau đối với tài khoản của bạn được liệt kê ở dưới</b><BR>
                            <hr style="width:35%">
                            <b style="font-size:14px" class="error-title-title text-white">Bạn đã vị phạm 1 trong số trường hợp sau: </b>
                            <p class="m-3 error-message text-white">1. Số dư <button class="btn-xs btn-success btn-round">0</button> VND quá hạn nên sẽ banned</p>
                            <p class="m-3 error-message text-white">2. Không hoạt động trong <button class="btn-xs btn-success btn-round">48H</button></p>
                            <p class="m-3 error-message text-white">3. Bạn có một số hoạt động bất thường</p>
                            <p class="m-3 error-message text-white">4. Spam Hệ Thống (Chat,Upload quá nhiều ảnh)</p>
                            <p class="m-3 error-message text-white">5. (ĐẶC BIỆT) Hành vi : BUG Hệ Thống</p>
                            <a class="btn btn-outline-success mt-3" href="<?= $WEBSITE_URL ?>/dang-xuat"><i class="ri-home-4-line"></i>Đăng Xuất</a>                            
                        </div>
                    </div>
                </div>
            </div>
      
   </body>
</html>