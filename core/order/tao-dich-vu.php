<!-- Modal -->
<div class="modal fade bd-example-modal-lg show" modal="editservice">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="visibility: visible; animation-duration: 1s; animation-name: cc">
			<div class="modal-header">
				<h5 class="modal-title">Chỉnh sửa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		 <div class="modal-body" data="responsive"></div>
		</div>
	</div>
</div>
<script>
function edit_theloai(id) {
    $.post(WEBSITE_URL + 'core/order/edit/the-loai.php', { CHANGE: id } , function(data){
        $('div[modal=editservice]').modal(),$('div[data=responsive]').html(data);
    })
}
function edit_menu(id) {
    $.post(WEBSITE_URL + 'core/order/edit/menu.php', { CHANGE: id } , function(data){
      $('div[modal=editservice]').modal(),$('div[data=responsive]').html(data);
    })
}
function edit_option(id) {
    $.post(WEBSITE_URL + 'core/order/edit/option.php', { CHANGE: id } , function(data){
        $('div[modal=editservice]').modal(),$('div[data=responsive]').html(data);
    })
}
</script>

<div class="row">

<div class="col-lg-12 col-md-12">
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <div class="header-title"><h4 class="card-title"> TẠO DỊCH VỤ ĐĂNG BÁN</h4></div>
  </div>
  <div class="card-body">
      <form id="form1" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
      <div class="form-group">
        <label>Chọn tiêu đề dịch vụ:</label>
        <input type="text" name="service" id="service" class="form-control" placeholder="Tăng like,facebook.........."/>
      </div>
      <div class="form-group">
      <label class="form-label">Đính kèm hình ảnh</label>
        <div class="custom-file">
         <input type="file" class="custom-file-input" name="image" id="image" />
         <label class="custom-file-label" for="customFile">UPLOAD</label>
        </div>
        <input type="hidden" class="form-control" id="banner" name="banner"/>
        <div class="m-2 text-left" id="imgloading"></div>
      </div>
    <script>
     $("#image").change(function(){
        const form = $("#form1")[0];
        const formData = new FormData(form);
        const images = $("#image").val();
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
                 if (Data.type == "success") $("#banner").val(Data.url), $("#imgloading").html('<img src="' + Data.url + '" class="img-thumbnail" height="100" width="100"></img>');
                 return toarst(Data.type, Data.text);
                },error: function () { return toastr.warning("Bạn chưa tải ảnh lên") },
            });
        }
    });
    </script>   
      <div class="form-group">
         <label class="form-label">Thêm content về dịch vụ này:</label>
        <textarea type="text" rows="1" id="contents" class="form-control ckeditor"></textarea>
      </div>
      <div class="form-group">
        <button type="submit" name="submit" id="submit" class="btn btn-success">Bắt đầy tạo ngay</button>
      </div>
   </form>
   <!--/./-->
   <div class="form-group">
      <label>Click vào từng hàng trong bảng để xoá:</label>
        <button type="button" id="delete-theloai" class="m-1 btn btn-outline-danger">Xóa bảng đã chọn</button>
   </div>
   <!--/./-->
   <div class="table-responsive">
        <table id="table1" class="table table-bordered table-hover">
                <thead class="">
                    <tr>
                      <th scope="col">STT</th>
                      <th scope="col">Thao tác</th>
                      <th scope="col">Dịch vụ</th>
                      <th scope="col">Banner</th>
                      <th scope="col">Ghi Chú</th>
                  </tr>
                </thead>
                <?php
                   $table_service = $kunloc->query("SELECT * FROM table_service");
                   while ($echo = $table_service->fetch_object()): ?>
                    <tr service="<?= $echo->id; ?>">
                      <td><b style="color:white"><?= $echo->id ?></b></td>
                      <td>
                       <span type="button" onclick="edit_theloai(<?= $echo->id ?>)" class="badge badge-dark m-1" data-toggle="tooltip" title="Nhấp vào để chỉnh sửa"><i class="ri-edit-2-fill"></i> CHỈNH SỬA</span>
                      </td>
                      <td><b style="color:white"><?= $echo->servive; ?>  <span class="badge badge-info"><?php if($echo->trangthai == 'show') echo 'Hiển thị'; else{ echo'Bị ẩn'; }; ?></span></td></b></td>
                      <td><img class="img" src="<?= $echo->banner; ?>" height="35"></td>
                      <td><small><?= substr($echo->content,0,300); ?></small></td>
                    </tr>
            <?php endwhile; ?>
          </table>
      </div>
     <!--/./ -->
    <script>jQuery(document).ready(function(){ Tables('table1', 3 ,'asc')})</script>
    </div>
  </div>
</div>
</div>
<script>
setInterval(() => { editor = CKEDITOR.replace('contents'); }, 1e3);
jQuery("#form1").submit(function(event){
    $.ajax({
      url: WEBSITE_URL + "core/order/setting.php",
      data: "type=SERVICE_CREATED&content="+CKEDITOR.instances.contents.getData()+"&" + $(this).serialize(),
      method: "POST",
      dataType:"JSON",
      beforeSend:function(){
        Disabled('form1',true)
        $("#submit").prop('disabled',true).html('Waiting');
      },
      complete: function(){
        Disabled('form1',false)
        $("#submit").prop('disabled',false).html('SUBMIT');
      },
      success: function(data) {
        return Swal.fire(data.title,data.text,data.type);
      }
   })
})
//////////////////////////////////////////////////////////
$("table[id=table1]").on('click', 'tr', function() { $(this).toggleClass('table-active'); })
//////////////////////////////////////////////////////////
$('#clean1').click(function(){
const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'm-1 btn-sm btn-success',cancelButton: 'm-1 btn-sm btn-danger'}, buttonsStyling: true })
swalWithBootstrapButtons.fire({
    title: 'Bạn có muốn xóa?',
    text: "Việc này không thể hoàn tác!",
    icon: 'question',showCancelButton: true,confirmButtonText: 'Confirm',cancelButtonText: 'Cancel',reverseButtons: false
 }).then((result) => {
    if (result.value) {
        Data = $("table[id=table1]").DataTable().rows($(".table-active")).data();
		for (var i = 0; i < Data.length; i++) {
		  id = Data[i][0].match(/">(.*)</)[1];
		  funcdel(id);
		}
    } 
  })	
 return;
})
function funcdel(id) {
  $.post(WEBSITE_URL + "core/order/setting.php", { type: 'delete_the_loai', id: id }, function(data) {
    Data = JSON.parse(data);
    $("table[id=table1]").DataTable().row($("tr[service="+id+"]")).remove().draw();
    return Swal.fire(Data.title, Data.text,Data.type);
  })
}
</script>
<?php include("tao-menu.php"); ?>
<?php include("tao-server.php"); ?>