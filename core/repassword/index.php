<?php
session_start();
include_once("../../config.php");
include_once("../../main/head.php");
if($username) exit(header("Location: $domain_url"));
?>
<style type="text/css">
small {
    font-weight: 600;
    font-family: 'Poppins', sans-serif, sans-serif;
    font-size:13px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";   
}
body {
    font-weight: 600;
    font-family: 'Poppins', sans-serif, sans-serif;
    font-size:13px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";   
}
</style>
<body>
<!-- Start wrapper-->
<div class="mt-3">
<!--------- Content ------------->
<div class="clearfix"></div>
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-6">
<div class="card">
       <div class="card-header d-flex h5">Quên mật khẩu</div>
        <div class="card-body">
        <?php if(isset($_GET['confirm'])): 
        $i = tachchuoi($_GET['confirm']);
        $kiemtra =$kunloc->query("SELECT * FROM account WHERE veri_code = '$i'");
        if($kiemtra->num_rows == 1){ 
        ?>
        <form method="post" action="javascript:vold()">
        <div class="form-group">
          <label for="password" class="control-label">Mật khẩu mới:</label>
          <input type="text" class="form-control" id="newpass"/>
         </div>
         <input type="hidden" class="form-control" id="code" value="<?= $i ?>"/>
         <div class="form-group">
          <button type="submit" id="submit" class="btn btn-block btn-primary">ĐỔI MẬT KHẨU</button>
          </div>
          
        </div>
       </form>
       <script>
           $('#submit').click(function(){
               var newpass = $('#newpass').val()
               var code = $('#code').val()
               if(newpass == ''){
                 //Swal.fire("Còn thiếu gì đó!","Xui lòng kiểm tra mật khẩu?","error");
                 toarst("error","Còn thiếu gì đó!","Xui lòng kiểm tra mật khẩu?");
                 return false;
               }
               $('#submit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang Kiểm Tra...')
                $.post('core/repassword/ajax.php', {
                    type: 'REPASS',
                    code: code,
                    newpass: newpass,
                }, function(data) {
            		Data = JSON.parse(data);
            		if(Data.reload) setTimeout(() => { location.href = Data.reload }, Data.time)
                    //Swal.fire(Data.title, Data.text,Data.type);
                    toarst(Data.type,Data.text, Data.title);
                    $('#submit').prop('disabled', false).html('Đổi mật khẩu')
                })
           })
       </script>  
        <?php 
        }else{ 
          exit("<script>alert('Mã xác nhận không chính xác');setTimeout(() => { location.href = 'repassword' },100); </script>");
        }
        ?>
        
        <?php else: ?>
       <form method="post" action="javascript:vold()">
        <div class="form-group">
           <label for="email" class="control-label">Email</label>
           <input type="email" class="form-control" id="email" placeholder="Vui lòng nhập email"/>
         </div>
      
         <div class="form-group">
          <button type="submit" id="submit" class="btn btn-block btn-primary">Quên mật khẩu</button>
          </div>
         
        </div>
       </form>
       <script>
           $('#submit').click(function(){
               var email = $('#email').val()
               if(email == ''){
                 //Swal.fire("Còn thiếu gì đó!","Xui lòng kiểm tra email?","error");
                 toarst("error","Còn thiếu gì đó!","Xui lòng kiểm tra email?");
                 return false;
               } 
               $('#submit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang Kiểm Tra...')
                $.post('core/repassword/ajax.php', {
                    type: 'RECOVERY',
                    email: email,
                }, function(data) {
            		Data = JSON.parse(data);
            		if(Data.reload){
            			setTimeout(() => { location.reload() }, Data.time)
            		}
                    //Swal.fire(Data.title, Data.text,Data.type);
                    toarst(Data.type,Data.text, Data.title);
                    $('#submit').prop('disabled', false).html('Quên mật khẩu')
                })
           })
       </script>
       <?php endif; ?>
        </div>
</div>
<!-- row  -->
</div>
</div>
<!-- end  -->
<?php include_once("../../main/foot.php"); ?>
