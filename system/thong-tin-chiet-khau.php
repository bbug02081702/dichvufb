<div class="card d-none d-sm-block">
      <div class="card-body">
        <a href="#" class="search-toggle waves-effect d-flex align-items-center">
            <img src="<?= $image ? $image : $logo; ?>" style="border-radius:50px;width:69px;height:69px" class="img-fluid ml-2 mr-3" alt="user">
           <div class="caption">
            <h4 class="mb-0 line-height"> Hi, <?= $username ?>  </h4>
            <span class="font-size-16"><i class="fa fa-money"></i> <b style="color:red"><?= format_cash($vnd) ?></b> đ</span>
            <h5>Cấp độ: <b><?= $level_type; ?></b>
            - Giảm: <b><?= $chietkhau ? $chietkhau : 0; ?></b>%</h5>
           </div>
       </a> 
   </div>
</div>