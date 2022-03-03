<?php
    require_once("../../config.php");
    if($level != 'admin') exit(header("Location: $domain_url"));
    if($_GET) $_POST= $_GET;
    if(isset($_POST['type']) == 'UPDATE' && isset($_POST['id'])){
        if(!isset($_POST['VND']) || !isset($_POST['chietkhau'])) JSON("Yêu cầu thông tin","Bạn chưa điền đầy đủ thông tin","info");
        ////////////////////////////////////////////////////
        $i = intval($_POST['id']);
        $sodu = isset($_POST['VND']) ? $_POST['VND'] : 0;
        $capbac = tachchuoi($_POST['level']);
        if($capbac == 'admin'){
          $sochietkhau = $CHIETKHAU['admin']; 
        }else if($capbac == 'ctv'){
          $sochietkhau = $CHIETKHAU['ctv']; 
        }else if($capbac == 'daily'){
          $sochietkhau = $CHIETKHAU['daily']; 
        }else{
          $capbac = 'member';
          $sochietkhau = isset($_POST['chietkhau']) ? $_POST['chietkhau'] : 0;
        }
        $kiemtra =  $kunloc->query("SELECT * FROM `account` WHERE `id` = '$i'");
        if($kiemtra->num_rows == 1){
            $data = $kiemtra->fetch_object();
            $UP = $kunloc->query(" UPDATE `account` SET `VND` ='$sodu',`chietkhau`='$sochietkhau',`level`='$capbac' WHERE `id` = '$i' ");
        if($UP){
            $noidung = "".$data->username." vừa được cộng: ".format_cash($sodu)."đ vào tài khoản.";
            Thongbao($data->username,$noidung);
            NhatkyVnd($data->username,$noidung,$data->VND,$sodu,$sodu);
            NhatkyHd($data->username,$noidung,'','',$sodu,'ADD');
            JSON("Update thành công","Chờ reload", "success","exit","true");
         }else JSON("Update thất bại","Xin hãy thử lại","error");

        }else JSON("User không tồn tại","Xin hãy thử lại","error");           
    }
    if(!isset($_POST['edit'])):
      exit();
    else: if(isset($_POST['edit'])):
    $id = $kunloc->real_escape_string($_POST['edit']);
    $account = $kunloc->query("SELECT * FROM `account` WHERE id = '$id'");
    if($account->num_rows != 1): ?>
    <center><b style="color:red">Bạn không có quyền sửa mục này. Vui lòng liên hệ <a href="https://facebook.com/<?= $facebook ?>">Admin</a></b></center>
    <?php else: while($echo = $account->fetch_object()): ?>
      <form id="update-member" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
     <input type="hidden" name="id" id="id" class="form-control" value="<?= $echo->id ?>"/>
     <div class="row">
         <div class="col-sm-6">
           <div class="form-group">
            <label>Username</label>
            <input type="text" disabled class="form-control" value="<?= $echo->username;?>"/>
          </div>
         </div> 
         <div class="col-sm-6">
           <div class="form-group">
            <label>Fulname</label>
            <input type="text" disabled class="form-control" value="<?= $echo->fullname;?>"/>
          </div>
         </div>
     </div>
     <!--/./-->
     <div class="row">
         <div class="col-sm-6">
           <div class="form-group">
            <label>Email</label>
            <input type="text" disabled class="form-control" value="<?= $echo->email;?>"/>
          </div>
         </div> 
         <div class="col-sm-6">
           <div class="form-group">
            <label>Phone</label>
            <input type="text" disabled class="form-control" value="<?= $echo->phone;?>"/>
          </div>
         </div>
     </div>
      <!-- /./ -->
     <div class="row">
         <div class="col-sm-6">
           <div class="form-group">
            <label>Số dư</label>
            <input type="text" name="VND" id="VND" class="form-control" value="<?= $echo->VND;?>" placeholder="" required/>
          </div>
         </div> 
         <div class="col-sm-6">
           <div class="form-group">
            <label>Chiết khẩu(%)</label>
            <input type="text" name="chietkhau" id="chietkhau" class="form-control" value="<?= $echo->chietkhau;?>" placeholder="" required/>
          </div>
         </div>
     </div>
     <div class="col-sm-13">
            <div class="form-group">
           <label for="exampleInputEmail1">Cấp bậc:</label>
            <select class="custom-select" name="level" id="level">
             <option value="">-- Chọn cấp</option>
             <option value="member">Member <?= $CHIETKHAU['mmember'] ?>%</option>
             <option value="daily">Đại lý (<?= $CHIETKHAU['daily'] ?>%)</option>
             <option value="admin">ADMIN (<?= $CHIETKHAU['admin'] ?>%)</option>
             <option value="ctv">Cộng tác viên (<?= $CHIETKHAU['ctv'] ?>%)</option>
           </select>
          </div>
      </div>
    <div class="form-group">
    <button type="submit" name="submit" id="submit" class="btn btn-block btn-outline-success">Lưu chỉnh sửa</button>
    </div>  
    </form>
    <script>
      jQuery('#update-member').submit(function(event) {
        event.preventDefault();
        $.ajax({
              url: WEBSITE_URL + "core/kunloc/chinh-sua-thanh-vien.php",
              dataType: "json",
              method: "POST",
              data: "type=UPDATE&" + $(this).serialize(),
            beforeSend: function (){
              $("#btn-menu").prop('disabled',true).html('Đang xử lý');
            },
            complete: function (){
              $("#btn-menu").prop('disabled', false).html('Tạo lại');
            },
            success: function (Data){
              return Swal.fire(Data.title,Data.text,Data.type);
            }
           })
      })
    </script> 
    <?php  endwhile; endif;endif;endif; ?>