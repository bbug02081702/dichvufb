<?php
include_once("../../config.php");
if(empty($username)) exit(header("Location: $WEBSITE_URL/dang-nhap"));
///////////////////////////////////////////
if(isset($_GET['select'])) $type = $_GET['select'];
$table_service_menu = $kunloc->query("SELECT * FROM `table_service_menu` WHERE `type` = '$type' ");
///////////////////////////////////////////
if($table_service_menu->num_rows != 1) exit('Vui lòng trở lại trang chủ');
///////////////////////////////////////////
$get_service = $table_service_menu->fetch_object();
$get_server = $kunloc->query("SELECT * FROM `table_service` WHERE `slug` = '".$get_service->slug."'")->fetch_object();
?>
<title><?= $get_service->service ?></title>
<?php include_once("../../main/head.php"); ?>
<link rel="stylesheet" href="../../button.css?<?= time() ?>">
<body>
<!-- Start wrapper-->
<main class="main" id="top">
<div class="container" data-layout="container">
<?php include_once('../../main/core/sidebar_menu.php'); ?>
<?php include_once('../../main/core/navbar.php'); ?>
<?php
function getStatusSv($type){
    if($type == 'Success') return '<b class="text-success">HOÀN THÀNH</b>';
    elseif($type == 'Active') return '<b class="text-primary">Đang chạy</b>';
    elseif($type == 'Cancel') return '<b class="text-warning">CANEL - HOÀN TIỀN</b>';
    elseif($type == 'Waiting') return '<b class="text-orange">ĐANG XỬ LÝ</b>';  
    else return '<b class="text-info">'.$type.'</b>';  
}
?>
<!--------- Content ------------->
<div class="row">
    <div class="col-lg-7">
        <div class="card">
         <div class="card-body">
           <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#pills-home-fill" role="tab" aria-controls="pills-home" aria-selected="true">Tạo tiến trình</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent-1">
            <div class="tab-pane fade show active" id="pills-home-fill" role="tabpanel" aria-labelledby="pills-home-tab-fill">
            <form id="form-service" action="javascript:void(0);" method="POST">
               <input type="hidden" class="form-control" value="<?= $type ?>" name="type" id="type" >
               <input type="hidden" class="form-control" value="<?= $accessToken ?>" name="token" id="token" >
               <div class="form-group row">
                  <label class="control-label col-sm-4 align-self-center mb-0"><b><i class="fas fa-book"></i> LINK/UID:</b></label>
                     <div class="col-sm-8">
                        <input type="text" class="btn-outline-success waves-effect form-control" name="uid" id="uid" placeholder="Nhập Link/UID Cần Tăng"  autofocus>
                       </div>
                </div>   
                <!-- FIND UD -->
                <div class="alert text-white aqua-gradient" role="alert">
                 <div class="alert-text"><i class="fas fa-search"></i>  Chưa biết id ?
                 <a target="_blank" class="text-white" href="https://findids.net/"><b>Click vào đây</b> </a>để lấy id facebook</div>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="ri-close-line"></i></button>
                </div>
                <!-- /./ -->
                <div class="form-group row">
                  <label class="control-label col-sm-12 align-self-center mb-3"><b>Chọn dịch vụ:</b></label>
                     <div class="col-sm-12">
                        <!--div class="quote card-body text-white blue-gradient mt-1 mb-4" style="border-bottom-left-radius:0rem;border-top-right-radius:1rem;;border-top-left-radius:1rem;border-bottom-right-radius:1rem">
                        <div id="data-mota"><center><i class='fa fa-4x fa-spinner fa-spin'></i></center></div>
                        </div-->
                        <?php $table_service_server = $kunloc->query("SELECT * FROM `table_service_server` WHERE `slug` = '$type' ORDER BY id ASC");
                        while ($row = $table_service_server->fetch_object()): 
                        
                        $gia = PriceDichvu($level,$row->price_default,$row->price_ctv,$row->price_daily);
                        
                        ?>
                        <div class="form-group">
                        <div class="radio p-0 d-flex">
                            <input type="radio" name="option" onchange="Thanhtoan();" id="option_<?= $row->id;?>" value="<?= $row->id;?>" data-price="<?= $gia;?>" />
                            <label class="ml-2 mt-0" for="option_<?= $row->id;?>">
                               <small><?= $row->server;?></small> - <span class="text-warning text-center font-weight-bold ml-1 mr-1"><?= $gia ?>đ</span>-
                               <?= Status_option($row->trangthai) ?>
                            </label>
                        </div>
                     </div>
                     
                     <?php endwhile; ?>   
                     <?php function Status_option($i){
                        if($i == 'show') return '<b class="text-success">Hoạt động</b>';
                        else if($i == 'hide') return '<b class="text-danger">Bảo trì</b>';
                        else return '<b class="text-info">'.$i.'</b>';
                     }
                     function PriceDichvu($i,$gia1,$gia2,$gia3){
                        if($i == 'ctv') return $gia2;
                        else if($i == 'daily') return $gia3;
                        else return $gia1;
                     }
                     ?>
                     <input type="hidden" class="form-control form-control-alternative" id="loai" name="loai">
                    </select>
                   </div>
                </div>
                <script>
                 $(document).ready(function(){
                    getMota()
                    $("#amount").keyup(function(){
                       Tinhtien()
                    })
                  })
                    function getMota() {
                        var loai = $("#loai").val();
                        $.post(WEBSITE_URL + "core/order/setting.php", { type: "GETCONTENT", id: loai }, function (data) {
                            Data = JSON.parse(data);
                            $("#data-mota").html(Data.mota);
                        });
                    }
                    
                    function Thanhtoan() {
                        getMota();
                        Tinhtien();
                        $("#loai").val($("input:radio[name=option]:checked").val());
                    }
                    function Tinhtien() {
                        var amount = $("#amount").val();
                        var loai = $("input:radio[name=option]:checked").attr("data-price");
                        if (loai == "undefined" || !loai) {
                            $("#amount").val("");
                            return toarst("error", "Bạn chưa chọn dịch vụ", "");
                        }
                        if (amount >= 1) {
                            chietkhau = <?= $chietkhau ? $chietkhau : 0; ?>;
                            giatien = loai * amount;
                            total = giatien - (giatien * chietkhau) / 100;
                            htmls = '<b>Bạn đa chọn mua: <?= $get_service->service ? $get_service->service : ''; ?> với <h4 class="text-warning bold">' + amount.toString().replace(/(.)(?=(\d{3})+$)/g, "$1,") + ' <h class="text-white">Lượt</h></h4></b>\n';
                            htmls += '<b>Chiết khẩu của bạn: <h class="text-warning bold">' + chietkhau + "%</h></b><br>\n";
                            htmls += '<b>Giá gốc: <h class="text-warning bold">' + giatien.toString().replace(/(.)(?=(\d{3})+$)/g, "$1,") + "đ</h></b><br>\n";
                            htmls += "<b>Số tiền cần thanh toán là:\n";
                            htmls += '<h class="text-warning bold">' + total.toString().replace(/(.)(?=(\d{3})+$)/g, "$1,") + ' <h class="text-white">VND</h></h></b> \n';
                            $("#tongthanhtoan").html(htmls);
                        }
                    }
                    $("#form-service").submit(function (event) {
                        $.ajax({
                            url: WEBSITE_URL + "order",
                            data: $(this).serialize(),
                            method: "POST",
                            beforeSend: function () {
                                Disabled('form-service',true)
                                $("#submit").prop("disabled", true).html("Đang xử lý");
                            },
                            complete: function () {
                                Disabled('form-service',false)
                                $("#submit").prop("disabled", false).html('<i class="fa fa-shopping-cart"></i> THANH TOÁN');
                            },
                            success: function (data) {
                                Data = JSON.parse(data);
                                if (Data.reload)
                                    setTimeout(() => {
                                        location.reload();
                                    }, Data.time);
                                //toarst(Data.type,Data.text,Data.title);
                                Swal.fire(Data.title, Data.text, Data.type);
                            },
                            error: function (data) {
                                Swal.fire("Thất bại", "Có lỗi khi thao tác", "error");
                            },
                        });
                    });
                </script>
                <div class="form-group row">
                  <label class="control-label col-sm-2 align-self-center mb-0"><b>Số lượng Cần Tăng:</b></label>
                     <div class="col-sm-10">
                        <input type="text" class="btn-outline-secondary waves-effect form-control" keyup="Thanhtoan();" name="amount" id="amount" placeholder="Nhập số lượng Cần Tăng" >
                      </div>
                </div>  
               <!-- /./ -->
                <div class="form-group row">
                  <label class="control-label col-sm-2 align-self-center mb-0"><b>Ghi chú hoặc tên người mua:</b></label>
                     <div class="col-sm-10">
                     <input type="text" class="btn-outline-primary waves-effect form-control" name="note_user" id="note_user" placeholder="Ghi chú khách hàng" >
                      </div>
                </div>   
                <div class="col-md-13 text-center">
                  <div class="form-group">
                      <button class="btn btn-block blue-gradient btn-outline- waves-effect">
                            <h4 id="tongthanhtoan" class=" text-white"><i class="fa fa-spinner fa-spin"></i></h4>
                        </button>
                  </div>
                </div>
                <div class="col-md-13 text-center">
                  <div class="form-group">
                     <button type="submit" name="submit" id="submit" class="btn btn-floating btn-lg btn-block purple-gradient waves-effect waves-light text-white"><i class="fa fa-shopping-cart"></i> THANH TOÁN</button>
                  </div>
                </div>  
         <!-- /./ -->   
         </form>
         </div>
         
            </div>
        </div>
    </div>
 </div>
<div class="col-lg-5">
    <?php include("../../system/thong-tin-chiet-khau.php"); ?>
    <div class="card">
    <div class="col-md-13 text-left">
        <h4 class='m-3 text-center'>Tích hợp API</h4>
        <p class='text-center'>Mẫu GET: <b class="text-success"><?= $WEBSITE_URL ?>/orders?token=<code><?= $accessToken ?></code>&type=<?= $type ?>&uid=10000000&loai=1&amount=100& note_user=</b></p>
         <p class='text-center'>Mẫu POST: 
         <b class="text-success"><?= $WEBSITE_URL ?>/order</b><br>
         Formdata: <b class="text-success">{"token":"<code><?= $accessToken ?></code>","type":"<?= $type ?>","uid":10000000,"loai":1,"amount":100,"note_user":""}</b>
        </p>
          <div class="form-group table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <th>URL</th>
                    <th>FIELD</th>
                    <th>METHOD</th>
                    <th>TOKEN</th>
                </thead>
                <tbody>
                    <tr>
                        <td><code><?= $WEBSITE_URL ?>/orders</code></td>
                        <td>
                            <code>type</code> Server cần tăng<br />
                            <code>uid</code> URL/LINK/UID cần tăng<br />
                            <code>loai</code> Loại cần tăng (sv1 là 1,sv2 là 2)<br />
                            <code>amount</code> Số lượng<br />
                            <code>note_user</code> Ghi chú<br />
                        </td>
                        <td><code>POST, GET</code></td>
                        <td><code><?= $accessToken ?></code></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class='text-center'>API GET ORDER: <b class="text-success"><?= $WEBSITE_URL ?>/list?token=<code><?= $accessToken ?></code></b></p>
         
        </div> 
   </div>
   <h4 class="mb-1 d-none font-weight-bold text-uppercase" style="color:#350b9c">Chú Ý</h4>
   <div class="card d-none blue-gradient" style="background:orange;color:#fff">
                <div class="alert text-white font-weight-bold" style="border: solid 0px green;" role="alert">
                   <div class="alert-text text-white text-center">
                       <?= $get_server->ghichu ?>
                    </div>
             </div>
        </div>
    </div>

<div class="col-lg-12">
<div class="card">
         <div class="card-header d-flex justify-content-between">
               <div class="header-title"><h4 class="card-title">Danh sách đơn hàng</h4></div></div>
               <div class="card-body">
                  <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab-1" role="tablist">
                    <li class="nav-item">
                     <a class="nav-link active" data-toggle="pill" href="#tab-fail" role="tab" aria-controls="tab-fail" aria-selected="false">
                         <span class="badge badge-warning">
                             <?php echo getOrder('Waiting'); ?> </span> Đang xử lý</a>
                   </li>
                    <li class="nav-item">
                     <a class="nav-link" data-toggle="pill" href="#tab-run" role="tab" aria-controls="tab-run" aria-selected="false">
                         <span class="badge badge-success">
                             <?php echo getOrder('Active'); ?> </span> ĐANG CHẠY</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" data-toggle="pill" href="#tab-back" role="tab" aria-controls="order-cancel" aria-selected="false">
                         <span class="badge badge-info">
                             <?php echo getOrder('Cancel'); ?></span> Cancel</a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" data-toggle="pill" href="#tab-done" role="tab" aria-controls="tab-done" aria-selected="false">
                         <span class="badge badge-success">
                             <?php echo getOrder('Success'); ?></span> Hoàn Thành</a>
                   </li>
               </ul>
              <?php  
              function getOrder($status){
                  global $username,$level,$kunloc,$type;
                  if($level == 'admin') $total = $kunloc->query("SELECT id FROM `table_bill` WHERE `trangthai` = '$status' AND `slug` = '$type'");
                  else $total = $kunloc->query("SELECT id FROM `table_bill` WHERE `trangthai` = '$status' AND `slug` = '$type'  AND by_user = '$username'");
                  if($total->num_rows > 0) return $total->num_rows;
                  else return 0;
              }
              ?>
         <div class="tab-content" id="pills-tabContent-1">
         <div class="tab-pane fade show active" id="tab-fail" role="tabpanel" aria-labelledby="tab-fail">
           <?php include_once("table/Waiting.php"); ?>  
          <!-- /./ -->
          </div>
          <!-- /./ -->
         <div class="tab-pane fade" id="tab-run" role="tabpanel" aria-labelledby="tab-run">
           <?php include_once("table/Active.php"); ?> 
          </div>
           <!-- /./ -->
          <div class="tab-pane fade" id="tab-back" role="tabpanel" aria-labelledby="tab-back">
           <?php include_once("table/Cancel.php"); ?>  
         </div>
         <!-- /./ -->   
         <div class="tab-pane fade" id="tab-done" role="tabpanel" aria-labelledby="tab-done">
            <?php include_once("table/Success.php"); ?> 
         </div>
         <!--/./-->         
         </div>
         
       </div>
    </div>
 </div>
</div> 

</div>
</main>
<!-- end card 1 -->
<?php include_once("../../main/foot.php"); ?>