<?php
include_once('../config.php');
if(isset($username)) exit(header('location: trang-chu'));
////////////////////////////////////////////////
include_once('../main/head.php');
?>
<body>
 <main class="main" id="top">
  <div class="container" data-layout="container">
   <div class="row flex-center min-vh-100 py-6">
    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
     <a class="d-flex flex-center mb-4">
       <img class="d-none rounded-circle mr-2" src="<?= $logo ?>" alt="" height="58"  width="58" data-pagespeed-url-hash="3750912940" onload="pagespeed.CriticalImages.checkImageForCriticality(this);" />
      <span class="text-sans-serif font-weight-extra-bold fs-5 d-inline-block"><?= $domain_name ?></span>
     </a>
     <div class="card">
     <div class="card-body p-4 p-sm-5">
       <div class="row text-left justify-content-between align-items-center mb-2">
        <div class="col-md-12 text-center mb-3"><h5>Đăng nhập tài khoản</h5></div>
       </div>
       <form id='form' class="form-horizontal" method="post" action="javascript:void();">
        <div class="form-group">
            <label style="visibility: visible; animation-duration: 1s; animation-name: fadeInLeft;"><i class="fa fa-lock"></i> Tài Khoản</label>
            <input class="form-control" type="text" id="username" name="username" value="" placeholder="Tài khoản" /></div>
        <div class="form-group">
            <label style="visibility: visible; animation-duration: 1s; animation-name: fadeInLeft;"><i class="fa fa-lock"></i> Mật Khẩu</label>
            
            <input class="form-control" type="password" id="password" name="password" value="" placeholder="Mật khẩu" /></div>
        <div class="row justify-content-between align-items-center">
         <div class="col-auto">
          <div class="custom-control custom-checkbox">
           <input class="custom-control-input" type="checkbox" id="basic-checkbox" checked="checked" name="remember" /><label class="custom-control-label" for="basic-checkbox">Ghi nhớ tài khoản.</label>
          </div>
         </div>
        </div>
        <div class="form-group"><button class="btn btn-primary btn-block mt-3" type="submit" name="submit">Đăng nhập</button></div>
       </form>
       <div class="text-center">
        <p class="fs--1 text-600 mb-0">Bạn chưa có tài khoản? <a href="dang-ky">Đăng kí</a></p>
       </div>
      </div>
     </div>
     
     </div>
    </div>
  <!--/./-->
 </div>
</main>
<script type="text/javascript">
jQuery('#form').submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url:"xuly/login.php",
        method:"POST",
        data: $(this).serialize(),
        dataType:"JSON",
    beforeSend:function(){
        $.each($("#form").find("input, button, textarea, select"), function(index, value) {
		    $(value).prop("disabled", true);
    	})
        $("#submit").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Đang kiểm tra trạng thái');
        setTimeout(1000);
    },
    complete: function () {
            $.each($("#form").find("input, button, textarea, select"), function(index, value) {
    		    $(value).prop("disabled", false);
            })
            $("#submit").prop("disabled", false).html('TIẾN HÀNH CÀI ĐẶT');
    },
    success:function(data){ 
        if(data.reload) setTimeout(() => { window.location = data.reload } , data.time)
        return Swal.fire(data.title, data.text,data.type);
    },
    error: function (data) {
        Swal.fire(data.title, data.text,data.type);
    }
   })  
})
var isFluid = JSON.parse(localStorage.getItem("isFluid"));
  if (isFluid) {
   var container = document.querySelector("[data-layout]");
   container.classList.remove("container");
   container.classList.add("container-fluid");
}
</script>
<script src="/assets/js/all.min.js"></script>
<script src="/assets/lib/fortawesome/all.min.js"></script>
<script src="/assets/main.js"></script>