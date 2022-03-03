<?php 
session_start();
include("../config.php");
if($_GET)$_POST=$_GET;
if($_POST && isset($_POST['case'])):
    switch($_POST['case']):
        case 'UP':
        $i = addslashes($_POST['image']);
        if(!$i) JSON("Thông báo","Bạn chưa tải ảnh lên","error");
         $UPDATE = $kunloc->query("UPDATE `account` SET `avatar` = '$i' WHERE username ='$username' ");
        if($UPDATE) JSON("Thông báo","Đã update thành công","success");  
        else JSON("Thông báo","Đã update thất bại","error");
        break;
        case 'PASS':
        $password_old = md5(tachchuoi($_POST['passcu']));
        $password_new = md5(tachchuoi($_POST['passmoi']));
        if(!$password_old || !$password_new) JSON("Thông báo","Bạn chưa nhập mật khẩu","error");
        $kiemtra = $kunloc->query("SELECT * FROM account WHERE username ='$username' AND password = '$password_old'");
        $info = $kiemtra->fetch_object();
        if($kiemtra->num_rows != 1) JSON("Thông báo","Sai mật khẩu cũ rồi","error");
        else if($password_new == $password_old || $info->password == $password_new) JSON("Thông báo","2 Mật khẩu phải khác nhau","error");
        else{
          $UPDATE = $kunloc->query("UPDATE account SET password= '$password_new' WHERE username='$username'");
          if($UPDATE) JSON("Thông báo","Đã update thành công","success");  
          else JSON("Thông báo","Đã update thất bại","error");  
        }
        break;
    endswitch;
exit();
endif;
?> 
<div class="row">
<!-- card 1 -->
<div class="col-lg-5 col-md-12">
    <div class="card">
        <div class="card-body pl-0 pr-0 pt-0">
             <div class="doctor-details-block">
             <div class="doc-profile-bg" style="background-image:url(<?= $background ?>);background-position:center;background-repeat:no-repeat;background-size:cover;height:150px;"></div>
             <div class="doctor-profile text-center" style="margin-top:-60px">
                 <img src="<?= $image ? $image : $logo; ?>" style="border:solid 3px #fff;border-radius:100px;width:120px;height:120px" class="img-fluid">
             <form id="upload-anh" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
               <div class="col-13 m-2">
                    <div class="custom-file">
                       <input type="file" name="image" id="image" class="custom-file-input">
                       <label class="custom-file-label" for="inputGroupFile04">Đổi ảnh đại diện</label>
                    </div>
                </div>
             </form>
             <script>
              $("#image").change(function () {
              var form = $("#upload-anh")[0];
              var formData = new FormData(form);
              var get_image = $("#image").val();
              if (get_image.length !== "") {
                $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="token"]').attr("value") } });
                $.ajax({
                  url: WEBSITE_URL + "API/api_image.php",
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: "POST",
                  success: function (data) {
                    Data = JSON.parse(data);
                    if (Data.type == "success") {
                      let update = Data.url;
                       $.post(WEBSITE_URL + 'system/thay-doi-thong-tin.php', { case:'UP', image:update},function(result){
                         Datax = JSON.parse(result)
                         if (Datax.type == "success") setTimeout(() =>{ location.reload() },1000)
                         return toarst(Datax.type,Datax.text,Datax.title)
                      })  
                    }
                    return toarst(Data.type,Data.text,Data.title);
                  },
                });
              } else  return toastr.warning("Bạn chưa tải ảnh lên");
            })
            </script> 
            </div>
            <div class="text-center mt-3 pl-3 pr-3">
                <h5 class="mt-2 card-title text-center">Xin chào, <font color="red"><?= $fullname ?> </font></h5>
                <p class="card-text text-center">
                <h5>Cấp độ: <b><?= $level_type?></b></h5> 
                <h6>Chiết khấu: <b><?= $chietkhau; ?></b>%</h6>
                </p>
            </div>
            <hr>
            <div class="table-responsive">
            <ul class="list-group list-group-flush list shadow-none">
                <li class="list-group-item d-flex justify-content-between align-items-center"><span class="badge badge-default">Cập Nhật Profile:</span><span class="badge badge-submit"><a href="thay-doi-thong-tin">Click vào đây...</a></span></li>
                <li class="list-group-item d-flex justify-content-between align-items-center"><span class="badge badge-secondary">Đổi Pass:</span><span class="badge badge-submit"><a href="thay-doi-mat-khau">Click vào đây...</a></span></li>   
                <li class="list-group-item d-flex justify-content-between align-items-center"><span class="badge badge-success">ID Profile - User:</span><span class="badge badge-warning"><?= $username ?>  </span></li>
                <li class="list-group-item d-flex justify-content-between align-items-center"><span class="badge badge-primary">Kích Hoạt:</span><span class="badge badge-danger">
                <?= $kichhoat_type ?>  
              </span></li>
            </ul>
            </div>
</div>
</div>
</div>   
</div>

<!-- card 1 -->
<div class="col-lg-7 col-md-12">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title">Thông Tin Tài Khoản</h4></div>
         </div>
       <form id="form" action="javascript:void(0)" method="POST">
        <div class="card-body">
             <!-- /./ 
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label">Họ và Tên</label>
                <div class="col-sm-10">
                <input type="text" class="custom-select form-control-rounded" style="color:#333" value="<?= $fullname ?>" placeholder="Nhập họ tên mới..." />
                </div>
              </div>
                <!-- /./ --
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label">Tên Người Dùng</label>
                <div class="col-sm-10">
                <input type="text" readonly class="custom-select form-control-rounded " style="color:#333" value="<?= $username ?>" />
                </div>
              </div>
                <!-- /./ --
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label">Số Dư</label>
                <div class="col-sm-10">
                <input type="text" readonly class="custom-select form-control-rounded" style="color:#333" value="<?= $vnd ?> (VND)" />
                </div>
              </div>-->
               <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label"> Mật Khẩu Cũ</label>
                <div class="col-sm-10">
                <input type="password" name="passcu" id="passcu" class="custom-select form-control-rounded" style="color:#333" placeholder="Nhập mật khẩu cũ..."/>
                </div>
              </div>
               <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label">Mật Khẩu Mới</label>
                <div class="col-sm-10">
                <input type="password" name="passmoi" id="passmoi" class="custom-select form-control-rounded" style="color:#333" placeholder="Nhập mật khẩu mới..." />
                </div>
              </div>
              <!-- /./ -->
              <div class="irow row mt-4">
                <div class="form-group col-sm-12 select">
                    <button type="submit" name="submit" id="submit" class="btn btn-block btn-primary btn-round"><i class="icon-lock"></i> Cập Nhật Tài Khoản</button>
                    </div>
              </div>
          </form>
          <script>
           jQuery("#form").submit(function(event){
            $.ajax({
                method: "POST",
                url: WEBSITE_URL + "system/thay-doi-mat-khau.php",
                dataType: "JSON",
                data: "case=PASS&" + $(this).serialize(),
                beforeSend: function(){
                  Disabled('form',true)
                  $("#submit").prop('disabled', true).html('Waiting');
                },
                complete: function(){
                  Disabled('form',false) 
                  $("#submit").prop('disabled', false).html('SUBMIT');
                },
                success:function(data){
                  if(data.type == "success") setTimeout(() => { location.reload() })
                  return toarst(data.type,data.text,data.title)
                },
                error:function(){
                  return toarst('error','Thông báo','Có sự cố. không thể truy vấn!');
                }
            })
          })
          </script>
     </div>
</div>
</div>