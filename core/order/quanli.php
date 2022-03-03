<?php
function getStatusSv($type){
    if($type == 'Success') return '<b class="text-success">HOÀN THÀNH</b>';
    elseif($type == 'Active') return '<b class="text-primary">Đang chạy</b>';
    elseif($type == 'Cancel') return '<b class="text-warning">CANEL - HOÀN TIỀN</b>';
    elseif($type == 'Waiting') return '<b class="text-info">ĐANG XỬ LÝ</b>';  
    else return '<b class="text-info">'.$type.'</b>';  
}
?>
<div class="col-lg-13">
<div class="card">
         <div class="card-body">
             <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab-1" role="tablist">
                    <li class="nav-item">
                     <a class="nav-link active" data-toggle="pill" href="#order-fail" role="tab" aria-controls="order-fail" aria-selected="false">
                         <span class="badge badge-warning">
                             <?php echo getOrder('Waiting'); ?> </span> Đang xử lý</a>
                   </li>
                    <li class="nav-item">
                     <a class="nav-link" data-toggle="pill" href="#order-run" role="tab" aria-controls="order-run" aria-selected="false">
                         <span class="badge badge-success">
                             <?php echo getOrder('Active'); ?> </span> ĐANG CHẠY</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" data-toggle="pill" href="#order-back" role="tab" aria-controls="order-cancel" aria-selected="false">
                         <span class="badge badge-info">
                             <?php echo getOrder('Cancel'); ?></span> Cancel</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" data-toggle="pill" href="#order-done" role="tab" aria-controls="order-done" aria-selected="false">
                         <span class="badge badge-success">
                             <?php echo getOrder('Success'); ?></span> Hoàn Thành</a>
                   </li>
               </ul>
              <?php  
              function getOrder($i){
                  global $username,$level,$kunloc,$type;
                  if($level == 'admin') return $kunloc->query("SELECT id FROM `table_bill` WHERE `trangthai` = '$i'")->num_rows;
                  else return $kunloc->query("SELECT id FROM `table_bill` WHERE `trangthai` = '$i' AND by_user = '$username'")->num_rows;
              }
              ?>
            <div class="tab-content" id="pills-tabContent-1">
            <div class="tab-pane fade show active" id="order-fail" role="tabpanel" aria-labelledby="order-fail">
                <!-- ORDER -->
            <div class="table-responsive">
            <table id="Waiting" class="table table-bordered table-hover">
                <thead class="">
                    <tr>
                    <th scope="col">#</th>
                    <?php if($level == 'admin'): ?>
                    <th scope="col">Thao tác</th>
                     <?php endif; ?>
                    <th scope="col">TRẠNG THÁI</th>
                    <th scope="col">Thông tin đơn hàng</th>
                    <th scope="col">Số tiền thanh toán</th>
                    <th scope="col">Ban Đầu</th>
                    <th scope="col">Đã Chạy</th>
                    <th scope="col">LINK/URL/UID</th>
                    <th scope="col">NGÀY TẠO</th>
                  </tr>
               </thead>
               <?php
               if($level == 'admin') $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE `trangthai` = 'Waiting' ORDER BY id ASC");
               else $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE `trangthai` = 'Waiting' AND `by_user` = '$username' ORDER BY id ASC");
               while($row = $table_bill->fetch_object()): ?>
                  <tr Waiting="<?= $row->id; ?>">
                    <td><?= $row->id; ?></td>
                    <?php if($level == 'admin'): ?>
                    <td>
                    <span type="button" Active="Waiting<?= $row->id ?>" onclick="Active(<?= $row->id ?>,'Waiting')" class="badge badge-info m-1" data-toggle="tooltip" title="Xác nhận chạy gói"><i class="fas fa-x fa-toggle-on"></i></span>
                    <span type="button" Cancel="Waiting<?= $row->id ?>" onclick="Cancel(<?= $row->id ?>,'Waiting')" class="badge badge-primary m-1" data-toggle="tooltip" title="Hoàn tiền (Khi nhấn vào sẽ được hoàn tiền 100% gói)"><i class="fas fa-x fa-toggle-off"></i></span>
                    <span type="button" Delete="Waiting<?= $row->id ?>" onclick="Delete(<?= $row->id ?>,'Waiting')" class="badge badge-danger m-1" data-toggle="tooltip" title="Xóa đơn hàng này"><i class="fas fa-trash-alt"></i></span>
                    </td>
                    <?php endif; ?>
                    <td><?= getStatusSv($row->trangthai) ?> </td>
                    <td>- Gói: <b class="text-success"><?= $row->service;?></b></span><br>
                    - Người đặt hàng: <?= $row->by_user;?><br>
                    - Mã đơn hàng: #<?= $row->TrixID;?><br>
                    </td>
                    <td>- Số tiền: <b style="color:red;"><?= format_cash($row->price);?></b> Đ<br>
                    - Số lượng đặt: <b style="color:red;"><?= format_cash($row->amount);?></b> Lượt
                    </td>
                    <td><b Amount_start="Waiting<?= $row->id ?>"  style="color:green;"><?= format_cash($row->amount_start);?> </b></td>
                    <td><b Amount_success="Waiting<?= $row->id ?>"  style="color:orange;"><?= format_cash($row->amount_success);?> </b></td>
                    <td><textarea class="form-control" rows="1" readonly col="50"><?= $row->uid; ?></textarea>
                    - Ghi chú người mua: <small><?= $row->note_user;?></small><br>
                    - Ghi chú ADMIN: <small class="text-danger" Note_admin="Waiting<?= $row->id ?>"><?= $row->note_admin;?></small>
                    </td>
                    <td>Được tạo lúc: <?= date("H:i d-m-Y",$row->created_at); ?></td>
                  </tr> 
                 <?php endwhile; ?>
            </table>
            <script>jQuery(document).ready(function() { Tables('Waiting',10,'desc'); }) </script>
         </div>
        <!-- /./ -->
         </div>
         <div class="tab-pane fade" id="order-back" role="tabpanel" aria-labelledby="order-back">
            <!-- ORDER -->
            <div class="table-responsive">
            <table id="Cancel" class="table table-bordered table-hover">
                <thead class="">
                    <tr>
                    <th scope="col">#</th>
                    <?php if($level == 'admin'): ?>
                    <th scope="col">Thao tác</th>
                     <?php endif; ?>
                    <th scope="col">TRẠNG THÁI</th>
                    <th scope="col">Thông tin đơn hàng</th>
                    <th scope="col">Số tiền thanh toán</th>
                    <th scope="col">Ban Đầu</th>
                    <th scope="col">Đã Chạy</th>
                    <th scope="col">LINK/URL/UID</th>
                    <th scope="col">NGÀY TẠO</th>
                  </tr>
               </thead>
               <?php
               if($level == 'admin') $orders = $kunloc->query("SELECT * FROM `table_bill` WHERE `trangthai` = 'Cancel' ORDER BY id ASC");
               else $orders = $kunloc->query("SELECT * FROM `table_bill` WHERE `trangthai` = 'Cancel' AND `by_user` = '$username' ORDER BY id ASC");
               while($row = $orders->fetch_object()): ?>
                  <tr Cancel="<?= $row->id; ?>">
                    <td><?= $row->id; ?></td>
                    <?php if($level == 'admin'): ?>
                    <td>
                    <span type="button" Delete="Cancel<?= $row->id ?>" onclick="Delete(<?= $row->id ?>,'Cancel')" class="badge badge-danger m-1" data-toggle="tooltip" title="Xóa đơn hàng này"><i class="fas fa-trash-alt"></i></span>
                    </td>
                    <?php endif; ?>
                    <td><?= getStatusSv($row->trangthai) ?> </td>
                    <td>- Gói: <b class="text-success"><?= $row->service;?></b></span><br>
                    - Người đặt hàng: <?= $row->by_user;?><br>
                    - Mã đơn hàng: #<?= $row->TrixID;?><br>
                    </td>
                    <td>- Số tiền: <b style="color:red;"><?= format_cash($row->price);?></b> Đ<br>
                    - Số lượng đặt: <b style="color:red;"><?= format_cash($row->amount);?></b> Lượt
                    </td>
                    <td><b Amount_start="Cancel<?= $row->id ?>"  style="color:green;"><?= format_cash($row->amount_start);?> </b></td>
                    <td><b Amount_success="Cancel<?= $row->id ?>"  style="color:orange;"><?= format_cash($row->amount_success);?> </b></td>
                    <td><textarea class="form-control" rows="1" readonly col="50"><?= $row->uid; ?></textarea>
                    - Ghi chú người mua: <small><?= $row->note_user;?></small><br>
                    - Ghi chú ADMIN: <small class="text-danger" Note_admin="Cancel<?= $row->id ?>"><?= $row->note_admin;?></small>
                    </td>
                    <td>Được tạo lúc: <?= date("H:i d-m-Y",$row->created_at); ?></td>
                  </tr> 
                 <?php endwhile; ?>
            </table>
            <script>jQuery(document).ready(function() { Tables('Cancel',10,'desc'); }) </script>
         </div>
         </div>
         <div class="tab-pane fade" id="order-run" role="tabpanel" aria-labelledby="order-run">
           <!-- ORDER -->
            <div class="table-responsive">
            <table id="Active" class="table table-bordered table-hover">
                <thead class="">
                    <tr>
                    <th scope="col">#</th>
                    <?php if($level == 'admin'): ?>
                    <th scope="col">Thao tác</th>
                     <?php endif; ?>
                    <th scope="col">TRẠNG THÁI</th>
                    <th scope="col">Thông tin đơn hàng</th>
                    <th scope="col">Số tiền thanh toán</th>
                    <th scope="col">Ban Đầu</th>
                    <th scope="col">Đã Chạy</th>
                    <th scope="col">LINK/URL/UID</th>
                    <th scope="col">NGÀY TẠO</th>
                  </tr>
               </thead>
               <?php
               if($level == 'admin') $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE `trangthai` = 'Active'  ORDER BY id ASC");
               else $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE `trangthai` = 'Active' AND `by_user` = '$username' ORDER BY id ASC");
               while($row = $table_bill->fetch_object()): ?>
                  <tr Active="<?= $row->id; ?>">
                    <td><?= $row->id; ?></td>
                    <?php if($level == 'admin'): ?>
                    <td>
                    <span type="button" Success="Active<?= $row->id ?>" onclick="Success(<?= $row->id ?>,'Active')" class="badge badge-success m-1" data-toggle="tooltip" title="Đã hoàn thanh đơn hàng"><i class="fas fa-x fa-check"></i></span>
                    <span type="button" Amount_start="Active<?= $row->id ?>" onclick="Amount_start(<?= $row->id ?>,'Active')" class="badge badge-info m-1" data-toggle="tooltip" title="Sửa ban đầu"><i class="fas fa-x fa-edit"></i></span>
                    <span type="button" Amount_success="Active<?= $row->id ?>" onclick="Amount_success(<?= $row->id ?>,'Active')" class="badge badge-warning m-1" data-toggle="tooltip" title="Sửa đã chạy"><i class="fas fa-x fa-edit"></i></span>
                    <span type="button" Note_admin="Active<?= $row->id ?>" onclick="Note_admin(<?= $row->id ?>,'Active')" class="badge badge-secondary m-1" data-toggle="tooltip" title="Thêm ghi chú admin"><i class="fas fa-x fa-edit"></i></span>
                    <span type="button" Active="Active<?= $row->id ?>" onclick="Active(<?= $row->id ?>,'Active')" class="badge badge-info m-1" data-toggle="tooltip" title="Xác nhận chạy gói"><i class="fas fa-x fa-toggle-on"></i></span>
                    <span type="button" Cancel="Active<?= $row->id ?>" onclick="Cancel(<?= $row->id ?>,'Active')" class="badge badge-primary m-1" data-toggle="tooltip" title="Hoàn tiền (Khi nhấn vào sẽ được hoàn tiền 100% gói)"><i class="fas fa-x fa-toggle-off"></i></span>
                    <span type="button" Delete="Active<?= $row->id ?>" onclick="Delete(<?= $row->id ?>,'Active')" class="badge badge-danger m-1" data-toggle="tooltip" title="Xóa đơn hàng này"><i class="fas fa-trash-alt"></i></span>
                    </td>
                    <?php endif; ?>
                    <td><?= getStatusSv($row->trangthai) ?> </td>
                    <td>- Gói: <b class="text-success"><?= $row->service;?></b></span><br>
                    - Người đặt hàng: <?= $row->by_user;?><br>
                    - Mã đơn hàng: #<?= $row->TrixID;?><br>
                    </td>
                    <td>- Số tiền: <b style="color:red;"><?= format_cash($row->price);?></b> Đ<br>
                    - Số lượng đặt: <b style="color:red;"><?= format_cash($row->amount);?></b> Lượt
                    </td>
                    <td><b Amount_start="Active<?= $row->id ?>"  style="color:green;"><?= format_cash($row->amount_start);?> </b></td>
                    <td><b Amount_success="Active<?= $row->id ?>"  style="color:orange;"><?= format_cash($row->amount_success);?> </b></td>
                    <td><textarea class="form-control" rows="1" readonly col="50"><?= $row->uid; ?></textarea>
                    - Ghi chú người mua: <small><?= $row->note_user;?></small><br>
                    - Ghi chú ADMIN: <small class="text-danger" Note_admin="Active<?= $row->id ?>"><?= $row->note_admin;?></small>
                    </td>
                    <td>Được tạo lúc: <?= date("H:i d-m-Y",$row->created_at); ?></td>
                  </tr> 
                 <?php endwhile; ?>
            </table>
            <script>jQuery(document).ready(function() { Tables('Active',10,'desc'); }) </script>
            </div>
          </div>
         <!-- /./ -->   
         <div class="tab-pane fade" id="order-done" role="tabpanel" aria-labelledby="order-done">
           <!-- ORDER -->
            <div class="table-responsive">
            <table id="Success" class="table table-bordered table-hover">
                <thead class="">
                    <tr>
                    <th scope="col">#</th>
                    <?php if($level == 'admin'): ?>
                    <th scope="col">Thao tác</th>
                     <?php endif; ?>
                    <th scope="col">TRẠNG THÁI</th>
                    <th scope="col">Thông tin đơn hàng</th>
                    <th scope="col">Số tiền thanh toán</th>
                    <th scope="col">Ban Đầu</th>
                    <th scope="col">Đã Chạy</th>
                    <th scope="col">LINK/URL/UID</th>
                    <th scope="col">NGÀY TẠO</th>
                  </tr>
               </thead>
               <?php
               if($level == 'admin') $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE `trangthai` = 'Success' ORDER BY id ASC");
               else $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE `trangthai` = 'Success' AND `by_user` = '$username' ORDER BY id ASC");
               while($row = $table_bill->fetch_object()): ?>
                  <tr Success="<?= $row->id; ?>">
                    <td><?= $row->id; ?></td>
                    <?php if($level == 'admin'): ?>
                    <td>
                    <span type="button" Delete="Success<?= $row->id ?>" onclick="Delete(<?= $row->id ?>,'Success')" class="badge badge-danger m-1" data-toggle="tooltip" title="Xóa đơn hàng này"><i class="fas fa-trash-alt"></i></span>
                    </td>
                    <?php endif; ?>
                    <td><?= getStatusSv($row->trangthai) ?> </td>
                    <td>- Gói: <b class="text-success"><?= $row->service;?></b></span><br>
                    - Người đặt hàng: <?= $row->by_user;?><br>
                    - Mã đơn hàng: #<?= $row->TrixID;?><br>
                    </td>
                    <td>- Số tiền: <b style="color:red;"><?= format_cash($row->price);?></b> Đ<br>
                    - Số lượng đặt: <b style="color:red;"><?= format_cash($row->amount);?></b> Lượt
                    </td>
                    <td><b Amount_start="Success<?= $row->id ?>"  style="color:green;"><?= format_cash($row->amount_start);?> </b></td>
                    <td><b Amount_success="Success<?= $row->id ?>"  style="color:orange;"><?= format_cash($row->amount_success);?> </b></td>
                    <td><textarea class="form-control" rows="1" readonly col="50"><?= $row->uid; ?></textarea>
                    - Ghi chú người mua: <small><?= $row->note_user;?></small><br>
                    - Ghi chú ADMIN: <small class="text-danger" Note_admin="Success<?= $row->id ?>"><?= $row->note_admin;?></small>
                    </td>
                    <td>Được tạo lúc: <?= date("H:i d-m-Y",$row->created_at); ?></td>
                  </tr> 
                 <?php endwhile; ?>
            </table>
            <script>jQuery(document).ready(function() { Tables('Success',10,'desc'); }) </script>
         </div>
         </div>
          <!--/./-->         
         </div>
         
         
        </div>
    </div>
 </div>
</div> 
</div>