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
                          <h1 class="text-dark">500</h1>
                            <h2 class="mb-0">Trang bạn truy cập không tồn ại!</h2>
                            <p>Xin thử lại! </p>
                            <a class="btn btn-dark mt-3" href="<?= $WEBSITE_URL ?>/trang-chu"><i class="ri-home-4-line"></i>Trang chủ</a>                            
                        </div>
                    </div>
                </div>
            </div>
       
   </body>
</html>