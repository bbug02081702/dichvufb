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
    <!-- /./ -->
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
                  <img class="rounded-circle" src="<?= $logo ? $logo : $macdinh ?>"/></div>
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