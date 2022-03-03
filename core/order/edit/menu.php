<?php
    require_once("../../../config.php"); 
    if($_GET)$_POST= $_GET;
    if(isset($_POST['type']) && $_POST['type'] == 'UPDATE' && isset($_POST['id'])){
     if(empty($_POST['edit_service']) || empty($_POST['edit_slug']) || empty($_POST['edit_trangthai'])){
       JSON("Yêu cầu thông tin","Bạn chưa điền đầy đủ thông tin","question");
     }
     $i = tachchuoi($_POST['id']);
     $service = tachchuoi($_POST['edit_service']);
     $slug = tachchuoi($_POST['edit_slug']);
     $banner = $_POST['edit_banner'];
     $trangthai = tachchuoi($_POST['edit_trangthai']);
     $UP = $kunloc->query("
     UPDATE `table_service_menu` SET `service`='$service',`banner` = '$banner', `trangthai`='$trangthai' WHERE id = '$i' ");
     if($UP) JSON("Update menu thành công","Chờ reload","success","die",true);
     else JSON("Update menu thất bại","Xin hãy thử lại","error");
       
    }
    if(!isset($_POST['CHANGE'])) exit();
    else if(isset($_POST['CHANGE'])):
    $id = $kunloc->real_escape_string($_POST['CHANGE']);
    $table_service_menu = $kunloc->query("SELECT * FROM `table_service_menu` WHERE id = '$id'");
    if($table_service_menu->num_rows != 1): ?>
    <center><b style="color:red">Bạn không có quyền sửa mục này. Vui lòng liên hệ <a href="<?= $CONTACT['chat'] ?>">Admin</a></b></center>
    <?php else: while($echo = $table_service_menu->fetch_object()): ?>
   <form id="form-upload-anh" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
      <input type="hidden" name="id" id="id" class="form-control" value="<?= $echo->id ?>"/>
     <div class="form-group">
        <label>Đặt tiêu đề cho dịch vụ này:</label>
        <input type="text" name="edit_service" id="edit_service" class="form-control" value="<?= $echo->service;?>" placeholder="Tăng like,facebook.........." required/>
      </div>
     <div class="row">
         <div class="col-sm-6">
            <div class="form-group">
           <label for="exampleInputEmail1">Trạng thái Hiển Thị:</label>
            <select class="custom-select" name="edit_trangthai" id="edit_trangthai">
             <option value="show">Hiển thị</option>
             <option value="hide">Ẩn</option>
           </select>
          </div>
         </div>
        <div class="col-sm-6">
          <div class="form-group">
           <label for="exampleInputEmail1">CHỌN THỂ LOẠI HIỆN CÓ</label>
            <select class="custom-select" name="edit_slug" id="edit_slug">
            <?php
            $table_service_menu = $kunloc->query("SELECT * FROM `table_service_menu`");
            while ($row = $table_service_menu->fetch_object()): ?>
            <option value="<?= $row->slug; ?>"><?= $row->service;?></option>
            <?php endwhile; ?>
           </select>
          </div>
        </div>
      </div>
       <div class="form-group">
      <label class="form-label">Đính kèm hình ảnh</label>
        <div class="custom-file">
         <input type="file" class="custom-file-input" name="edit_image" id="edit_image" />
         <label class="custom-file-label" for="customFile">UPLOAD</label>
        </div>
         <input type="hidden" class="form-control" <?php if(isset($echo->banner) && $echo->banner != null) echo 'value="'.$echo->banner.'"'; ?> name="edit_banner" id="edit_banner"/>
         <div class="m-2 text-left" id="edit_imgloading">
         <?php if(isset($echo->banner) && $echo->banner != null)  echo '<img src="'.$echo->banner.'" class="img-thumbnail" height="100" width="100"></img>'; ?>
      </div>
    <script>
     $("#edit_image").change(function () {
        var form = $("#edit-upload-anh")[0];
        var formData = new FormData(form);
        var get_image = $("#edit_image").val();
        if (get_image.length !== "") {
            $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="token"]').attr("value") } });
            $.ajax({
                url: WEBSITE_URL "API/api_image.php",
                data: formData,
                processData: false,
                contentType: false,
                type: "POST",
                success: function (data) {
                    Data = JSON.parse(data);
                    if (Data.type == "success") {
                       $("#edit_banner").val(Data.url), $("#edit_imgloading").html('<img src="' + Data.url + '" class="img-thumbnail" height="100" width="100"></img>');
                    }
                    return toarst(Data.type, Data.text);
                },
            });
        } else return toastr.warning("Bạn chưa tải ảnh lên");
    });
    </script>   
      <div class="form-group">
        <button type="submit" name="submit" id="submit" class="btn btn-block btn-outline-success">Lưu chỉnh sửa</button>
    </div>  
    </form>
    <script>
      jQuery("#form-upload-anh").submit(function(event){
        $.ajax({
          url: WEBSITE_URL + "core/order/edit/menu.php",
          data: "type=UPDATE&" + $(this).serialize(),
          method: "POST",
          dataType:"JSON",
          beforeSend:function(){
            Disabled('form-upload-anh',true)
            $("#submit").prop('disabled',true).html('Waiting');
          },
          complete: function(){
            Disabled('form-upload-anh',false)
            $("#submit").prop('disabled',false).html('SUBMIT');
          },
          success: function(data) {
            return Swal.fire(data.title,data.text,data.type);
          }
       })
     })
    </script> 
    <?php  endwhile; endif;endif; ?>