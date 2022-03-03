<?php
    require_once("../../../config.php"); 
    if($_GET)$_POST= $_GET;
    if(isset($_POST['type']) && $_POST['type'] == 'UPDATE' && isset($_POST['id'])){
    
    if(isset($_POST['edit_server']) && $_POST['edit_server'] !== '') $server = tachchuoi($_POST['edit_server']); else JSON("Bạn chưa nhập Server","Vui lòng thử lại","error");
    if(isset($_POST['edit_price_default']) && $_POST['edit_price_default'] !== '') $price_default = tachchuoi($_POST['edit_price_default']); else JSON("Bạn chưa thêm giá gốc","Vui lòng thử lại","error");
    if(isset($_POST['edit_price_daily']) && $_POST['edit_price_daily'] !== '') $price_daily = tachchuoi($_POST['edit_price_daily']); else JSON("Bạn chưa thêm giá cho đại lý","Vui lòng thử lại","error");
    if(isset($_POST['edit_price_ctv']) && $_POST['edit_price_ctv'] !== '') $price_ctv = tachchuoi($_POST['edit_price_ctv']); else JSON("Bạn chưa thêm giá cho cộng tác viên","Vui lòng thử lại","error");
    if(isset($_POST['edit_content']) && $_POST['edit_content'] !== '') $content = $kunloc->real_escape_string($_POST['edit_content']); else JSON("Bạn chưa thêm content","Vui lòng thử lại","error");
    if(isset($_POST['edit_amount_min']) && $_POST['edit_amount_min'] !== '') $amount_min = tachchuoi($_POST['edit_amount_min']); else JSON("Bạn chưa nhập tối thiểu","Vui lòng thử lại","error");
    if(isset($_POST['edit_amount_max']) && $_POST['edit_amount_max'] !== '') $amount_max = tachchuoi($_POST['edit_amount_max']); else JSON("Bạn chưa nhập tối đa","Vui lòng thử lại","error");
    if(isset($_POST['edit_trangthai']) && $_POST['edit_trangthai'] !== '') $trangthai = tachchuoi($_POST['edit_trangthai']); else JSON("Bạn chưa chọn trạng thái","Vui lòng thử lại","error");
    if(isset($_POST['edit_slug']) && $_POST['edit_slug'] !== '') $slug = $kunloc->real_escape_string($_POST['edit_slug']); else JSON("Bạn chưa chọn loại service","Vui lòng thử lại","error");
    if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
    /////////////////////////////////////////
    $i = tachchuoi($_POST['id']);
    $type = text($server);
    /////////////////////////////////////////    
    $UP = $kunloc->query("
    UPDATE `table_service_server` SET `type`='$type', `server`='$server', `price_default`='$price_default',`price_daily`='$price_daily',`price_ctv`='$price_ctv', `amount_min`='$amount_min', `amount_max`='$amount_max', `content`='$content', `trangthai`='$trangthai' WHERE id = '$i' ");
    if($UP) JSON("Update thành công","Chờ reload","success","die",true);
    else JSON("Update thất bại","Xin hãy thử lại","error");
       
    }
    if(!isset($_POST['CHANGE'])) exit();
    else if(isset($_POST['CHANGE'])):
    $id = $kunloc->real_escape_string($_POST['CHANGE']);
    $table_service_server = $kunloc->query("SELECT * FROM `table_service_server` WHERE id = '$id'");
    if($table_service_server->num_rows != 1): ?>
    <center><b style="color:red">Bạn không có quyền sửa mục này. Vui lòng liên hệ <a href="<?= $CONTACT['chat'] ?>">Admin</a></b></center>
    <?php else: while($echo = $table_service_server->fetch_object()): ?>
   <form id="form-upload-anh" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
    <input type="hidden" name="id" id="id" class="form-control" value="<?= $echo->id ?>"/>
     <div class="form-group">
        <label>Đặt tiêu đề cho dịch vụ này:</label>
        <input type="text" name="edit_server" id="edit_server" class="form-control" value="<?= $echo->server;?>" placeholder="Tăng like,facebook.........." required/>
      </div>
      <div class="form-group">
        <label>Giá bán:</label>
         <input type="number" class="form-control" name="edit_price_default" id="edit_price_default" value="<?= $echo->price_default;?>" placeholder="Rate dịch vụ, ví dụ: 100 (100đ/1 lượt)" required>
      </div>
      <div class="form-group">
        <label>Giá Cộng Tác Viên:</label>
         <input type="number" class="form-control" name="edit_price_ctv" id="edit_price_ctv" value="<?= $echo->price_ctv;?>" placeholder="Rate dịch vụ, ví dụ: 130 (130đ/1 lượt)" required>
      </div>
      <div class="form-group">
        <label>Giá Đại Lý:</label>
         <input type="number" class="form-control" name="edit_price_daily" id="edit_price_daily" value="<?= $echo->price_daily;?>" placeholder="Rate dịch vụ, ví dụ: 150 (150đ/1 lượt)" required>
      </div>
     <div class="row">
         <div class="col-sm-6">
           <div class="form-group">
                <label for="exampleInputPassword1">SỐ LƯỢNG MUA TỐI THIỂU</label>
                <input type="number" class="form-control" name="edit_amount_min" id="edit_amount_min" value="<?= $echo->amount_min;?>"placeholder="Nhập số lượng tối thiểu khi order của dịch vụ này" required>
             </div>
         </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputPassword1">SỐ LƯỢNG MUA TỐI Đa</label>
                 <input type="number" class="form-control" name="edit_amount_max" id="edit_amount_max" value="<?= $echo->amount_max;?>" placeholder="Nhập số lượng tối đa khi order của dịch vụ này" required>
            </div>
         </div>
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
            <option value="">-- Chọn dịch vụ</option>
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
          <label for="exampleInputEmail1">MÔ TẢ DỊCH VỤ</label>
          <textarea class="form-control" id="edit_content" placeholder="Nhập mô tả dịch vụ của bạn" required><?= $echo->content;?></textarea>
      </div>
      <div class="form-group">
        <button type="submit" name="submit" id="submit" class="btn btn-block btn-outline-success">Lưu chỉnh sửa</button>
    </div> 
  </form> 
    <script>
     setInterval(() => { editor = CKEDITOR.replace('edit_content'); }, 1e3);
     jQuery("#form-upload-anh").submit(function(event){
        var content = CKEDITOR.instances.edit_content.getData();
        $.ajax({
          url: WEBSITE_URL + "core/order/edit/option.php",
          data: "type=UPDATE&edit_content="+content+"&" + $(this).serialize(),
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
    <?php endwhile; endif;endif; ?>