<?php
	include 'config.php';
	if($username):
    if($trangthai === 'disabled') header("Location: $domain_url/disable.html");
    endif;
    if(strpos($_SERVER['QUERY_STRING'], '=')):
	    $pattern = '#=(.*)#';
	    $str = $_SERVER['QUERY_STRING'];
	    preg_match($pattern, $str, $matches);
	    if(strpos($matches[1], '%27')  != false) exit();
	endif;
	$hour = date("G");
    $theme_mau = "#333";
?>
<?php include_once('main/head.php'); ?>
<body>
<main class="main" id="top">
    <script>
            var isFluid = JSON.parse(localStorage.getItem('isFluid'));
            if (isFluid) {
                var container = document.querySelector('[data-layout]');
                container.classList.remove('container');
                container.classList.add('container-fluid');
            }
     </script>
    <div class="container" data-layout="container">
        <?php include_once('main/core/sidebar_menu.php'); ?>
 		<?php include_once('main/core/navbar.php'); ?>
		<?php include_once('main/core/main_content.php'); ?>
	</div>
</main>
<div class="modal fade" id="view-notification" tabindex="-1" role="dialog" aria-labelledby="view-notification" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="icon-settings icons"></i> <b class="text-danger"><?= $username ?></b> ơi, Có thông báo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <div class="mt-3" id="view-data-notification"></div>
        </div>
      </div>
      
    </div>
  </div>
</div>