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
        case 'INFO':
        $getname = strtolower(tachchuoi($_POST['fullname']));
        $getemail = tachchuoi($_POST['email']);
        $getphone = tachchuoi($_POST['phone']); 
        if(!$getname || !$getemail || !$getphone) JSON("Thông báo","Bạn chưa điền đầy đủ thông tin","error"); 
        $UPDATE = $kunloc->query("UPDATE account SET fullname= '$getname',email= '$getemail',phone= '$getphone' WHERE username='$username'");
        if($UPDATE) JSON("Thông báo","Đã update thành công","success");  
        else JSON("Thông báo","Đã update thất bại","error");  
        break;
    endswitch;
exit();
endif;
?> 
<div class="row">
<!-- card 1 -->
<div class="col-lg-4">
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
                <h5>Cấp độ: <b><?= $level_type ?></b></h5> 
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
<div class="col-lg-8">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title">Thông Tin Tài Khoản</h4></div>
         </div>
         <form id="form" action="javascript:void(0)" method="post" >
            <div class="card-body">
               <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label">Họ và Tên</label>
                <div class="col-sm-10">
                <input type="text" name="fullname" id="fullname" class="custom-select form-control-rounded" value="<?= $fullname ?>" placeholder="Nhập họ tên mới..." required/>
                </div>
              </div>
               <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label">Tên người dùng</label>
                <div class="col-sm-10">
                <input type="text" readonly class="custom-select form-control-rounded" value="<?= $username ?>" required/>
                </div>
              </div>
               <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label">Token</label>
                <div class="col-sm-10">
                <input type="text" readonly class="custom-select form-control-rounded" value="<?= $accessToken ?>" required/>
                <small class='text-danger'> (Không được chia sẻ với ai)</small>    
                </div>
              </div>
              <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label">Số Dư</label>
                <div class="col-sm-10">
                <input type="text" readonly class="custom-select form-control-rounded" value="<?= format_cash($vnd) ?> (VNĐ)" required/>
                </div>
              </div>
              <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label">Số Điện Thoại</label>
                <div class="col-sm-10">
                <input type="tel" name="phone" id="phone" class="custom-select form-control-rounded" value="<?= $phone ?>" placeholder="Nhập số điện thoạt mới..."required/>
                </div>
              </div>
              <!-- /./ -->
               <div class="form-group row">
                <label for="input-26" class="col-sm-2 col-form-label">Email Liên Hệ</label>
                <div class="col-sm-10">
                <input type="email" name="email" id="email" class="custom-select form-control-rounded" value="<?= $email ?>" placeholder="Nhập gmail mới..."required/>
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
                url: WEBSITE_URL + "system/thay-doi-thong-tin.php",
                dataType: "JSON",
                data: "case=INFO&" + $(this).serialize(),
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
<!-- panel 2 -->
<div class="col-lg-12 d-none">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title">LỊCH SỬ ĐĂNG NHẬP</h4></div>
         </div>
         <div class="card-body">
         <div class="table-responsive">
         <table id="table" class="table table-striped nowrap scroll-horizontal-vertical">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Lần đăng nhập gần nhất</th>
                     <th>Địa chỉ IP</th>
                     <th>Thời gian</th>
                  </tr>
                <tbody>
                <?php
                     if($username == $admin) $SQL = $kunloc->query("SELECT * FROM lich_su_dang_nhap ORDER BY id DESC");
                     else $SQL = $kunloc->query("SELECT * FROM lich_su_dang_nhap WHERE username = '$username' ORDER BY id DESC");
                     while ($kunloc = $SQL->fetch_object()):
                     ?>
                  <tr>
                     <td><?= $i++ ?></td>
                     <td>Bạn đã truy cập vào ngày: <b data-toggle="tooltip" title="Ngày đăng nhập" style="color:blue"><?= $kunloc->time; ?></b></td>
                     <td><b data-toggle="tooltip" title="Địa chỉ IP" style="color:red"><?= $kunloc->ip; ?></b></td>
                     <td>DATE: <b data-toggle="tooltip" title="Thời gian" style="color:green"><?= $kunloc->time; ?></b></td>
                  </tr>
                  <?php endwhile; ?>
                  </tbody>
               </thead>
            </table>
            </div>
     </div>
   </div>
</div>
<script>jQuery(document).ready(function() { Tables('table',10,'desc') })</script>
</div>