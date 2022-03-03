<?php
if($level != 'admin') exit(header("Location: $WEBSITE_URL"));
?>
<div class="row">
<div class="col-lg-12">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title"> CÀI ĐẶT GIAO DIỆN</h4></div>
         </div>
         <div class="card-body text-center">
         <div class="irow row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>Tiêu đề trang web</label>
                    <input type="text" id="title" value="<?= $tieude ?>" class="custom-select">
                </div>
            </div>
         <script> $("#title").change(function(data) { UpdateTEXT('title') });</script>
           <div class="col-sm-6">
                <div class="form-group">
                <label>CONTENT trang web</label>
                    <input type="text" id="content" value="<?= $content ?>" class="custom-select">
                </div>
            </div>
            <script> $("#content").change(function(data) { UpdateTEXT('content')}); </script>
          </div>
         <div class="irow row"> 
            <div class="col-sm-4">   
               <form id="FORM-ICO" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
                  <img src="<?= $ico ?>" style="height:80px;width:80px;border-radius:50px">
                    <div class="form-group">
                        <label class="form-label">ICO ICON:</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="ico" id="ico" />
                        <label class="custom-file-label" for="customFile">CHỌN ICON</label>
                        </div>
                        </div>   
                </form>          
                </div>
               <div class="col-sm-4">   
               <form id="FORM-BG" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
                  <img src="<?= $background ?>" style="height:80px;width:80px;border-radius:50px">
                    <div class="form-group">
                        <label class="form-label">Background:</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="background" id="background" />
                        <label class="custom-file-label" for="customFile">CHỌN BÌA</label>
                        </div>
                        </div>   
                </form>          
                </div>
                <div class="col-sm-4">   
                 <form id="FORM-LOGO" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
                  <img src="<?= $macdinh ?>" style="height:80px;width:80px;border-radius:50px">
                    <div class="form-group">
                        <label class="form-label">LOGO:</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo" id="logo" />
                        <label class="custom-file-label" for="customFile">CHỌN LOGO</label>
                        </div>
                        </div>   
                 </form>  
                </div>     
             </div>

           </div>
    </div>
</div>
<!-- /./ -->
<div class="col-lg-12">
    <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title"><h4 class="card-title"> CẤU HÌNH TRANG WEB</h4></div>
         </div>
         <div class="card-body">
         <b class="text-left">MODE SERVER 7</b>
         <div class="row col-sm-12">
                <div class="form-group">
                <label>SREVER 7</label>
                 <select class="form-control" id="mode_server_s7">
                     <option <?php if($return_image->mode_server_s7 == 'ON') echo 'selected'; ?>value="ON">ON</option>
                     <option <?php if($return_image->mode_server_s7 == 'OFF') echo 'selected'; ?> value="OFF">OFF</option>
                 </select>
                </div>
            </div>
            <script> $("#mode_server_s7").change(function(data) {  UpdateTEXT('mode_server_s7'); });</script>
         <b class="text-left">Cấu hình MOMO</b>
         <div class="irow row">
           <div class="col-sm-4">
                <div class="form-group">
                <label>SỐ ĐIỆN THOẠI MOMO</label>
                    <input type="text" id="momo_number" value="<?= $momo_number ?>" class="custom-select">
                </div>
            </div>
            <script>$("#momo_number").change(function(data) { UpdateTEXT('momo_number'); });</script>
            <div class="col-sm-4">
                <div class="form-group">
                <label>HỌ TÊN MOMO</label>
                    <input type="text" id="momo_name" value="<?= $momo_name ?>" class="custom-select">
                </div>
            </div>
            <script>$("#momo_name").change(function(data) { UpdateTEXT('momo_name');}); </script>
            <div class="col-sm-4">
                <div class="form-group">
                <label>KEY AUTO MOMO (APIWEB2M)</label>
                    <input type="text" id="momo_key" value="<?= $momo_key ?>" class="custom-select">
                </div>
            </div>
            <script> $("#momo_key").change(function(data) { UpdateTEXT('momo_key'); }); </script>
       </div>
       <hr>
       <b class="text-left">Cấu hình BANK</b>
       <div class="irow row">
           <div class="col-sm-4">
                <div class="form-group">
                <label>SỐ TÀI KHOẢN BANK</label>
                    <input type="text" id="bank_number" value="<?= $bank_number ?>" class="custom-select">
                </div>
            </div>
            <script>$("#bank_number").change(function(data) { UpdateTEXT('bank_number'); });</script>
            <div class="col-sm-4">
                <div class="form-group">
                <label>HỌ TÊN BANK</label>
                    <input type="text" id="bank_name" value="<?= $bank_name ?>" class="custom-select">
                </div>
            </div>
            <script>$("#bank_name").change(function(data) { UpdateTEXT('bank_name');}); </script>
            <div class="col-sm-4">
                <div class="form-group">
                <label>Loại BANK</label>
                    <input type="text" id="bank_type" value="<?= $bank_type ?>" class="custom-select">
                </div>
            </div>
            <script>$("#bank_type").change(function(data) { UpdateTEXT('bank_type');}); </script>
            <div class="col-sm-4">
                <div class="form-group">
                <label>BANK Chi nhánh</label>
                    <input type="text" id="bank_chi_nhanh" value="<?= $bank_chi_nhanh ?>" class="custom-select">
                </div>
            </div>
            <script>$("#bank_chi_nhanh").change(function(data) { UpdateTEXT('bank_chi_nhanh');}); </script>
            <div class="col-sm-4">
                <div class="form-group">
                <label>BANK Content</label>
                    <input type="text" id="bank_content" value="<?= $bank_content ?>" class="custom-select">
                </div>
            </div>
            <script>$("#bank_content").change(function(data) { UpdateTEXT('bank_content');}); </script>
       </div>
       <hr>
       <b class="text-left">Cấu hình KEY (THESIEURE)</b>
        <div class="irow row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>Token</label>
                    <input type="text" id="card_key" value="<?= $keycard ?>" class="custom-select">
                </div>
            </div>
            <script>$("#card_key").change(function(data) { UpdateTEXT('card_key');  }); </script>
            <div class="col-sm-6">
                <div class="form-group">
                <label>CalllBack Url</label>
                    <input type="text" id="card_callback" value="<?= $callback ?>" class="custom-select">
                </div>
            </div>
            <script> $("#card_callback").change(function(data) { UpdateTEXT('card_callback'); }); </script>
       </div>
       <hr>
        <div class="row text-center">
            <div class="col-sm-6">
                <form id="QR_BANK" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
                  <img src="<?= $bank_image ?>" style="height:80px;width:80px;border-radius:50px">
                  <hr>
                    <div class="form-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="bank_image" id="bank_image" />
                        <label class="custom-file-label" for="customFile">CHỌN img</label>
                        </div>
                   </div>   
                </form>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <form id="QR_MOMO" action="javascript:void(0);" enctype="multipart/form-datas" method="POST">
                  <img src="<?= $momo_image ?>" style="height:80px;width:80px;border-radius:50px">
                  <hr>
                    <div class="form-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="momo_image" id="momo_image" />
                        <label class="custom-file-label" for="customFile">CHỌN img</label>
                        </div>
                   </div>   
                </form>
                </div>
            </div>
         </div>
      <!--.//-->
   </div>
  </div>
</div>
<script>
$('#QR_BANK').change(function(){
   Uploaded('QR_BANK','bank_image');
})
$('#QR_MOMO').change(function(){
   Uploaded('QR_MOMO','momo_image');
})
$('#FORM-LOGO').change(function(){
   Uploaded('FORM-LOGO','logo');
})
$('#FORM-BG').change(function(){
   Uploaded('FORM-BG','background');
})
$('#FORM-ICO').change(function(){
   Uploaded('FORM-ICO','ico');
})
function UpdateTEXT(id){
   text = $("#"+id).val();
    $.post( WEBSITE_URL + 'core/kunloc/setting.php', {
       case: "TEXT",
       type: id,
       value: text,
    }, function(data){
   Data = JSON.parse(data);
   toarst(Data.type, Data.title,"");   
    })
}
function Uploaded(form,id){
    form = $("#"+form)[0];
    formData = new FormData(form);
    get_image = $("#"+id).val();
    if (get_image.length !== "") {
            $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="token"]').attr("value") } });
            $.ajax({
                url: WEBSITE_URL + "API/api_image.php",
                data: formData,
                processData: false,
                contentType: false,
                type: "POST",
                success: function (data) {
                    Data = JSON.parse(data);
                    if (Data.type == "success") {
                        URLIMAGE = Data.url;
                        TYPER = "'"+id+"'";
                        $.post(WEBSITE_URL + "core/kunloc/setting.php", {
                            case: "UPDATES",
                            type: id,
                            URL:URLIMAGE,
                        }, function(data){
                            Data = JSON.parse(data);
                            Swal.fire(Data.title, Data.text,Data.type);
                        })
                    }
                    return toarst(Data.type, Data.text);
                },
               
            });
   } else  return  toastr.warning("Bạn chưa tải ảnh lên");
}
</script>   