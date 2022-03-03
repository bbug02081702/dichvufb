<div class="row">
<div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="alert alert-success">
          <!-- banner -->
          <div class="table-responsive text-center ">
               <img class="img-fluid" style="height:150px" src="<?= $momo_image ?>">
           </div>
           <br>
          <!-- content -->
            <p>Chủ tài khoản: <b class="code text-danger"><?= $momo_name ?> <i class="text-success fa fa-copy"></i></b></p>
            <p>Nạp tối thiểu: <b class="code text-danger">20.000VNĐ <i class="text-success fa fa-copy"></i></b></p>            
            <p>Số momo: <b class="code text-danger"><?= $momo_number ?> <i class="text-success fa fa-copy"></i></b></p>
            <div class="text-center card-body code text-success" style="border:dotted 2px red;">
            naptien <?= $username ?> <i class="text-danger fa fa-copy"></i>
            </div>
         <p class="m-1">
          <p>1. Sau khi chuyển số tiền đến tài khoản trên.</p>
          <p>2. Hệ thống sẽ kiểm tra giao dịch , nếu thành công tiền sẽ được công vào tài khoản của bạn trong vòng 1-10p.</p>
        </p >  
       </div>
    <!--/./ -->
   </div>
  </div>
</div>
<!-- /./ -->
<div class="col-lg-12">
 <div class="card">
  <div class="card-header d-flex">TẠO YÊU CẦU XÉT DUYỆT NẠP TIỀN</div>
   <div class="card-body">
       <form id="form" action="javascript:void(0);" method="POST">
           <div class="form-group">
                 <label class="form-label">Số Điện Thoại</label>
                  <input type="number" name="momo_number" id="momo_number" class="form-control" placeholder="Vui lòng nhập số tài khoản">
             </div>
             <div class="form-group">
                 <label class="form-label">Số tiền</label>
                <input type="number" name="momo_price"  id="momo_price" class="form-control" placeholder="Vui lòng nhập 10.000 > 500.000..">
             </div>
             <div class="form-group">
                 <label class="form-label">Mật Khẩu Đăng Nhập</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Vui lòng nhập mật khẩu.">
             </div>
             <!-- /./ -->
           <div class="form-group">
               <button type="submit" name="submit" id="submit" class="btn btn-xs btn-success">GỬI YÊU CẦU</button>
        </div> 
       </form>
      <div class="table-responsive">
         <table id="momo" class="table table-bordered dataTable nowrap scroll-horizontal-vertical">
               <thead>
                  <tr>
                    <th>Tùy Chọn</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Số tiền giao dịch</th>
                    <th scope="col">Thông tin người gửi</th>
                  </tr>
               <tbody>
                   <?php
                   function StatusMOMO($i){
                    if($i == 'fail') return 'Đang xử lý';
                    else if($i == 'success') return 'Hoàn thành';
                    else return 'Trống';
                   }
                   if($level == 'admin') $table_momo = $kunloc->query("SELECT * FROM `table_momo` WHERE trangthai = 'fail' ");
                   else $table_momo = $kunloc->query("SELECT * FROM `table_momo` WHERE username = '$username' AND trangthai = 'fail' ");  
                   while ($echo = $table_momo->fetch_object()): ?>
                    <tr id="table_<?= $echo->id; ?>">
                      <td>
                         <?php if($level == 'admin'){ ?>
                         <button type="button" onclick="CONFIRM(<?= $echo->id; ?>)" class="btn btn-sm btn-success" data-toggle="tooltip" data-title="Click vào để xác nhận đã chuyển tiền thành công"><i class="fas fa-toggle-on"></i></button>
                         <?php } ?>
                         <button type="button" onclick="REMOVE(<?= $echo->id; ?>)" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Nhấp vào để xóa yêu cầu(Không thể hoàn tác)"><i class="fas fa-trash-alt"></i></button>
                     </td>
                     <td> <b><?= StatusMOMO($echo->trangthai) ?></b></td>
                      <td>
                      Ngày: <b style="color:green"><?= date("d/m/Y",$echo->created_at); ?></b><br>
                      Số tiền thanh toán: <b style="color:red"><?= format_cash($echo->price); ?></b> VND<br>
                      </td>
                      <td>
                      Số điện thoai: #<b class="text-danger"><?= $echo->number; ?></b>
                      <br>
                      Gửi từ: <b style="color:#fff">
                      <?= $echo->username ? $echo->username : 'NULL'; ?></b>
                      </td>
                    </tr>
                    <?php endwhile; ?>
               </tbody>
               </thead>
            </table>
         </div>
      </div>
<!-- /./ -->
</div>
</div>
<div class="col-lg-12">
 <div class="card">
 <div class="card-header d-flex text-danger">LỊCH SỬ MOMO AUTO 100%</div>
   <div class="card-body">
     <!--- /./ -->
        <div class="table-responsive">
         <table id="momo-auto" class="table table-bordered dataTable nowrap scroll-horizontal-vertical">
            <thead>
              <tr>
                  <th scope="col">Trạng thái</th>
                  <th scope="col">Số tiền giao dịch</th>
                  <th scope="col">Thông tin người gửi</th>
              </tr>
            <tbody>
              <?php
                   if($level == 'admin') $api_momo = $kunloc->query("SELECT * FROM `api_momo`");
                   else $api_momo = $kunloc->query("SELECT * FROM `api_momo` WHERE username = '$username'");  
                   while ($echo = $api_momo->fetch_object()):  ?>
                    <tr>
                     <td><b><?= StatusMOMO($echo->trangthai)?></b></td>
                     <td>
                      <!--Ngày: <b style="color:green"><?= date("H:i:s d/m/Y",$echo->created_at); ?></b><br-->
                      Số tiền thanh toán: <b style="color:red"><?= format_cash($echo->price); ?></b> VND<br>
                      Nội dung: <b style="color:blue"><?= $echo->content; ?></b><br>
                      </td>
                      <td>
                      Số điện thoai: <b class="text-danger"><?= $echo->number; ?></b>
                      <br>
                      Gửi từ: <b><?= $echo->username ? $echo->username : 'NULL'; ?></b>
                      </td>
                    </tr>
                    <?php endwhile; ?>
               </tbody>
               </thead>
            </table>
         </div>
        </div>
    </div>
</div>
</div> 
<!-- ROW -->
<script type="text/javascript">
$("#form").submit(function (event) {
  $.ajax({
    url: WEBSITE_URL + "core/mo-mo/xuly.php",
    data: $(this).serialize(),
    method: "POST",
    beforeSend: function () {
      Disabled("form", true);
      $("#submit").prop("disabled", true).html("Đang xử lý");
    },
    complete: function () {
      Disabled("form", false);
      $("#submit").prop("disabled", false).html("Hoàn Thành");
    },
    success: function (data) {
      Data = JSON.parse(data);
      if (Data.reload)
        setTimeout(() => {
          location.reload();
        }, Data.time);
      //toarst(Data.type,Data.text,Data.title);
      Swal.fire(Data.title, Data.text, Data.type);
    },
    error: function (data) {
      Swal.fire("Thất bại", "Có lỗi khi thao tác", "error");
    },
  });
});

function CONFIRM(id) {
const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'm-1 btn-sm btn-success',cancelButton: 'm-1 btn-sm btn-danger'},buttonsStyling: true})
swalWithBootstrapButtons.fire({
  title: 'Xác Nhận',
  text: "Bạn chắc chắn muốn duyệt!",
  icon: 'question',showCancelButton: true,confirmButtonText: 'Đồng ý',cancelButtonText: 'Hoàn tác',reverseButtons: false
}).then((result) => {
  if (result.value) {
    $.post(WEBSITE_URL + 'core/mo-mo/setting.php', { type: 'CONFIRM', id: id}, function(data) {
      Data = JSON.parse(data);
      if(Data.reload) setTimeout(() => { location.reload() }, Data.time)
      return Swal.fire(Data.title, Data.text,Data.type);
    })
  } 
})
return false;
}
function REMOVE(id) {
const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'm-1 btn-sm btn-success',cancelButton: 'm-1 btn-sm btn-danger'},buttonsStyling: true})
swalWithBootstrapButtons.fire({
  title: 'Xác nhận xóa?',
  text: "Bạn chắc chắn muốn xóa!",
  icon: 'question',showCancelButton: true,confirmButtonText: 'Đồng ý',cancelButtonText: 'Hoàn tác',reverseButtons: false
}).then((result) => {
  if (result.value) {
    $.post(WEBSITE_URL + 'core/mo-mo/setting.php', { type: 'REMOVE', id: id }, function(data) {
      Data = JSON.parse(data);
      if(Data.type == 'success') $("#table_"+id).remove();
     return Swal.fire(Data.title, Data.text,Data.type);
    })
  } 
})
return;
}
jQuery(document).ready(function() {Tables('momo',10,'desc')})
jQuery(document).ready(function() {Tables('momo-auto',10,'desc')})
</script>
<?php include("main/foot.php"); ?>