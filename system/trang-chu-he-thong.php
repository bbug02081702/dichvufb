<?php
if(!isset($_SESSION['NOTI'])){
$thongbao = $kunloc->query("SELECT * FROM `table_notification_website` WHERE trangthai='show' ORDER BY id DESC LIMIT 0,1");
if($thongbao->num_rows == 1) $_SESSION['NOTI'] = 1;
while($echo = $thongbao->fetch_object()): ?>
<div class="modal fade" id="modalThongBao" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Thông báo - <?= date("d/m/Y",$echo->created_at) ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text- table-responsive">
        <?= $echo->noidung ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
<script>
$(document).ready(function(){
  $('#modalThongBao').modal();
})
</script>
<?php endwhile; } ?>
<div class="row">
    <div class="col-md-3">
        <div class="card overflow-hidden mb-3">
            <div class="bg-holder bg-card page_speed1"></div>
            <div class="card-body position-relative">
                <div class="display-4 fs-3 mb-2 font-weight-normal font-sans-serif text-primary"><?= format_cash($vnd) ?>
                <?= $coin ?></div>
                <h6 class="ml-1">Số dư hiện tại</h6>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card overflow-hidden mb-3">
            <div class="bg-holder bg-card page_speed2"></div>
            <div class="card-body position-relative">
                <div class="display-4 fs-3 mb-2 font-weight-normal font-sans-serif text-primary">
                <?php $dongtien =  $kunloc->query("SELECT SUM(price_change) AS price FROM `table_chi_tieu` WHERE username = '$username' ");
                 if($dongtien->num_rows  >= 1) echo format_cash($dongtien->fetch_object()->price);
                 else echo 0;
                ?> 
                <?= $coin ?></div>
              <h6 class="ml-1">Dòng tiền</h6>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card overflow-hidden mb-3">
            <div class="bg-holder bg-card page_speed4"></div>
            <div class="card-body position-relative">
                <div class="display-4 fs-3 mb-2 font-weight-normal font-sans-serif text-primary">
                 <?php $tongrut = $kunloc->query("SELECT SUM(price) AS price FROM `table_history` WHERE loai='RUTTIEN' AND username = '$username' ");
                    if($tongrut->num_rows >=1 ) echo format_cash($tongrut->fetch_object()->price);
                    else echo 0; ?>
                 <?= $coin ?></div>
                <h6 class="ml-1">Tổng đã rút</h6>
            </div>
        </div>
    </div>
</div>
<h4 class="mb-3 bold text-uppercase">Dịch vụ phổ biến</h4>
         <div class="row mb-2">
         <!-- /./ -->
         <div class="col-xl-3 col-6">
         <div class="card" style="box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.25);">
               <a href="mo-mo" targetT="_blank" class="btn-menu p-1">
               <svg><rect x="0" y="0" fill="none" width="100%" height="100%"></rect></svg> 
                  <img src="https://static.mservice.io/blogscontents/momo-upload-api-200508174734-637245568545885201.png" width="50" height="50" class="group-icon">
                  <h6 class="font-13 mt-3 mb-0">Momo</h6>
               </a>
         </div>
         </div>
         <div class="col-xl-3 col-6">
         <div class="card" style="box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.25);">
               <a href="bank" targetT="_blank" class="btn-menu p-2">
               <svg><rect x="0" y="0" fill="none" width="100%" height="100%"></rect></svg> 
                  <img src="https://cdn1.iconfinder.com/data/icons/business-and-office-1-8/128/31-512.png" width="50" height="50" class="group-icon">
                  <h6 class="font-13 mt-3 mb-0">Banking</h6>
               </a>
         </div>
         </div>
          <!-- /./ -->
          <div class="col-xl-3 col-6">
         <div class="card" style="box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.25);">
               <a href="nap-the-auto" targetT="_blank" class="btn-menu p-1">
               <svg><rect x="0" y="0" fill="none" width="100%" height="100%"></rect></svg> 
                  <img src="https://yopayment.vn/assets/images/icon/ico_naptien_new.svg" width="100" height="50" class="group-icon">
                  <h6 class="font-13 mt-3 mb-0">Nạp thẻ nhanh</h6>
               </a>
         </div>
         </div>
         <!-- /./ -->
         <div class="col-xl-3 col-6">
         <div class="card" style="box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.25);">
               <a href="thesieure" targetT="_blank" class="btn-menu p-2">
               <svg><rect x="0" y="0" fill="none" width="100%" height="100%"></rect></svg> 
                  <img src="https://yopayment.vn/assets/images/icon/ico_thanhtoan_new.svg" width="100" height="50" class="group-icon">
                  <h6 class="font-13 mt-3 mb-0">Nạp thẻ siêu rẻ</h6>
               </a>
         </div>
         </div>
          <!-- /./ -->
         <div class="col-xl-3 col-6">
         <div class="card" style="box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.25);">
               <a href="nap-the" targetT="_blank" class="btn-menu p-2">
               <svg><rect x="0" y="0" fill="none" width="100%" height="100%"></rect></svg> 
                  <img src="https://doicard.vn/assets/data/avatar/service/52ce059d1a7ead8a7759c26cf32693d0.png" width="50" height="50" class="group-icon">
                  <h6 class="font-13 mt-3 mb-0">Nạp thẻ chậm</h6>
               </a>
         </div>
         </div>
         
         <!-- /./ -->
         <div class="col-xl-3 col-6">
         <div class="card" style="box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.25);">
               <a href="rut-tien" targetT="_blank" class="btn-menu p-2">
               <svg><rect x="0" y="0" fill="none" width="100%" height="100%"></rect></svg> 
                  <img src="https://image.flaticon.com/icons/png/512/1796/1796830.png" width="50" height="50" class="group-icon">
                  <h6 class="font-13 mt-3 mb-0">Rút tiền</h6>
               </a>
         </div>
         </div>
         <!-- /./ -->
         <div class="col-xl-3 col-6">
         <div class="card" style="box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.25);">
               <a href="chuyen-tien" targetT="_blank" class="btn-menu p-2">
               <svg><rect x="0" y="0" fill="none" width="100%" height="100%"></rect></svg> 
                  <img src="https://cdn0.iconfinder.com/data/icons/online-money-service-orchid-volume-2/256/Prepaid_Top-Up-512.png" width="50" height="50" class="group-icon">
                  <h6 class="font-13 mt-3 mb-0">Chuyển tiền</h6>
               </a>
         </div>
         </div>
  <!-- /./ -->
 </div>
<div class="row">
<div class="col-md-7">
<!-- /./ -->
    <?php
    $table_service = $kunloc->query("SELECT * FROM `table_service` WHERE trangthai='show' ");
    if($table_service->num_rows >= 1):
    while($table_service_row = $table_service->fetch_object()):
    
    $table_service_menu = $kunloc->query("SELECT * FROM `table_service_menu` WHERE slug='".$table_service_row->slug."' AND trangthai = 'show' ORDER BY id ASC");
    if($table_service_menu->num_rows >= 1):
    ?>
            <h4 class="mb-3 bold text-uppercase"><?= $table_service_row->service;?></h4>
            <div class="row mb-2">
            <?php while($table_service_menu_row = $table_service_menu->fetch_object()): ?> 
             <!-- /./ -->
             <div class="col-xl-3 col-6">
             <div class="card" style="box-shadow: 0px 0px 0px rgba(0, 0, 0, 0.25);">
                    <a href="<?= $domain_url ?>/order/<?= $table_service_menu_row->type; ?>" class="btn-menu p-2 ">
                   <svg><rect x="0" y="0" fill="none" width="100%" height="100%"></rect></svg> 
                      <img src="<?= $table_service_menu_row->banner ?>" width="45" height="45" class="group-icon">
                      <h6 class="font-13 mt-3 mb-0"><?= $table_service_menu_row->service ?></h6>
                   </a>
             </div>
             </div>
          <?php endwhile; ?>
           </div>
       <?php endif; endwhile; endif; ?> 
</div>
<div class="col-md-5">
   <?php
    $table_notification_website = $kunloc->query("SELECT * FROM `table_notification_website` WHERE trangthai='show' ORDER BY id DESC LIMIT 0,5");
    while($echo = $table_notification_website->fetch_object()): ?>
    <div class="card">
      <div class="card-header">
         <div class="row">
        <div class="avatar avatar-xl ml-2 mr-2"><img src="<?= $logo ?>" class="rounded-circle"></div>
        <h6 class="text-primary">
         Quản trị viên <i class="fa fa-check-circle"></i>
         <p class="mt-1 text-success">Online <i class="fa fa-bell"></i> <small class="text-danger"> - <?= date("d-m-Y H:i:s ",$echo->created_at) ?></small></p></h6>
        <hr>
        </div>
        <div class="card-body table-responsive"><?= $echo->noidung ?></div>    
      </div>
      
    </div>
    <?php endwhile; ?>
    <!--/./-->
    <h4 class="mb-3 bold text-uppercase">Hoạt động</h4>
    <div class="col-xl-12 col-12">
         <div class="row card" style="border-radius:0">
            <div class="card-body" style="height:auto;overflow:scroll">
            <?php
            $table_history = $kunloc->query("SELECT * FROM `table_history` ORDER by id DESC LIMIT 0,10");
            while ($echo =$table_history->fetch_object()): ?>
            <div class="border-bottom-0 notification rounded-0 border-x-0 border-300">
             <div class="notification-avatar">
              <div class="avatar avatar-xl mr-3">
                  <img class="rounded-circle" src="<?= $ico ?>"/></div>
             </div>
             <div class="notification-body">
              <p class="mb-1">
               <strong><?= $echo->message ?></strong></p>
              <span class="notification-time"><span class="mr-1" role="img" aria-label="Emoji">⏱️</span><?= date("d/m/Y",$echo->created_at); ?></span>
             </div>
            </div>
          <?php endwhile; ?>
       </div>
       </div>
      </div>
    <!-- /./ -->
</div>
</div>
</div>