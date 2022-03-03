<?php
	session_start();
    require_once("../../config.php");
    if($_GET)$_POST= $_GET;
    if(isset($_POST['type']) == 'UPDATE' && isset($_POST['id'])){
    if(empty($_POST['noidung'])) JSON("Bạn chưa nhập đầy đủ", "Bạn chưa điền NộI DUNG","info");
    $i = tachchuoi($_POST['id']);
    $ghichu = $kunloc->real_escape_string($_POST['noidung']);
    $kiemtra =  $kunloc->query("SELECT * FROM `table_notification_website` WHERE id = '$i'")->fetch_object();
    if(empty($kiemtra->id)){
        JSON("Thông báo không tồn tại","Vui lòng kiểm tra lại","error");
    }
    $CAPNHAT = $kunloc->query("
    UPDATE `table_notification_website` 
    SET `noidung` ='$ghichu' WHERE `id`= '$i'");
    if($CAPNHAT){
       JSON("Hệ thống thông báo", 
       "Đã cập nhật xong",
       "success",
       "die",
       "true");
     }else JSON("Hệ thống thông báo","Chỉnh sửa thất bại, xin hãy thử lại","error");
    }
    if(!isset($_POST['edit'])):
      exit();
    else: if(isset($_POST['edit'])):
    $id = $kunloc->real_escape_string($_POST['edit']);
    $query_order = $kunloc->query("SELECT * FROM `table_notification_website` WHERE id = '$id'")->num_rows;
    if($query_order != 1): ?>
    <center><b style="color:red">Bạn không có quyền xem mục này.Vui lòng liên hệ <a href="https://facebook.com/<?= $facebook ?>">Admin</a></b></center>
    <?php else:
       $query = $kunloc->query("SELECT * FROM `table_notification_website` WHERE id = '$id'");
       while($echo = $query->fetch_object()):
    ?>
     <input type="hidden" id="id" name="id" class="form-control" value="<?= $echo->id ?>"/>
     <div class="form-group">
         <label class="form-label" style="color:black">Nội dung:</label>
        <textarea rows="5" type="text" id="noidung" class="form-control ckeditor"><?= $echo->noidung ?></textarea>
      </div>
    <div class="form-group">
        <button type="button" id="capnhat" name="capnhat" class="btn btn-floating btn-lg btn-block btn-success waves-effect waves-light text-white">Lưu chỉnh sửa</button>
     </div> 
    <script>
       setInterval(() => {
          var editor = CKEDITOR.replace('noidung');
        }, 1e3);
        jQuery('#capnhat').click(function() {
            const id = $("#id").val();
            const noidung = CKEDITOR.instances.noidung.getData()
            $.ajax({
                url: WEBSITE_URL + "/core/kunloc/edit-thong-bao.php",
                method: "POST",
                data: { 
                    type: 'UPDATE',id:id,
                    noidung: noidung
                },
                dataType:"JSON",
                beforeSend:function(){
                    $("#capnhat").prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Đang kiểm tra trạng thái');
                    setTimeout(1000);
                },
                complete: function () {
                  $("#capnhat").prop("disabled", false).html('TIẾN HÀNH CÀI ĐẶT');
                },
                success:function(data){ 
                   //if(data.reload) setTimeout(() => { location.reload() } , data.time)
                   if(data.type == 'success') $('#editor').modal('hide')
                   Swal.fire(data.title, data.text,data.type);
                   //toarst(data.type,data.text,data.title);
                },
                error: function (data) {
                  Swal.fire(data.title, data.text,data.type);
                }
            })
        })
    </script> 
<?php  endwhile; endif;endif;endif; ?>