<?php
	 session_start();
     require_once("../../../config.php");
     if($_GET) $_POST= $_GET;
     if(isset($_POST['type']) == 'replay' && isset($_POST['TrixID'])){
     if(empty($_POST['replay']) || empty($_POST['TrixID']))  JSON("Yêu cầu thông tin","Bạn chưa điền đầy đủ thông tin","info");
     $TrixID = tachchuoi($_POST['TrixID']);
     $replay = $kunloc->real_escape_string($_POST['replay']);
     $kiemtra = $kunloc->query("SELECT * FROM hop_thu_ho_tro WHERE TrixID = '$TrixID'");
     if($kiemtra->num_rows == 1){
     $REG = $kunloc->query("INSERT INTO 
     `replay_ho_tro`(`username`, `TrixID`, `noidung`, `ngay`) 
     VALUES ('$username','$TrixID','$replay','$now')");
     if($REG == 1){
         $data = $kiemtra->fetch_object();
         $UPDATE = $kunloc->query("UPDATE hop_thu_ho_tro SET trangthai = 'replay' WHERE TrixID = '$TrixID' ");
         //-----------------------------------------
         $message ="$username vừa trả lời yêu cầu - Title: ".$data->title." , lúc: $today";
         $getemail = $kunloc->query("SELECT * FROM account WHERE username = '{$data->username}'")->fetch_object();
         SendEmail($getemail->email,"Thông báo REPLAY TICKET",$message,"REPLAY TICKET");
         
         JSON("Trả lời yêu cầu thành công", "Chờ reload","success","die","true" );
         }else JSON("Trả lời thất bại","Xin hãy thử lại", "error");
       
     }else{
       JSON("Ticket không tồn tại","Không tìm thấy: $TrixID", "error");  
     }
    }
    if(!isset($_POST['replay'])):
      exit();
    else: if(isset($_POST['replay'])):
    $id = $kunloc->real_escape_string($_POST['replay']);
    $query_order = $kunloc->query("SELECT * FROM hop_thu_ho_tro WHERE id = '$id'")->num_rows;
    if($query_order != 1): ?>
    <center><b style="color:red">Bạn không có quyền sửa mục này. Vui lòng liên hệ <a href="https://facebook.com/<?= $facebook ?>">Admin</a></b></center>
    <?php else:
       $query = $kunloc->query("SELECT * FROM hop_thu_ho_tro WHERE id = '$id'");
       while($echo = $query->fetch_object()):
    ?>
    <input type="hidden" id="TrixID" class="form-control" value="<?= $echo->TrixID ?>"/>
     <div class="form-group">
        <label>Câu trả lời của bạn: </label>
        <textarea class="form-control ckeditor" id="replay" placeholder="Nhập mô tả dịch vụ của bạn" required><?= $echo->content;?></textarea>
      </div>
     
      <div class="form-group">
        <button type="button" onclick="btn_replay()" class="btn btn-success">GỬI YÊU CẦU</button>
    </div>  
    <script>
        setInterval(() => {
          var editor = CKEDITOR.replace('replay');
          checkout()
        }, 1e3);
        
        function btn_replay(){
            var TrixID = $("#TrixID").val();
            var replay = CKEDITOR.instances.replay.getData()
            if(TrixID == "" || replay == ""){
                Swal.fire("Yêu cầu đầy đủ","Vui lòng điền đầy đủ để tạo. Chúng tôi không chịu trách nhiệm khi bị lỗi. Xin cảm ơn.")
                return false;
            }
            $("#btn-menu").prop('disabled',true).html('Đang tạo.....');
            $.post("core/ticket/view/index.php",{ type: 'replay',
                TrixID:TrixID,
                replay:replay,
            },function(data){
                Data = JSON.parse(data);
                Swal.fire(Data.title,Data.text,Data.type);
                $("#btn-menu").prop('disabled', false).html('GỬI YÊU CẦU');
                return false;
            })
        }
    </script> 
    <div style="height:auto;overflow: scroll;">
    <?php
    $result = $kunloc->query("SELECT * FROM replay_ho_tro WHERE TrixID = '{$echo->TrixID}' ORDER BY id desc limit 0,5");
    while($echox = $result->fetch_object()):
    ?>
    <div class="iq-inbox-subject p-3"  style="border:solid 2px #ccc;">
     <h5 class="mt-0 ">#Yêu cầu: <b><?= $echo->title ?></b></h5>
     <hr/>
     <div class="iq-inbox-subject-info">
      <div class="iq-subject-info">
       <img src="<?= $kunloc->query("SELECT * FROM account WHERE username = '{$echox->username}' ")->fetch_object()->url; ?>" style="height:55px;width:55px" class="img-fluid rounded-circle" alt="#" />
       <div class="iq-subject-status align-self-center">
        <h6 class="mb-0 font-weight-bold"><?= $echox->username ?></h6>
       </div>
       <span class="float-right align-self-center">Vào lúc, <?= date("H:i d/m/Y",$echox->ngay);?></span>
      </div>
      <hr/>
      <div class="iq-inbox-body mt-1">
        <?= $echox->noidung;?>
      </div>
    </div>
    </div>
    <?php endwhile; ?>
    </div>
    <?php  endwhile; endif;endif;endif; ?>