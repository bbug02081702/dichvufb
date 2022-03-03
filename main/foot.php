<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "100527742254235");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
<!-- Footer -->
<script src="/assets/editor/ckeditor.js"></script>
<script type="text/javascript">
<?php if($username){ ?>
$(document).ready(function () {
    setInterval(() => { $.post( WEBSITE_URL + 'API/api_money.php', { type: 'get_money' }, function(data) { Data = JSON.parse(data),$('#sodu').text(Data.vnd); })},1e3);
    $.post(WEBSITE_URL + 'API/api_notication.php', { type: 'get_thongbao' }, function(data) {
        Data = JSON.parse(data)
        kunloc = '';
        if(Data.id,Data.title,Data.text){
            $('#view-notification').modal();
            kunloc +='<div class="text-center">\n';
            kunloc +='<div class="h4 mt-3 font-wegiht-bold">'+Data.title+'</div>\n';
            kunloc +='<div class="m-1">'+Data.text+'</div>\n';
            kunloc +='<div class="m-2"><button onclick="offnoti('+Data.id+')" class="btn-sm btn btn-outline-success">Tôi Đã Đọc!!!!</button></div>\n';
            kunloc +='</div>\n';
            $('#view-data-notification').html(kunloc);
        }
    })
})
<?php } ?>
function toarst(status, msg, title) {
    Command: toastr[status](msg, title);
    toastr.options = {
        closeButton: false,
        debug: false,
        progressBar: true,
        positionClass: "toast-top-right",
        onclick: null,
        showDuration: "400",
        hideDuration: "1000",
        timeOut: "4000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "slideDown",
        hideMethod: "slideUp",
    };
}
function Tables(i, limit, orderbyid = "asc") {
    var table = $("#" + i).DataTable({
        lengthChange: true,
        destroy: true,
        aaSorting: [[0, orderbyid]],
        iDisplayLength: limit,
        aLengthMenu: [
            [5, 10, 20, 30, 40, 50, 100, 200, 500, 1000, "Tất cả"],
            [5, 10, 20, 30, 40, 50, 100, 200, 500, 1000, "Tất cả"],
        ],
        oLanguage: {
            lengthMenu: "Hiển thị _MENU_ mục",
            zeroRecords: "Không tìm thấy kết quả",
            sInfo: "Hiển Thị _START_ trong _END_ của _TOTAL_ mục",
            sEmptyTable: "Không có dữ liệu trong bảng",
            sInfoEmpty: "Hiển Thị 0 trong 0 của 0 bảng",
            sInfoFiltered: "(Đã lọc từ _MAX_ tổng bảng)",
            sInfoPostFix: "",
            sDecimal: "",
            sThousands: ",",
            sLengthMenu: "Hiển thị _MENU_ mục",
            sLoadingRecords: "Đang tải...",
            sProcessing: "Processing...",
            sSearch: "Tiềm kiếm:",
            sZeroRecords: "Không tìm thấy kết quả",
            sSearchPlaceholder: "Nhập từ cần tìm...",
            oPaginate: {
                sFirst: "Đầu",
                sLast: "Cuối",
                sNext: "Tiếp",
                sPrevious: "Trước",
            },
            oAria: {
                sSortAscending: ": ASC Tăng Dần",
                sSortDescending: ": DESC Giảm Dần",
            },
        },
    });
    table.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");
}
function Disabled(id,type){
  $.each($("#"+id).find("input, button, textarea, select"), function(index, value) {
  $(value).prop("disabled", type);
  })
}
</script>
<script src="/assets/js/all.min.js?<?= time() ?>"></script>
<scriptttttt src="/assets/lib/fortawesome/all.min.js"></script>
<!-- Auto fill -->
<script src="https://cdn.datatables.net/autofill/2.3.5/js/dataTables.autoFill.min.js"></script>
<script src="https://cdn.datatables.net/autofill/2.3.5/js/autoFill.bootstrap4.min.js"></script>
<!-- Table of -->   
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>