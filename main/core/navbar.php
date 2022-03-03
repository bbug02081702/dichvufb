<div class="content">
     <nav class="navbar navbar-light navbar-glass navbar-top sticky-kit navbar-expand-lg navbar-top-combo" data-move-target="#navbarVerticalNav">
      <button class="btn navbar-toggler-humburger-icon navbar-toggler mr-1 mr-sm-3"type="button"data-toggle="collapse"data-target="#navbarVerticalCollapse"aria-controls="navbarVerticalCollapse"aria-expanded="false"aria-label="Toggle Navigation">
       <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
      </button>
      <a class="navbar-brand mr-1 mr-sm-3" href="index.php">
       <div class="d-flex align-items-center">
        <img class="rounded-circle  mr-2" src="<?= $logo ?>"  height="30"  width="30"  onload="pagespeed.CriticalImages.checkImageForCriticality(this);" />
        <!-- <?= $WEBSITE_URL ?>/assets/img/illustrations/falcon.png ?-->
        <span class="font-sans-serif"><?= $domain_name ?></span>
       </div>
      </a>
      <ul class="navbar-nav navbar-nav-icons ml-auto flex-row align-items-center">
       <li class="nav-item dropdown dropdown-on-hover">
        <a class="nav-link notification-indicator notification-indicator-primary px-0 icon-indicator" id="navbarDropdownNotification" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="fas fa-bell fs-4" data-fa-transform="shrink-6"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-card" aria-labelledby="navbarDropdownNotification">
         <div class="card card-notification shadow-none page_speed">
          <div class="card-header">
           <div class="row justify-content-between align-items-center">
            <div class="col-auto"><h6 class="card-header-title mb-0">Thông báo</h6></div>
            <div class="col-auto"><a class="card-link font-weight-normal" href="#">Xem tất cả</a></div>
           </div>
          </div>
          <div class="list-group list-group-flush font-weight-normal fs--1">
           <div class="list-group-item">
            <a class="notification notification-flush bg-200" href="#!">
             <div class="notification-avatar">
              <div class="avatar avatar-2xl mr-3">
               <img class="rounded-circle" src="/assets/img/illustrations/falcon.png" height="50"  width="50" onload="pagespeed.CriticalImages.checkImageForCriticality(this);" />
              </div>
             </div>
             <div class="notification-body">
              <p class="mb-1"><strong>Chúc bạn sử dụng dịch vụ vui vẻ</strong></p>
              <span class="notification-time"><span class="mr-1" role="img" aria-label="Emoji">💬</span>Admin</span>
             </div>
            </a>
           </div>
          </div>
          <div class="card-footer text-center border-top"><a class="card-link d-block" href="#">Xem tất cả</a></div>
         </div>
        </div>
       </li>
       <li class="nav-item dropdown dropdown-on-hover">
        <a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <div class="avatar avatar-xl">
          <img class="rounded-circle"src="<?= $logo ?>"/>
         </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
         <div class="bg-white rounded-soft py-2">
          <?php if($username){ ?> 
          <a class="dropdown-item" href="<?= $WEBSITE_URL ?>/thay-doi-thong-tin">Thông tin tài khoản</a>
          <a class="dropdown-item" href="<?= $WEBSITE_URL ?>/thay-doi-mat-khau">Đổi mật khẩu</a>
          <a class="dropdown-item" href="<?= $WEBSITE_URL ?>/thesieure">Nạp TSR</a>
          <a class="dropdown-item" href="<?= $WEBSITE_URL ?>/mo-mo">Nạp MOMO</a>
          <a class="dropdown-item" href="<?= $WEBSITE_URL ?>/bank">Nạp ATM</a>
          <a class="dropdown-item" href="<?= $WEBSITE_URL ?>/dang-xuat">Đăng xuất</a>
          <?php }else{ ?> 
          <a class="dropdown-item" href="<?= $WEBSITE_URL ?>/dang-nhap">Đăng nhập</a>
          <a class="dropdown-item" href="<?= $WEBSITE_URL ?>/dang-ky">Đăng kí</a>
          <?php } ?> 
         </div>
        </div>
       </li>
      </ul>
     </nav>
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
       <li class="breadcrumb-item font-sans-serif">
        <a href="/">
         <strong>
          <svg class="svg-inline--fa fa-globe fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="globe" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
           <path fill="currentColor"d="M336.5 160C322 70.7 287.8 8 248 8s-74 62.7-88.5 152h177zM152 256c0 22.2 1.2 43.5 3.3 64h185.3c2.1-20.5 3.3-41.8 3.3-64s-1.2-43.5-3.3-64H155.3c-2.1 20.5-3.3 41.8-3.3 64zm324.7-96c-28.6-67.9-86.5-120.4-158-141.6 24.4 33.8 41.2 84.7 50 141.6h108zM177.2 18.4C105.8 39.6 47.8 92.1 19.3 160h108c8.7-56.9 25.5-107.8 49.9-141.6zM487.4 192H372.7c2.1 21 3.3 42.5 3.3 64s-1.2 43-3.3 64h114.6c5.5-20.5 8.6-41.8 8.6-64s-3.1-43.5-8.5-64zM120 256c0-21.5 1.2-43 3.3-64H8.6C3.2 212.5 0 233.8 0 256s3.2 43.5 8.6 64h114.6c-2-21-3.2-42.5-3.2-64zm39.5 96c14.5 89.3 48.7 152 88.5 152s74-62.7 88.5-152h-177zm159.3 141.6c71.4-21.2 129.4-73.7 158-141.6h-108c-8.8 56.9-25.6 107.8-50 141.6zM19.3 352c28.6 67.9 86.5 120.4 158 141.6-24.4-33.8-41.2-84.7-50-141.6h-108z"></path>
          </svg>
          <?= $_SERVER['HTTP_HOST'] ?>
         </strong>
        </a>
       </li>
       <!--li class="breadcrumb-item font-sans-serif active" aria-current="page">
        <svg class="svg-inline--fa fa-link fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="link" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
         <pathfill="currentColor"d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z"></path>
        </svg>
        <?= $_SERVER['REQUEST_URI']; ?>
       </li-->
      </ol>
     </nav>
   