<div class="row">
<div class="col-lg-5">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title">Nạp thẻ cào auto ( bảo trì )</h4></div>
         </div>
         <form id='form' action="javascript:void(0);" method="POST">
            <div class="card-body">
            <div class="row">
                  <div class="col-sm-6 select">
                     <div class="form-group is-empty">
                        <label for="type"> Loại thẻ:</label>
                        <select class="form-control" id="type" name="type" >
                           <option value="">Chọn loại thẻ</option>
                           <option value="VIETTEL">Viettel</option>
                           <option value="MOBIFONE">MOBIFONE</option>
                           <option value="ZING">ZING</option>
                           <option value="GATE">GATE</option>
                           <option value="VNMOBI">VNMOBI</option>
                           <option value="VINAPHONE">ViNAfone</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group is-empty">
                        <label for="amount"> Mệnh giá:</label>
                        <select class="form-control" id="amount" name="amount">
                           <option value="">Chọn mệnh giá</option>
                           <option value="10000">10.000</option>
                           <option value="20000">20.000</option>
                           <option value="30000">30.000</option>
                           <option value="50000">50.000</option>
                           <option value="100000">100.000</option>
                           <option value="200000">200.000</option>
                           <option value="300000">300.000</option>
                           <option value="500000">500.000</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group is-empty">
                        <label for="serial"> Số Seri:</label>
                        <input type="number" class="form-control" name="serial" id="serial"  placeholder="Vui lòng nhập mã seri..."/>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group is-empty">
                        <label for="code"> Mã thẻ:</label>
                        <input type="number" class="form-control" name="code" id="code" placeholder="Vui lòng nhập mã pin..." />
                     </div>
                  </div>
               </div>
               <div class="text-center">
                    <button type="submit" name="submit" id="submit" style="border-radius:10px" class="btn btn-block btn-success">NẠP THẺ</button>
               </div>
            </div>
        </form>
      </div>
    </div>
 <!-- /. -->
<div class="col-lg-7">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title">Lịch sử nạp thẻ</h4></div>
         </div>
         <div class="card-body">
         <div class="table-responsive">
              <table id="table" class="table nowrap scroll-horizontal-vertical">
               <thead>
                 <tr>
                     <th>STT</th>
                     <th>Mã giao dịch</th>
                     <th>Tình Trạng</th>
                     <th>Hành Động</th>
                     <?php if($level == 'admin'){ ?>
                     <th>Code/Seri</th>
                     <?php } ?>
                     <th>Tên</th>
                     <th>Mệnh giá</th>
                     <th>Loại thẻ</th>
                  </tr>
                  <tbody>
                     <?php
                        if($level == 'admin') $table_napthe = $kunloc->query("SELECT * FROM `napthe`");
                        else $table_napthe = $kunloc->query("SELECT * FROM `napthe` WHERE username ='$username'");  
                        while($echo = $table_napthe->fetch_object()): ?>
                    <tr id="table_<?= $echo->id; ?>">
                        <td><?= $echo->id; ?></td>
                        <td><?= $echo->ma_giao_dich; ?></td>
                        <td><span class="badge badge-primary">
                        <?php 
                          if($echo->trangthai == '0') echo 'Đợi duyệt';
                          else if($echo->trangthai == '100') echo 'Thẻ đúng';
                          else echo $echo->trangthai;
                        ?></span></td>
                        <td><span type="button" onclick="REMOVE(<?= $echo->id; ?>)" class="badge badge-danger"><i class="fas fa-trash-alt"></i></span></td>
                        <?php if($level == 'admin'){ ?>
                        <td><?= $echo->code; ?>/<?= $echo->serial; ?></td>
                        <?php } ?>

                        <td><?= $echo->username; ?></td>
                        <td><span class="badge badge-warning"><?= format_cash($echo->amount); ?> <sup><font color="black">VNĐ</font></sup></span></td>
                        <td><span class="badge badge-success"><?= $echo->telco; ?></span></td>
                        
                     </tr>
                     <?php endwhile; ?>
                  </tbody>
            </table>
         </div>

         </div>


      </div>
    </div>
<!-- /./ -->
 </div>
<script type="text/javascript">
jQuery(document).ready(function() { Tables('table', 10 ,'desc') })
function REMOVE(id) {
const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'm-1 btn-sm btn-success',cancelButton: 'm-1 btn-sm btn-danger' },buttonsStyling: true})
swalWithBootstrapButtons.fire({
  title: 'Xác nhận từ chối?',
  text: "Bạn chắc chắn muốn từ chối!",
  icon: 'question',showCancelButton: true,confirmButtonText: 'Đồng ý',cancelButtonText: 'Hoàn tác',reverseButtons: false
}).then((result) => {
  if (result.value) {
    $.post(WEBSITE_URL + 'core/nap-the-nhanh/setting.php', { 
           type: 'REMOVE', 
           id: id
        }, function(data) {
         Data = JSON.parse(data);
         if(Data.type == 'success') $("#table_"+id).remove();
         return Swal.fire(Data.title, Data.text,Data.type);
    })
  } 
})
return;
}
$("#form").submit(function (event) {
  $.ajax({
    url: WEBSITE_URL + "core/nap-the-nhanh/api.php",
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
</script>