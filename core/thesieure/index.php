<div class="row">
<div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="alert alert-success">
         <!-- content -->
            <p>Chủ tài khoản: <b class="code text-danger"><?= $THESIEURE['name'] ?> <i class="text-success fa fa-copy"></i></b></p>
            <p>Nạp tối thiểu: <b class="code text-danger">20.000VNĐ <i class="text-success fa fa-copy"></i></b></p>           
            <p>Số tài khoản: <b class="code text-danger"><?= $THESIEURE['stk'] ?> <i class="text-success fa fa-copy"></i></b></p>
            <div class="text-center card-body code text-success" style="border:dotted 2px red;">
            <?= $THESIEURE['noidung'] ?> <?= $username ?> <i class="text-danger fa fa-copy"></i>
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
  <div class="card-header d-flex">DUYỆT QUA MÃ GIAO DỊCH</div>
   <div class="card-body">
       <form id='form' action="javascript:void(0);" method="POST">
            <div class="form-group">
                 <label class="form-label" style="color:">Nhập mã giao dịch: (VD: 1ASJH4AS523)</label>
                 <input type="text" name="magiaodich" id="magiaodich" class="form-control" placeholder="Vui lòng nhập mã giao dịch">
               </div>
           <!-- /./ -->
           <div class="form-group">
               <label class="form-label" style="color:">Mật Khẩu Đăng Nhập</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Vui lòng nhập mật khẩu">
            </div>
            <!-- /./ -->
            <div class="form-group">
             <button type="submit" name="submit" id="submit" class="btn btn-xs btn-success">GỬI YÊU CẦU</button>
            </div> 
           </form>
      </div>
  </div>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <!--- /./ -->
        <div class="table-responsive">
         <table id="table" class="table table-bordered dataTable nowrap scroll-horizontal-vertical">
               <thead>
                  <tr>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Số tiền giao dịch</th>
                    <th scope="col">Thông tin người gửi</th>
                  </tr>
               <tbody>
                   <?php
                   if($username == $admin) $api_thesieure = $kunloc->query("SELECT * FROM `api_thesieure`");
                   else $api_thesieure = $kunloc->query("SELECT * FROM `api_thesieure` WHERE username = '$username'");  
                   while ($echo = $api_thesieure->fetch_object()):
				   ?>
                    <tr>
                    <td><b><?php if($echo->trangthai == 'fail') echo 'Đang xử lý'; else if($echo->trangthai == 'success') echo 'Hoàn thành'; else echo 'Trống';?></b></td>
                    <td>
                      Ngày: <b style="color:green"><?= $echo->created_at; ?></b><br>
                      Số tiền thanh toán: <b style="color:red"><?= format_cash($echo->price); ?></b> VND<br>
                      Nội dung: <b style="color:blue"><?= $echo->content; ?></b><br>
                      </td>
                      <td> - Gửi từ: <b><?= $echo->username ? $echo->username: 'NULL'; ?></b></td>
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
<script type="text/javascript">
$("#form").submit(function (event) {
  $.ajax({
    url: WEBSITE_URL + "core/thesieure/xuly.php",
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
jQuery(document).ready(function() {Tables('table',10,'desc')})
</script>