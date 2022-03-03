<div class="row">
<div class="col-lg-12">
   <div class="card">
   <div class="card-header d-flex h5">Thông kê dòng tiền</div>
   <div class="card-body">
        <!--- /./ -->
        <div class="table-responsive">
         <table id="table1" class="table table-striped table-bordered nowrap scroll-horizontal-vertical">
               <thead>
                  <tr>
                      <th style="width:10px" scope="col">ID</th>
                      <th scope="col">Ban đầu</th>
                      <th scope="col">Đã chi/Đã cộng</th>
                      <th scope="col">Sô dư thực nhận</th>
                      <th scope="col">Hoạt động</th>
                      <th style="width:30px">Người thực thi</th>
                      <th scope="col">Ngày</th>
                  </tr>
               <tbody>
                   <?php
                   if($level == 'admin') $table_chi_tieu = $kunloc->query("SELECT * FROM `table_chi_tieu` ");
                   else $table_chi_tieu = $kunloc->query("SELECT * FROM `table_chi_tieu` WHERE username = '$username'");  
                   while ($echo =  $table_chi_tieu->fetch_object()): ?>
                    <tr>
                        <td><?= $echo->id ?></td>
                        <td><h6><span class="counter text-danger font-weight-"><?= format_cash($echo->price_default) ?></span></h6></td>
                        <td><h6><span class="counter text-danger font-weight-"><?= format_cash($echo->price_change) ?></span></h6></td>
                        <td><h6><span class="counter text-danger font-weight-"><?= format_cash($echo->price_present) ?></span></h6></td>
                        <td><small><?= $echo->message ?></small></td>
                        <td><?= $echo->username ?></td>
                        <td><?= date("d/m/Y", $echo->created_at); ?></td>
                    </tr>
                    <?php endwhile; ?>
               </tbody>
               </thead>
            </table>
         </div>
      </div>
<!-- /./ -->
</div>
</div> 
<script type="text/javascript">jQuery(document).ready(function() {Tables('table1',6,'desc')})</script>
<div class="col-lg-12">
   <div class="card">
   <div class="card-header d-flex h5">Hoạt Động Tài Khoản</div>
   <div class="card-body">
        <!--- /./ -->
        <div class="table-responsive">
         <table id="table" class="table table-striped table-bordered nowrap scroll-horizontal-vertical">
               <thead>
                  <tr>
                      <th style="width:10px" scope="col">ID</th>
                      <th style="width:30px">Người thực thi</th>
                      <th scope="col">Nội dung</th>
                      <th scope="col">Loại</th>
                      <th scope="col">Ngày</th>
                  </tr>
               <tbody>
                   <?php
                   if($level == 'admin') $table_history = $kunloc->query("SELECT * FROM `table_history`");
                   else $table_history = $kunloc->query("SELECT * FROM `table_history` WHERE username = '$username'");  
                   while ($echo =  $table_history->fetch_object()): ?>
                    <tr>
                    <td><?= $echo->id ?></td>
                    <td><?= $echo->username ?></td>
                    <td><small class=""><?= $echo->message ?></small></td>
                    <td><b><?= $echo->type ?></b></td>
                    <td><?= date("d/m/Y",$echo->created_at); ?></td>
                    </tr>
                    <?php endwhile; ?>
               </tbody>
               </thead>
            </table>
         </div>
      </div>
<!-- /./ -->
</div>
</div> 
<!-- ROW -->
</div> 
<script>jQuery(document).ready(function() {Tables('table',10,'desc')})</script>