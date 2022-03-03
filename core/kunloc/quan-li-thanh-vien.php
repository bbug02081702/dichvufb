<?php if($level != 'admin') exit(header("Location: $domain_url")); ?>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg show" modal="member">
	<div class="modal-dialog modal-x">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Chỉnh sửa member</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" modal="data-member"></div>
		</div>
	</div>
</div>
<script>
function EDITMEMBER(id) {
    $.post(WEBSITE_URL + 'core/kunloc/chinh-sua-thanh-vien.php', { edit: id } , function(data){
        $('div[modal=member]').modal(),$('div[modal=data-member]').html(data);
    })
} 
</script>
<div class="row">
<!-- bounceIn -->
<div class="col-lg-12" style="visibility: visible; animation-duration: 1s; animation-name:fadeIn;">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title"> Quản Lí Thành Viên</h4></div>
         </div>
         <div class="card-body">
             <div class="form-group">
                 <label>Tác Vụ Hàng Loạt:</label>
               <button type="button" id="active_all" class="m-1 btn btn-outline-success">Active Tài khoản</button>
               <button type="button" id="huy_active_all" class="m-1 btn btn-outline-warning">Hủy Active Tài khoản</button>
               <button type="button" id="banned_all" class="m-1 btn btn-outline-secondary">Banned All Tài khoản</button>
               <button type="button" id="del_all" class="m-1 btn btn-outline-danger">Xóa All Tài khoản</button>
             </div>
             <!-- STAR-->
             <div class="table-responsive">
              <table id="members" class="table table-bordered dataTable" role="grid" aria-describedby="default-datatable_info">
               <thead>
                 <tr role="row">
                     <th>STT</th>        
                     <th>Họ và Tên</th>
                     <th>Số Dư</th>
                     <th>Thông TinLiên Lạc</th>
                     <th>Trạng Thái Tài Khoản</th>  
                     <th>Ngày tham gia</th>
                    </tr>
               </thead>
               <tbody>
                <?php
                 $query = $kunloc->query("SELECT * FROM account");
                 while ($echo = $query->fetch_object()): ?>
                  <tr id="table_<?= $echo->id; ?>">
                     <td><b style="color:#fff"><?= $echo->id; ?></b></td>
                      <td>
                          <!-- /./ -->
                          <div class="media">
                              <div class="avatar">
                                  <img class="w-circle-icon rounded-circle mt-1 ml-2 mr-3" src="<?= $echo->avatar; ?>" style="margin-left:-10px;width:50px;height:50px">
                              </div>
                             <div class="media-body">
                                <b class="user-title"><span class="badge badge-secondary mt-2"><?= $echo->fullname; ?></span>
                                <p><span class="badge badge-success mt-2"><?= $echo->username; ?></span></p></b>
                            </div>  
                        </div>
                        <small>Cấp độ: <b>
                            <?php if($echo->level == 'member') echo 'Khách';
                            else if($echo->level == 'ctv') echo 'Cộng tác viên';
                            else if($echo->level == 'admin') echo 'Admin';
                            else echo 'Không xác định';
                            ?>
                            </b>
                        </small> -
                        <small>Chiết khấu: <?= $echo->chietkhau; ?>%<b>
                        <!-- /./ -->
                      </td>
                     <td>
                       <span type="button" onclick="EDITMEMBER(<?= $echo->id; ?>)" class="badge badge-success m-1"><i class="fa fa-edit"></i> Chỉnh sửa</span>
                       <div class="media-body">
					        <b class="user-title"><span class="m-1 badge badge-secondary">Số dư:</span>
				            <span class="m-1 badge badge-primary"><?= format_cash($echo->VND); ?></span></b>
				       </div>  
                    </td>
                    <td>
                         <div class="media-body">
					        <b class="user-title">
					          Email: <span class="badge badge-warning"><?= $echo->email; ?></span>
				          <p>Phone: <span class="badge badge-success mt-2"><?= $echo->phone; ?></span></b></p>
				       </div>
                     </td>    
                     <td>Trạng thái: 
                         <span class="badge badge-info" id="kichhoat_<?= $echo->id; ?>">
                         <?php 
                          if($echo->kichhoat == 'true' ) echo 'Đã kích hoạt';
                          else if($echo->kichhoat == 'fail')  echo 'Chưa kích hoạt';
                          else if($echo->kichhoat == 'disabled') echo 'Vô hiệu hóa';
                          ?>
                         </span>
                         <p>Địa chỉ IP: <span class="badge badge-default"><?= $echo->ip; ?></span></p>
                    </td> 
                    <td>Ngày tham gia:  <span class="badge badge-dark"><?= date("d/m/Y",$echo->created_at); ?></span></td>
                  </tr>
                  <?php endwhile; ?>
               </tbody>
            </table>
         </div>
         
      </div>
<!-- end -->
</div>
</div>
<!-- row -->   
</div>
<script>
$(document).ready(function() {
 Tables('members', 10 ,'desc')
})
$("#members").on('click', 'tr', function() {
	 $(this).toggleClass('table-active');
})
$('#active_all').click(function(){
        var Data = $('#members').DataTable().rows($('.table-active')).data();
		  for (var i = 0; i < Data.length; i++) {
		    id = Data[i][0].match(/">(.*)</)[1];
		    kichhoat(i, id);
		}
})
function kichhoat(i,id) {
  ! function(i, id) {
    $.post('API/api_admin.php', { case:"ACTIVE", id: id  }, function(data, status) {
    var Data = JSON.parse(data)
        if(Data.type == 'success') $('#kichhoat_'+id).text('Đã kích hoạt');
        toarst(Data.type,Data.text,Data.title);
   })
  }
  (i, id) 
}
$('#huy_active_all').click(function(){
 var Data = $('#members').DataTable().rows($('.table-active')).data();
for (var i = 0; i < Data.length; i++) {
	id = Data[i][0].match(/">(.*)</)[1];
	huykichhoat(i, id);
}
})
function huykichhoat(i, id) {
  ! function(i, id) {
    $.post('API/api_admin.php', {  case:"UNACTIVE", id: id  }, function(data, status) {
    var Data = JSON.parse(data)
    if(Data.type == 'success') $('#kichhoat_'+id).text('Chưa kích hoạt');
     toarst(Data.type,Data.text,Data.title);
    })
  }
(i, id)
     
}
$('#del_all').click(function(){
    const swalWithBootstrapButtons = Swal.mixin({ customClass: { confirmButton: 'm-1 btn-sm btn-success', cancelButton: 'm-1 btn-sm btn-danger'}, buttonsStyling: true })
    swalWithBootstrapButtons.fire({
          title: 'Xóa thành viên?',
          text: "Bạn có muốn xóa!",
          icon: 'info',
          showCancelButton: true,
          confirmButtonText: 'Đồng ý',
          cancelButtonText: 'Hoàn tác',
          reverseButtons: false
    }).then((result) => {
    if (result.value) {
        var Data = $('#members').DataTable().rows($('.table-active')).data();
		  for (var i = 0; i < Data.length; i++) {
		    id = Data[i][0].match(/">(.*)</)[1];
		    removes(i, id);
		}
    } 
    })	
    return false;
})
function removes(i,id) {
  $.post('API/api_admin.php', { case:"REMOVE", id: id }, function(data, status) {
    var Data = JSON.parse(data)
    if(Data.type == 'success') $('#members').DataTable().row($('#table_'+id)).remove().draw();
   })
}
$('#banned_all').click(function(){
var Data = $('#members').DataTable().rows($('.table-active')).data();
for (var i = 0; i < Data.length; i++) {
	id = Data[i][0].match(/">(.*)</)[1];
	banned(i, id);
}
})
function banned(i,id) {
    ! function(i, id) {
        $.post('API/api_admin.php', { case:"BANNED", id: id }, function(data, status) {
        var Data = JSON.parse(data)
        if(Data.type == 'success') $('#kichhoat_'+id).text('Vô hiệu hóa');
        toarst(Data.type,Data.text,Data.title);
      })
    }
(i, id)         
}
</script>