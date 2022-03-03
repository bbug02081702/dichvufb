<div class="row">
<div class="col-lg-12 col-md-12">
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <div class="header-title"><h4 class="card-title">Tạo option MENU</h4></div>
  </div>
  <div class="card-body">
      <form id="form3" action="javascript:void(0);" method="POST">
      <div class="form-group">
        <label>Đặt tiêu đề cho dịch vụ này:</label>
        <input type="text" name="service_server" id="service_server" class="form-control" placeholder="Tăng like,facebook.........."/>
      </div>
     <div class="form-group">
        <label>Giá bán:</label>
         <input type="number" class="form-control" name="price_default" id="price_default" placeholder="Rate dịch vụ, ví dụ: 100 (100đ/1 lượt)">
      </div>
      <div class="form-group">
        <label>Giá Đại Lý:</label>
         <input type="number" class="form-control" name="price_ctv" id="price_ctv" placeholder="Rate dịch vụ, ví dụ: 150 (150đ/1 lượt)">
      </div>
       <div class="form-group">
        <label>Giá Cộng Tác Viên:</label>
         <input type="number" class="form-control" name="price_daily" id="price_daily" placeholder="Rate dịch vụ, ví dụ: 130 (130đ/1 lượt)">
      </div>
     <!--/./-->
     <div class="row">
         <div class="col-sm-6">
           <div class="form-group">
                <label for="exampleInputPassword1">SỐ LƯỢNG MUA TỐI THIỂU</label>
                <input type="number" class="form-control" name="amount_min" id="amount_min" placeholder="Nhập số lượng tối thiểu khi order của dịch vụ này">
             </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputPassword1">SỐ LƯỢNG MUA TỐI Đa</label>
                 <input type="number" class="form-control" name="amount_max" id="amount_max" placeholder="Nhập số lượng tối đa khi order của dịch vụ này">
            </div>
         </div>
     </div>
     <!--/./-->
     <div class="row">
         <div class="col-sm-6">
            <div class="form-group">
           <label for="exampleInputEmail1">Trạng thái Hiển Thị:</label>
            <select class="custom-select" name="trangthai_server" id="trangthai_server">
             <option value="show">Hiển thị</option>
             <option value="hide">Ẩn</option>
           </select>
          </div>
         </div>
        <div class="col-sm-6">
          <div class="form-group">
           <label for="exampleInputEmail1">CHỌN MENU HIỆN CÓ</label>
            <select class="custom-select" name="slug_server" id="slug_server">
            <option value="">-- Chọn menu</option>  
            <?php
            $table_service_menu = $kunloc->query("SELECT * FROM `table_service_menu`");
            while ($row = $table_service_menu->fetch_object()): ?>
            <option value="<?= $row->type; ?>"><?= $row->service;?></option>
            <?php endwhile; ?>
           </select>
          </div>
        </div>
      </div>
     <div class="form-group">
          <label for="exampleInputEmail1">MÔ TẢ DỊCH VỤ</label>
          <textarea class="form-control" id="servercontent" placeholder="Nhập mô tả dịch vụ của bạn"></textarea>
      </div>
      <div class="form-group">
        <button type="submit" name="submit" id="submit" class="btn btn-success">Tạo ngay</button>
      </div>
      </form>
      <!--/./-->
        <div class="form-group">
              <label>Tác Vụ Hàng Loạt:</label>
               <button type="button" id="clean3" class="m-1 btn btn-outline-danger">Xóa bảng đã chọn</button>
             </div>
      <div class="table-responsive">
        <table id="table3" class="table table-bordered table-hover">
                <thead class="">
                    <tr>
                      <th class="d-none" scope="col">STT</th>
                      <th scope="col">Thao tác</th>
                      <th scope="col">TAG</th>
                      <th scope="col">Dịch vụ</th>
                      <th scope="col">Giá bán</th>
                      <th scope="col">Giá Đại Lý</th>
                      <th scope="col">Giá Cộng Tác Viên</th>
                      <th scope="col">Ghi Chú</th>
                  </tr>
                </thead>
                <?php
                   $table_service_server = $kunloc->query("SELECT * FROM `table_service_server` ORDER BY id ASC");
                   while ($echo = $table_service_server->fetch_object()): ?>
                    <tr id="option_<?= $echo->id; ?>">
                      <td class="d-none" ><b style="color:white"><?= $echo->id ?></b></td>
                      <td>
                       <span type="button" onclick="edit_option(<?= $echo->id ?>)"  class="btn btn-danger m-1" data-toggle="tooltip" title="Nhấp vào để chỉnh sửa"><i class="fa fa-edit"></i></span>
                      </td>
                      <td><b style="color:"><?= $echo->slug; ?></b>  <span class="badge badge-info"><?php if($echo->trangthai == 'show') echo 'Hiển thị'; else{ echo'Bị ẩn'; }; ?></span></td></td>
                      <td><b style="color:white"><?= $echo->server; ?></b></td>
                      <td><h style="color:white"><?= $echo->price_default; ?></h> Đ</td>
                      <td><h style="color:white"><?= $echo->price_daily; ?></h> Đ</td>
                      <td><h style="color:white"><?= $echo->price_ctv; ?></h> Đ</td>
                      <td><textarea readonly rows="1" class="form-control"><?= $echo->content; ?></textarea></td>
                    </tr>
            <?php endwhile; ?>
            </table>
      </div>
     <!--/./ -->
    <script>jQuery(document).ready(function(){ Tables('table3', 5 ,'asc')})</script>
    </div>
  </div>
</div>
</div>
<script>
setInterval(() => { editor = CKEDITOR.replace('servercontent'); }, 1e3);
jQuery("#form3").submit(function(event){
    $.ajax({
      url: WEBSITE_URL + "core/order/setting.php",
      data: "type=SERVER_CREATED&content="+CKEDITOR.instances.servercontent.getData()+"&" + $(this).serialize(),
      method: "POST",
      dataType:"JSON",
      beforeSend:function(){
        Disabled('form3',true)
        $("#submit").prop('disabled',true).html('Waiting');
      },
      complete: function(){
        Disabled('form3',false)
        $("#submit").prop('disabled',false).html('SUBMIT');
      },
      success: function(data) {
        return Swal.fire(data.title,data.text,data.type);
      }
   })
})
//////////////////////////////////////////////////////////
$("table[id=table3]").on('click', 'tr', function() { $(this).toggleClass('table-active'); })
//////////////////////////////////////////////////////////
$('#clean3').click(function(){
const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'm-1 btn-sm btn-success',cancelButton: 'm-1 btn-sm btn-danger'}, buttonsStyling: true })
swalWithBootstrapButtons.fire({
    title: 'Bạn có muốn xóa?',
    text: "Việc này không thể hoàn tác!",
    icon: 'question',showCancelButton: true,confirmButtonText: 'Confirm',cancelButtonText: 'Cancel',reverseButtons: false
 }).then((result) => {
    if (result.value) {
        Data = $("table[id=table3]").DataTable().rows($(".table-active")).data();
		for (var i = 0; i < Data.length; i++) {
		  id = Data[i][0].match(/">(.*)</)[1];
		  funcdel3(id);
		}
    } 
  })	
 return;
})
function funcdel3(id) {
  $.post(WEBSITE_URL + "core/order/setting.php", { type: 'REMOVE_SERVER', id: id }, function(data) {
    Data = JSON.parse(data);
    $("table[id=table3]").DataTable().row($("tr[service="+id+"]")).remove().draw();
    return Swal.fire(Data.title, Data.text,Data.type);
  })
}
</script>