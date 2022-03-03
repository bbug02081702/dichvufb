<div class="row">
<div class="modal fade" id="modal-ho-tro">
 <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
   <div class="modal-header"><h5 class="modal-title" id="exampleModalLabel"> Tạo yêu cầu hỗ trợ</h5></div>
   <div class="modal-body">
    <form action="javascript:void(0);" method="POST">
         <div class="form-group">
             <label><b>Tiêu đề cần hỗ trợ</b></label>
            <input type="text" class="form-control" id="title" placeholder="Tôi cần hỗ trợ..." required autofocus>
        </div>
       <!-- /./ -->
        <div class="form-group">
          <label><b>Nội dung cần hỗ trợ</b></label>
          <textarea rows="1" type="text" id="noidung" class="form-control ckeditor">Nội dung</textarea>
        </div>
        <div class="col-md-13 text-center">
                  <div class="form-group">
                     <div class="alert text-white bg-danger" role="alert">
                        <div class="alert-text" type="submit" id="submit">GỬI YÊU CẦU</span></div>
                     </div>
                  </div>
          </div>   
    </form>
<script>
  setInterval(() => { editor = CKEDITOR.replace('noidung');}, 1e3);
    $('#submit').click(function(){
            var title = $("#title").val();
            var noidung = CKEDITOR.instances.noidung.getData()
            if(title == '' || noidung == ''){
             Swal.fire("Chưa điền đầy đủ thông tin","Vui lòng xem lại các trường ở trên, nếu đã đầy đủ thì nhấn để thử lại.","error")
             return false;   
            }
            $("#submit").prop('disabled',true).html('Đang kiểm tra...')
            $.post(C"core/ticket/ajax.php",{ title:title,noidung:noidung},function(data,status){
                Data  = JSON.parse(data)
                $("#submit").prop('disabled',false).html('Đã kiểm tra...')
                return Swal.fire(Data.title,Data.text,Data.type)
            })
        })
</script>
</div>
  
  </div>
 </div>
</div>
<!-- Modal -->
<div class="modal fade" id="view-ho-tro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg " role="document">
  <div class="modal-content">
   <div class="modal-header"><h5 class="modal-title" id="exampleModalLabel"> Xem yêu cầu hỗ trợ</h5></div>
       <form action="javascript:void(0);" method="POST">
         <div class="modal-body" id="data_view">
          </div>  
    </form>
<script>
function view(id) {
    $.post(WEBSITE_URL + 'core/ticket/view/index.php', { replay: id } , function(data){
        $('#view-ho-tro').modal(),$('#data_view').html(data);
    })
}
</script>
  
  </div>
 </div>
</div>
<div class="col-lg-12">
 <div class="row">
  <div class="col-md-6 col-lg-6">
   <div class="card card-block card-stretch card-height">
    <div class="card-body">
     <div class="d-flex align-items-center justify-content-between">
      <div class="text-left">
       <h4 class="mb-2">Chờ xử lý</h4>
       <h5 class="mb-0 line-height">
        <i class="fas fa-check-circle text-warning"></i> <b class="text-danger"><?= $kunloc->query("SELECT * FROM hop_thu_ho_tro WHERE username ='$username' AND trangthai='wait'")->num_rows ?></b> Yêu cầu
       </h5>
      </div>
      <div class="rounded-circle card-icon bg-warning">
       <i class="ri-gradienter-line"></i>
      </div>
     </div>
    </div>
   </div>
  </div>

 <!--/./-->
 <div class="col-md-6 col-lg-6">
   <div class="card card-block card-stretch card-height">
    <div class="card-body">
     <div class="d-flex align-items-center justify-content-between">
      <div class="text-left">
       <h4 class="mb-2">Đã trả lời</h4>
       <h5 class="line-height">
        <i class="fas fa-check-circle text-success"></i> <b class="text-danger"><?= $kunloc->query("SELECT * FROM hop_thu_ho_tro WHERE username ='$username' AND trangthai='replay'")->num_rows ?></b> Yêu cầu
       </h5>
      </div>
      <div class="rounded-circle card-icon bg-success">
       <i class="ri-gradienter-line"></i>
      </div>
     </div>
    </div>
   </div>
  </div>
</div>

</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title">HỘP THƯ HỖ TRỢ</h4></div>
         </div>
        <div class="card-body">
        <div class="float-left">
            <span data-toggle="modal" data-target="#modal-ho-tro" class="btn mb-2 btn-success float-right pull-right"><i class="fa fa-plus"></i> Tạo yêu cầu</span>
        </div>
            <div class="table-responsive">
            <table id="danhsach" class="table table-bordered dataTable" role="grid" aria-describedby="default-datatable_info">
                <thead>
                    <tr>
                        <th class="d-none">STT</th>
                        <th>Thao tác</th>
                        <th>Người gửi</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
               <?php 
                if($level == 'admin') $hop_thu_ho_tro = $kunloc->query("SELECT * FROM `hop_thu_ho_tro`");
                else $hop_thu_ho_tro = $kunloc->query("SELECT * FROM `hop_thu_ho_tro` WHERE username ='$username'");
                while($echo = $hop_thu_ho_tro->fetch_object()): 
                ?>
                <tr id="table_<?= $echo->id; ?>">
                    <td class="d-none"><?= $echo->id; ?></td>
                     <td>
                       <span type="button" onclick="view(<?= $echo->id ?>)" class="badge badge-success m-1" data-toggle="tooltip" title="Nhấp vào để xem"><i class="fa fa-eye"></i> Trả lời - Xem</span>
                       <p><span type="button" onclick="delete_yeucau(<?= $echo->id ?>)" class="badge badge-dark m-1" data-toggle="tooltip" title="Nhấp vào để xóa"><i class="ri-edit-2-fill"></i> Xóa yêu cầu</span>
                    </p>
                    </td>
                    <td>
                    <h>Bởi: <?= $echo->username; ?></h></br>
                    </td>
                    <td><?= $echo->title; ?></td>
                    <td><small readonly><?= $echo->noidung; ?></small></td>
                    <td>
                        <h><b class="text-dark">
                        <?php 
                        if($echo->trangthai == 'wait'):
                            echo 'Đang xử lý';
                        else: if($echo->trangthai == 'done'):
                            echo 'Đã xử lý';
                        else:if($echo->trangthai == 'replay'):
                            echo 'Đã trả lời';
                        endif;endif;endif;
                        ?>
                        </b>
                        </h>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
            </div>
           <!-- /./ -->
        </div>
    </div>
</div>
</div>
<script>
    function delete_yeucau(id) { 
     const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'm-1 btn-sm btn-success',cancelButton: 'm-1 btn-sm btn-danger'},buttonsStyling: true})
        swalWithBootstrapButtons.fire({
            title: 'Xóa yêu cầu này?',
            text: "Việc này không thể hoàn tác!",
            icon: 'question',showCancelButton: true,confirmButtonText: 'Đồng ý',cancelButtonText: 'Hoàn Tác',reverseButtons: false
        }).then((result) => {
        if (result.value) {
            $.post('core/ticket/setting.php', { type: 'delete', id: id }, function(data) {
    		Data = JSON.parse(data);
    		if(Data.type == 'success') $('#danhsach').DataTable().row($('#table_'+id)).remove().draw();
            return Swal.fire(Data.title, Data.text,Data.type);
           })
        }
        })
      return;
    }
jQuery(document).ready(function() {Tables('danhsach',10,'desc') })
</script>