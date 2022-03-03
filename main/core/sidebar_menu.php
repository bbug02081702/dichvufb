<nav class="navbar navbar-vertical navbar-inverted navbar-expand-xl navbar-light">
 <div class="d-flex align-items-center">
  <div class="toggle-icon-wrapper">
   <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" id="show_list_star" data-toggle="tooltip" data-placement="left" title="" data-original-title="❤">
    <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
   </button>
  </div>
  <a class="navbar-brand" href="<?= $domain_url ?>">
   <div class="d-flex align-items-center py-3">
    <img class="d-none rounded-circle mr-2" src="<?= $logo ?>" height="38"  width="38" onload="pagespeed.CriticalImages.checkImageForCriticality(this);" />
    <span class="text-sans-serif page_speed"><?= $domain_name ?></span>
   </div>
  </a>
 </div>
 <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
  <div class="navbar-vertical-content perfect-scrollbar scrollbar">
   <ul class="navbar-nav flex-column">
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/trang-chu">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon">
        <svg class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-pie" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" data-fa-i2svg="">
         <path fill="currentColor"d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z"></path>
        </svg>
       </span>
       <span class="nav-link-text"> Trang chủ hệ thống</span>
      </div>
     </a>
    </li>
    <?php if($level == 'admin'){ ?>
     <small><span class="fas fa-award"></span> Quản lí hệ thống</small>
     <li class="nav-item">
     <a class="nav-link dropdown-indicator" href="#panel-admin" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="facebook">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon"><span class="fas fa-tachometer-alt"></span></span>
       <span class="nav-link-text"><span class="fab fa-3x fa-cpanel"></span></span>
      </div>
     </a>
     <!-- /./ -->
     <ul class="nav collapse shows" id="panel-admin" data-parent="#navbarVerticalCollapse" style="">
     <li class="nav-item"><a class="nav-link" href="<?= $domain_url ?>/quan-li-thanh-vien"><i class="fas fa-user text-success"></i> Quản lí thành viên</a></li>
     <li class="nav-item"><a class="nav-link" href="<?= $domain_url ?>/cai-dat-giao-dien"><i class="fas fa-users-cog text-info"></i> Cấu hình hệ thống</a></li>
     <li class="nav-item"><a class="nav-link" href="<?= $domain_url ?>/tao-dich-vu"><i class="fas fa-list-ol text-primary"></i> Thêm dịch vụ order</a></li>
     <li class="nav-item"><a class="nav-link" href="<?= $domain_url ?>/tao-thong-bao"><i class="fas fa-list-ol text-primary"></i> Thêm thông báo</a></li>
     </ul>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/quan-li">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon">
        <span class="fas fa-list"></span>
       </span>
       <span class="nav-link-text"> Quản lí đơn hàng  </span>
      </div>
     </a>
    </li>
    <?php } ?>
    <small class="mt-3 mb-3"><span class="fas fa-award"></span> Dịch vụ mạng xã hội</small>
    <li class="nav-item">
     <?php
       $table_service = $kunloc->query("SELECT * FROM `table_service` WHERE trangthai='show' ");
       while($table_service_show = $table_service->fetch_object()):
     ?>
     <a class="nav-link dropdown-indicator mb-2" href="#orders_<?= $table_service_show->id ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="facebook">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon mr-1">
        <i class="icon-img"><img height="30" src="<?= $table_service_show->banner;?>"></i>
       </span>
        <small style="font-size:12px" class="nav-link-text"> <?= $table_service_show->service;?></small>
      </div>
     </a>
     <!-- /./ -->
     <ul class="nav collapse" id="orders_<?= $table_service_show->id ?>" data-parent="#navbarVerticalCollapse" style="">
     <?php
      $table_service_menu = $kunloc->query("SELECT * FROM `table_service_menu` WHERE slug='".$table_service_show->slug."' ORDER BY id ASC");
      while($table_menu_row = $table_service_menu->fetch_object()):
      ?>  
      <li class="nav-item">
       <a class="nav-link" href="<?= $domain_url ?>/order/<?= $table_menu_row->type;?>">
        <?php if($table_menu_row->trangthai == 'show')
        echo '<i class="fa fa-toggle-on text-success"></i>';
        else echo '<i class="fa fa-toggle-on text-danger"></i>'; ?> 
        <?= $table_menu_row->service;?>
       </a>
      </li>
     <?php endwhile; ?>
     </ul>
     </li>
     <?php endwhile; ?>    
     <style>.icon-img img{height:20px;background-position: center;background-repeat: no-repeat;background-size: cover;} </style>
   <?php if(!$username){ ?>
    <small class="mt-3 mb-3"><span class="fas fa-award"></span> Login - Sinup</small>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/dang-nhap">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon">
       <span class="fas fa-lock text-success"></span>
       </span>
       <span class="nav-link-text"> Đăng nhập hệ thống</span>
      </div>
     </a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/dang-ky">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon">
       <span class="fas fa-lock text-danger"></span>
       </span>
       <span class="nav-link-text"> Đăng ký hệ thống</span>
      </div>
     </a>
    </li>
    <?php } ?>
    <?php if($level == 'admin'){ ?>
    <small class="mt-3 mb-3"><span class="fas fa-award"></span> Cài đặt tài khoản </small>
    
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/thay-doi-thong-tin">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon">
       <span class="fas fa-user-circle"></span>
       </span>
       <span class="nav-link-text"> Thông tin tài khoản</span>
      </div>
     </a>
    </li>
     <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/nhat-ky-hoat-dong">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon">
        <span class="fas fa-life-ring"></span>
       </span>
       <span class="nav-link-text"> Nhật ký hoạt động </span>
      </div>
     </a>
     </li>
    <?php } ?>
     <small class="mt-3 mb-3"><span class="fas fa-award"></span> Phương thức nạp tiền</small>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/nap-the-auto">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon"><span class="fas fa-money-check"></span></span>
       <span class="nav-link-text"> Nạp thẻ cào (Auto)</span>
      </div>
     </a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/thesieure">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon"><span class="fas fa-piggy-bank"></span></span>
       <span class="nav-link-text"> Nạp thẻ siêu rẻ (Auto)</span>
      </div>
     </a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/bank">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon"><span class="fa fa-bank"></span></span>
       <span class="nav-link-text"> Nạp Bank (Auto)</span>
      </div>
     </a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/nap-the">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon"><span class="fas fa-money-check"></span></span>
       <span class="nav-link-text"> Nạp thẻ cào (Chậm)</span>
      </div>
     </a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/mo-mo">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon"><span class="fas fa-mobile-alt"></span></span>
       <span class="nav-link-text"> Nạp Momo (Auto)</span>
      </div>
     </a>
    </li>
    <small class="mt-3 mb-3"><span class="fas fa-award"></span> Hỗ trợ khách hàng</small>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/rut-tien">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon"><span class="fab fa-creative-commons-share"></span></span>
       <span class="nav-link-text"> Tạo yêu cầu rút tiền</span>
      </div>
     </a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/hop-thu-ho-tro">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon">
        <span class="fas fa-hands-helping"></span>
       </span>
       <span class="nav-link-text"> Yêu cầu hỗ trợ </span>
      </div>
     </a>
    </li>
    <small class="mt-3 mb-3">Khác</small>
    <?php if($username){ ?>
     <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/rut-tien">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon">
        <span class="fab fa-paypal"></span>
       </span>
       <span class="nav-link-text"> Rút tiền</span>
      </div>
     </a>
    </li>
    <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/chuyen-tien">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon"><span class="fa fa-send-o"></span></span>
       <span class="nav-link-text"> Chuyển tiền thành viên</span>
      </div>
     </a>
    </li>    
     <li class="nav-item">
     <a class="nav-link" href="<?= $domain_url ?>/dang-xuat">
      <div class="d-flex align-items-center">
       <span class="nav-link-icon">
        <span class="fas fa-sign-out-alt"></span>
       </span>
       <span class="nav-link-text"> Đăng xuất hệ thống </span>
      </div>
     </a>
    </li>    
    <?php } ?>
     <!--div class="settings px-3 px-xl-0">
      <div class="navbar-vertical-divider px-0"><hr class="navbar-vertical-hr my-3" /></div>
      <a class="btn btn-sm btn-block btn-purchase mb-3" href="#"> Tài liệu API</a>
     </div-->
    </li>
   </ul>
  </div>
 </div>
</nav>