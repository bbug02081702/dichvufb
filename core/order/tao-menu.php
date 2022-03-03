<div class="row">
<div class="col-lg-12 col-md-12">
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <div class="header-title"><h4 class="card-title">Tạo menu cho dịch vụ</h4></div>
  </div>
  <div class="card-body">
      <form id="form2" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
      <div class="form-group">
        <label>Đặt tiêu đề cho dịch vụ này:</label>
        <input type="text" id="service_menu" name="service_menu" class="form-control" placeholder="Tăng like,facebook.........."/>
      </div>
     <div class="row">
         <div class="col-sm-6">
            <div class="form-group">
           <label for="exampleInputEmail1">Trạng thái Hiển Thị:</label>
            <select class="custom-select" name="trangthai" id="trangthai">
             <option value="show">Hiển thị</option>
             <option value="hide">Ẩn</option>
           </select>
          </div>
         </div>
        <div class="col-sm-6">
          <div class="form-group">
           <label for="exampleInputEmail1">CHỌN THỂ LOẠI HIỆN CÓ</label>
            <select class="custom-select" name="slug" id="slug">
            <?php
            $table_service = $kunloc->query("SELECT * FROM `table_service`");
            while ($row = $table_service->fetch_object()): ?>
            <option value="<?= $row->slug; ?>"><?= $row->service;?></option>
            <?php endwhile; ?>
           </select>
          </div>
        </div>
      </div>
       <div class="form-group">
      <label class="form-label">Đính kèm hình ảnh</label>
        <div class="custom-file">
         <input type="file" class="custom-file-input" name="image2" id="image2" />
         <label class="custom-file-label" for="customFile">UPLOAD</label>
        </div>
        <input type="hidden" class="form-control" name="banner_menu" id="banner_menu" />
        <div class="m-2 text-left" id="imgloading2"></div>
      </div>
    <script>
     $("#image2").change(function(){
        const form = $("#form2")[0];
        const formData = new FormData(form);
        const images = $("#image2").val();
        if (images.length === "") return toastr.warning("Bạn chưa tải ảnh lên")
        else { 
            $.ajax({
                url: WEBSITE_URL + "API/api_image.php",
                data: formData,
                processData: false,
                contentType: false,
                type: "POST",
                success: function (data) {
                 Data = JSON.parse(data);
                 if (Data.type == "success") $("#banner_menu").val(Data.url), $("#imgloading2").html('<img src="' + Data.url + '" class="img-thumbnail" height="100" width="100"></img>');
                 return toarst(Data.type, Data.text);
                },error: function () { return toastr.warning("Bạn chưa tải ảnh lên") },
            });
        }
    });
    </script>   
      <div class="form-group">
        <button type="submit" name="submit" id="submit" class="btn btn-block btn-success">Tạo ngay</button>
      </div>
      </form>
     <!--/./-->
     <!--/./-->
       <div class="form-group">
          <label>Click vào từng hàng trong bảng để xoá:</label>
            <button type="button" id="clean2" class="m-1 btn btn-outline-danger">Xóa bảng đã chọn</button>
       </div>
      <div class="table-responsive">
        <table id="table2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                      <th class="d-none" scope="col">#</th>
                      <th scope="col" style="width:40px">Thao tác</th>
                      <th scope="col">TAG</th>
                      <th scope="col">Banner</th> 
                      <th scope="col">Dịch vụ</th> 
                  </tr>
                </thead>
                <?php
                   $table_service_menu = $kunloc->query("SELECT * FROM `table_service_menu` ");
                   while ($echo = $table_service_menu->fetch_object()): ?>
                    <tr menu="<?= $echo->id; ?>">
                      <td class="d-none" ><b style="color:white"><?= $echo->id ?></b></td>
                      <td>
                       <span type="button" onclick="edit_menu(<?= $echo->id ?>)" class="btn btn-danger m-1" data-toggle="tooltip" title="Nhấp vào để chỉnh sửa"><i class="fa fa-edit"></i></span>
                      </td>
                      <td><b style="color:#"><?= $echo->slug; ?></b> <span class="badge badge-info"><?php if($echo->trangthai == 'show') echo 'Hiển thị'; else{ echo'Bị ẩn'; }; ?></span></td>
                      <td><img class="img" src="<?= $echo->banner; ?>" height="35"></td>
                      <td><b style="color:white"><?= $echo->service; ?></b></td>
                    </tr>
            <?php endwhile; ?>
            </table>
      </div>
      <script>jQuery(document).ready(function(){ Tables('table2', 5 ,'asc')})</script>
    </div>
  </div>
</div>
</div>
<script>
jQuery("#form2").submit(function(event){
    $.ajax({
      url: WEBSITE_URL + "core/order/setting.php",
      data: "type=MENU_CREATED&" + $(this).serialize(),
      method: "POST",
      dataType:"JSON",
      beforeSend:function(){
        Disabled('form2',true)
        $("#submit2").prop('disabled',true).html('Waiting');
      },
      complete: function(){
        Disabled('form2',false)
        $("#submit2").prop('disabled',false).html('SUBMIT');
      },
      success: function(data) {
        return Swal.fire(data.title,data.text,data.type);
      }
   })
})
//////////////////////////////////////////////////////////
$("table[id=table2]").on('click', 'tr', function() { $(this).toggleClass('table-active'); })
//////////////////////////////////////////////////////////
$('#clean2').click(function(){
const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'm-1 btn-sm btn-success',cancelButton: 'm-1 btn-sm btn-danger'}, buttonsStyling: true })
swalWithBootstrapButtons.fire({
    title: 'Bạn có muốn xóa?',
    text: "Việc này không thể hoàn tác!",
    icon: 'question',showCancelButton: true,confirmButtonText: 'Confirm',cancelButtonText: 'Cancel',reverseButtons: false
 }).then((result) => {
    if (result.value) {
        Data = $("table[id=table2]").DataTable().rows($(".table-active")).data();
		for (var i = 0; i < Data.length; i++) {
		  id = Data[i][0].match(/">(.*)</)[1];
		  funcdel2(id);
		}
    } 
  })	
 return;
})
function funcdel2(id) {
  $.post(WEBSITE_URL + "core/order/setting.php", { type: 'delete_menu', id: id }, function(data) {
    Data = JSON.parse(data);
    $("table[id=table2]").DataTable().row($("tr[menu="+id+"]")).remove().draw();
    return Swal.fire(Data.title, Data.text,Data.type);
  })
}
</script>