<div class="row">
<div class="col-lg-12">
    <div class="card">
      <div class="card-body">
      <div class="alert alert-success">
         <!-- banner -->
        <div class="text-center table-responsives">
           <img class="img-fluid" style="height:150px" src="<?= $bank_image ?>">
         </div> 
        <br>
          <!-- content -->
            <p>Số tài khoản: <b class="code text-danger"><?= $bank_number  ?> <i class="text-success fa fa-copy"></i></b></p>
            <p>Chủ tài khoản: <b class="code text-danger"><?= $bank_name ?> <i class="text-success fa fa-copy"></i></b></p>
            <p>Loại: <b class="code text-danger"><?=  $bank_type  ?> <i class="text-success fa fa-copy"></i></b></p>
            <p>Chi nhánh: <b class="code text-danger"><?= $bank_chi_nhanh ?> <i class="text-success fa fa-copy"></i></b></p>
            <div class="text-center card-body code text-success" style="border:dotted 2px red;">
            <?= $bank_content ?> <?= $username ?> <i class="text-danger fa fa-copy"></i>
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
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title">TẠO YÊU CẦU XÉT DUYỆT NẠP TIỀN</h4></div>
         </div>
         <form id="form" action="javascript:void(0);" method="POST">
            <div class="card-body">
                <!--- /./ -->
                  <div class="col-sm-13 mt-2">
                     <div class="form-group">
                       <label class="form-label">Chọn Phương Thức Thanh Toán</label>
                         <select class="form-control" name="table_loai" id="table_loai">
                          <option value="1">Ngân Hàng</option>
                         </select>
                       </div>
                    </div>
                   <!-- /./ -->
                  <div class="col-sm-13">
                     <div class="form-group">
                           <label class="form-label">Số Tài Khoản</label>
                           <input type="number" name="table_name"  id="table_name" class="form-control" placeholder="Vui lòng nhập số tài khoản">
                        </div>
                    </div>
                   <!-- /./ -->
                  <div class="col-sm-13">
                     <div class="form-group">
                           <label class="form-label">Chi Nhánh</label>
                           <input type="text" name="table_chi_nhanh" id="table_chi_nhanh" class="form-control" placeholder="Vui lòng nhập Chi nhánh">
                    </div>
                  </div>
                  <!-- /./ -->
                  <div class="col-sm-13">
                    <div class="form-group">
                           <label class="form-label">Số tiền</label>
                           <input type="number" name="table_price" id="table_price" class="form-control" placeholder="Vui lòng nhập 10.000 > 500.000..">
                     </div>
                  </div>
                  <!-- /./ -->
                  <div class="col-sm-13">
                    <div class="form-group">
                           <label class="form-label">Mật Khẩu Đăng Nhập</label>
                           <input type="password" name="password" id="password"  class="form-control" placeholder="Vui lòng nhập mật khẩu.">
                     </div>
                  </div>
                 <!-- /./ -->
                  <div class="col-sm-13">
                       <div class="form-group">
                         <button type="submit" name="submit" id="submit" class="btn btn-success" >GỬI ĐƠN</button>
                        </div> 
                        <p align="left">
                            <i class="fa fa-lightbulb-o"></i> Lưu Ý:<br>
    						+ Các yêu cầu nạp tiền cần tối thiểu 4h-24h để hoàn thành.<br>
    						+ Vui lòng điền chính xác các trường ở trên đẻ tránh mất tiền oan
    					</p>
                  </div>
            </div>
      </form>
</div>
</div>
<div class="col-lg-12">
   <div class="card">
   <div class="card-header d-flex justify-content-between">
     <div class="header-title"><h4 class="card-title"><i class="fa fa-1x fa-asterisk fa-spin text-success"></i> Lịch Sử Chuyển Khoản</h4></div>
   </div>
   <div class="card-body">
        <!--- /./ -->
        <div class="table-responsive">
         <table id="table" class="table table-bordered dataTable nowrap scroll-horizontal-vertical">
               <thead>
                  <tr>
                      <?php if($level == 'admin'){ ?>
                      <th>Tùy Chọn</th>
                      <?php } ?>
                      <th scope="col">Nội dung giao dịch</th>
                      <th scope="col">Số tiền giao dịch</th>
                      <th scope="col">Thông tin người gửi</th>
                      <th scope="col">Trạng thái</th>
                  </tr>
               <tbody>
                   <?php
                   function StatusBank($i){
                    if($i == 'fail') return 'Đang xử lý';
                    else if($i == 'error') return 'Từ chối';
                    else if($i == 'success') return 'Hoàn thành';
                    else return 'Không xác định';   
                   }
                   if($level == 'admin') $table_bank = $kunloc->query("SELECT * FROM `table_bank` WHERE trangthai='fail'");
                   else $table_bank = $kunloc->query("SELECT * FROM `table_bank` WHERE username = '$username' AND trangthai='fail'");  
                   while ($echo = $table_bank->fetch_object()):
				    ?>
                    <tr>
                     <?php if($level == 'admin'){ ?>
                      <td>
                       <?php 
                        if($echo->trangthai == 'error' || $echo->trangthai == 'fail'){ ?>
                        <span type="button" onclick="CONFIRM(<?= $echo->id; ?>)" class="m-1 badge badge-success" data-toggle="tooltip" title="Vui lòng nhấn xác nhận khi đã kiểm tra đúng với yêu cầu."><i class="fas fa-2x fa-check-circle"></i></span>
                        <span type="button" onclick="REMOVE(<?= $echo->id; ?>)" class="m-1 badge badge-danger" data-toggle="tooltip" title="Nhấp vào để xóa yêu cầu nếu yêu cầu không hợp lệ"><i class="fas fa-2x fa-trash"></i></span>
                        <?php }else echo ' <del>Đã Xử Lý</del>'; ?>
                       </td>
                     <?php } ?>
                     <td>STK: <b style="color:#fff"><?= $echo->table_name; ?></b></td>
                     <td>
                      Ngày: <b style="color:green"><?= date("H:i d/m/Y",$echo->created_at); ?></b><br>
                      Số tiền thanh toán: <b style="color:red"><?= format_cash($echo->table_price); ?></b> VND<br>
                      </td>
                      <td><b style="color:#fff"><?= $echo->username; ?></b></td>
                     <td><b style="color:#fff"><?= StatusBank($echo->trangthai);?></b></td>
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
<script>
$(document).ready(function() { Tables('table',10,'desc')});
$("#form").submit(function (event) {
  $.ajax({
    url: WEBSITE_URL + "core/bank/xuly.php",
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
  title: 'Xác nhận đã duyệt?',
  text: "Bạn chắc chắn muốn duyệt!",
  icon: 'question',showCancelButton: true,confirmButtonText: 'Đồng ý',cancelButtonText: 'Hoàn tác',reverseButtons: false
}).then((result) => {
  if (result.value) {
    $.post('core/bank/setting.php', {  type: 'CONFIRM',  id: id }, function(data) {
    Data = JSON.parse(data);
    if(Data.reload) setTimeout(() => { location.reload() }, Data.time)
    Swal.fire(Data.title, Data.text,Data.type);
    })
  } 
})
return false;
}
function REMOVE(id) {
const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'm-1 btn-sm btn-success',cancelButton: 'm-1 btn-sm btn-danger' },buttonsStyling: true})
swalWithBootstrapButtons.fire({
  title: 'Xác nhận từ xoá?',
  text: "Bạn chắc chắn muốn xoá!",
  icon: 'question',showCancelButton: true,confirmButtonText: 'Đồng ý',cancelButtonText: 'Hoàn tác',reverseButtons: false
}).then((result) => {
  if (result.value) {
    $.post('core/bank/setting.php', { type: 'REMOVE', id: id }, function(data) {
     Data = JSON.parse(data);
     if(Data.reload) setTimeout(() => { location.reload() }, Data.time)
     Swal.fire(Data.title, Data.text,Data.type);
    })
  } 
})
return false;
}
function copy(){
  var noidung = $('#copy').select();
  document.execCommand("copy");
  toarst('success','Đã copy nội dung','Đã copy')
  return false;
}
</script>