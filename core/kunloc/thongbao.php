<?php
session_start();
include("../../config.php");
if($username != $admin):
exit("<script>alert('Bạn không có quyền vào đây'); window.location.href = '$domain_url';</script>");
else: ?>
<div class="modal fade bd-example-modal-lg fade" id="editor">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="visibility: visible; animation-duration: 1s; animation-name: cc">
			<div class="modal-header">
				<h5 class="modal-title">Quản lí</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-update" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
				<div class="modal-body" id="responsive"></div>
			</form>
		</div>
	</div>
</div>
<script>
function EDIT_NOTI(id) {
    $.post(WEBSITE_URL + 'core/kunloc/edit-thong-bao.php', { edit: id } , function(data){
        $('#editor').modal(),$('#responsive').html(data);
    })
}
</script>
<div class="col-md-13">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Tạo thông báo hệ thống</span></h4>
            </div>
        </div>
        <div class="card-body">
           <div class="form-group">
            <textarea class="form-control ckeditor" rows="10" id="noidung" placeholder=""></textarea>
            </div>
           <div class="form-group">
             <button type="button" class="btn btn-primary" id="submit" onclick="Noti();">BẮT ĐẦU THÊM THÔNG BÁO</button>
            </div>
        </div>
    </div>
</div>
<div class="col-md-13">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Quản lí thông báo </span></h4>
            </div>
        </div>
        <div class="card-body">
           <div class="table-responsive">
               <table id="danhsach" class="table table-bordered nowrap scroll-horizontal-vertical">
                  <thead>
                  <tr>
                     <th style="width:30px">Tháo Tác</th>
                     <th>Nội dung</th>
                     <th style="width:30px">Trạng thái</th>
                     <th style="width:30px">Ngày đăng</th>
                  </tr>
                  </thead>
                  <?php
                   $query = $kunloc->query("SELECT * FROM `table_notification_website`");
                   while($echo = $query->fetch_object()): ?>
                   <tr>
                       <td>
                        <span type="button" class="btn btn-success" onclick="EDIT_NOTI(<?= $echo->id ?>)"><i class="fa fa-x fa-edit"></i></span>
                        <span type="button" class="btn btn-info" onclick="hide(<?= $echo->id ?>)"><i class="fa fa-eye"></i></span>
                        <span type="button" class="btn btn-danger" onclick="del(<?= $echo->id ?>)"><i class="fa fa-trash"></i></span>
                       </td>
                       <td><textarea class="bg-light form-control"><?= $echo->noidung ?></textarea></td>
                       <td><b><?= $echo->trangthai ?></b></td>
                       <td><?= date("H:i:s d/m/Y",$echo->created_at) ?></td>
                   </tr>
                   <?php endwhile; ?>
             
               </table>
           </div>
        </div>
    </div>
</div>
<script src="/assets/editor/ckeditor.js"></script>
<br><br><br><br>
<script type="text/javascript">
$(document).ready(function() {
    Tables('danhsach',6,'desc')
})
function del(id) {
  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'm-1 btn-sm btn-success',
    cancelButton: 'm-1 btn-sm btn-danger'
  },
  buttonsStyling: true
})
swalWithBootstrapButtons.fire({
  title: 'Xóa thông báo này đi?',
  text: "Bạn chắc chắn muốn xóa!",
  icon: 'error',
  showCancelButton: true,
  confirmButtonText: 'Đồng ý',
  cancelButtonText: 'Hoàn tác',
  reverseButtons: false
}).then((result) => {
  if (result.value) {
    $.post('<?= $domain_url ?>/core/kunloc/setting.php', { 
           case: 'REMOVE_THONGBAO', 
           id: id
        }, function(data) {
            Data = JSON.parse(data);
            if(Data.reload){ setTimeout(() => { location.reload() }, Data.time) }
            toarst(Data.type,Data.text,Data.title)
    })
  } 
})
return false;
}
function hide(id) {
  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'm-1 btn-sm btn-success',
    cancelButton: 'm-1 btn-sm btn-danger'
  },
  buttonsStyling: true
})
swalWithBootstrapButtons.fire({
  title: 'Chọn thông báo này?',
  text: "(Show hoặc Ẩn) điều nhấn để thực thi!",
  icon: 'error',
  showCancelButton: true,
  confirmButtonText: 'Đồng ý',
  cancelButtonText: 'Hoàn tác',
  reverseButtons: false
}).then((result) => {
  if (result.value) {
    $.post('<?= $domain_url ?>/core/kunloc/setting.php', { 
           case: 'HIDE_THONGBAO', 
           id: id
        }, function(data) {
           Data = JSON.parse(data);
           if(Data.reload){ setTimeout(() => { location.reload() }, Data.time) }
           toarst(Data.type,Data.text,Data.title)
    })
  } 
})
return false;
}
setInterval(() => {
      var editor = CKEDITOR.replace();
      checkout()
}, 1e3);
function Noti() {
        var noidung = CKEDITOR.instances.noidung.getData();
        if (noidung == '') {
            toarst("error","Yêu cầu nhập thông báo","Còn thiếu gì đó!");
            return false;
        }
		$('#submit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang xử lí..');
        $.post('<?= $domain_url ?>/core/kunloc/setting.php', { case: 'THONGBAO', noidung: noidung }, function(data, status) {
            Data = JSON.parse(data);
            $('#submit').prop('disabled',false).html('BẮT ĐẦU THÊM THÔNG BÁO');
            toarst(Data.type,Data.text,Data.title)	
        });
    }
</script>
<?php endif; ?>