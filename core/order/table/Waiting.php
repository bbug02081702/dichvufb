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
               if($level == 'admin') $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE `trangthai` = 'Waiting' AND `slug` = '$type' ORDER BY id ASC");
               else $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE `trangthai` = 'Waiting' AND `by_user` = '$username' AND `slug` = '$type' ORDER BY id ASC");
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