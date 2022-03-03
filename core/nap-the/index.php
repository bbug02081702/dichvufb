<div class="row">
<div class="col-lg-5">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title">Nạp thẻ cào chậm 24h</h4></div>
         </div>
         <form id="form" action="javascript:void(0);" method="POST">
            <div class="card-body">
            <div class="irow row" >
                  <div class="col-sm-6">
                     <div class="form-group ">
                        <label for="card_type"> Loại thẻ:</label>
                        <select class="form-control" id="card_type" name="card_type" >
                           <option value="0">Chọn loại thẻ</option>
                           <option value="1">Viettel</option>
                           <option value="2">Vinafone</option>
                           <option value="3">Mobifone</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="card_price"> Mệnh giá:</label>
                        <select class="form-control" id="card_price" name="card_price">
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
                     <div class="form-group">
                        <label for=""> Số Seri:</label>
                        <input type="number" class="form-control" name="card_serial" id="serial"  placeholder="Vui lòng nhập mã seri..."/>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for=""> Mã thẻ:</label>
                        <input type="number" class="form-control" name="card_code" id="card_code" placeholder="Vui lòng nhập mã pin..." />
                     </div>
                  </div>
               </div>
               <div class="text-center">
                    <button type="submit" name="submit" id="submit" style="border-radius:10px" class="btn btn-block btn-success">Gửi Thẻ Chờ Duyệt</button>
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
              <table id="table" class="table table-striped nowrap scroll-horizontal-vertical">
               <thead>
                 <tr>
                     <th>STT</th>
                     <?php if($level == 'admin'){ ?>
                     <th>Thao tác</th>
                     <th>Code/Pin</th>
                     <?php } ?>
                     <th>Tên</th>
                     <th>Mệnh giá</th>
                     <th>Loại thẻ</th>
                     <th>Tình Trạng</th>
                  </tr>
                  <tbody>
                   <?php 
                   function StatusCard($i){
                       if($i == 'Hoantat'){
                          return 'Thẻ Đúng';
                       } else if($i == 'Thatbai'){
                          return 'Thẻ sai'; 
                       } else return 'Đang xử lý';
                    }
                    $table_napthe = $kunloc->query("SELECT * FROM `table_napthe` WHERE trangthai='Waiting' ");
                    $type = array("NULL",'Viettel','Vinaphone','Mobifone');
                    
                    while($echo = $table_napthe->fetch_object()): ?>
                    <tr id="table_<?= $echo->id; ?>">
                        <td><?= $echo->id; ?></td>
                        <?php if($level == 'admin'){ ?>
                        <td>
						      <span type="button" onclick="CONFIRM(<?= $echo->id; ?>)" class="badge badge-success"><i class="fas fa-check"></i></span>
						      <span type="button" onclick="REMOVE(<?= $echo->id; ?>)" class="badge badge-danger"><i class="fas fa-trash"></i></span>
						   </td>
                        <td><?= $echo->card_code; ?>/<?= $echo->card_serial; ?></td>
                        <?php } ?>
                        <td><?= $echo->username; ?></td>
                        <td><span class="badge badge-warning"><?= format_cash($echo->card_price); ?> <sup><font color="black">VNĐ</font></sup></span></td>
                        <td><span class="badge badge-success"><?= $type[$echo->card_type]; ?></span></td>
                        <td><span class="badge badge-primary"><?= StatusCard($echo->trangthai); ?></span></td>
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
<script>
$(document).ready(function() { Tables ('table',10,'desc') })
$("#form").submit(function (event) {
  $.ajax({
    url: WEBSITE_URL + "core/nap-the/xuly.php",
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
    $.post(WEBSITE_URL + 'core/nap-the/setting.php', { 
           type: 'CONFIRM', 
           id: id
        }, function(data) {
        Data = JSON.parse(data);
        if(Data.reload) setTimeout(() => { location.reload() }, Data.time)
        return Swal.fire(Data.title, Data.text,Data.type);
            
    })
  } 
})
return;
}
function REMOVE(id) {
const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'm-1 btn-sm btn-success',cancelButton: 'm-1 btn-sm btn-danger' },buttonsStyling: true})
swalWithBootstrapButtons.fire({
  title: 'Xác nhận từ chối?',
  text: "Bạn chắc chắn muốn từ chối!",
  icon: 'question',showCancelButton: true,confirmButtonText: 'Đồng ý',cancelButtonText: 'Hoàn tác',reverseButtons: false
}).then((result) => {
  if (result.value) {
    $.post(WEBSITE_URL + 'core/nap-the/setting.php', { 
           type: 'REMOVE', 
           id: id
        }, function(data) {
        Data = JSON.parse(data);
        if(Data.type == 'success') $('#table_'+id).remove();
        return Swal.fire(Data.title,Data.text,Data.type);
    })
  } 
})
return;
}
</script>