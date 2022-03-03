<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="iNQKClUN6cVnd4tc9IC4Cm9ANNL0N4oLi5BDaK1k" />
        <title><?= $tieude ?></title>
        <meta name="copyright" content="" />
        <meta name="robots" content="index, follow" />
        <meta name="revisit-after" content="1 days" />
        
        <meta http-equiv="content-language" content="vi" />
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="theme-color" content="#ffffff" />
        <meta property="og:url" content="" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?= $content ?>" />
        <meta property="og:description" content="<?= $content ?>" />
        <meta property="og:image" content="<?= $logo ?>" />
        <meta name="msapplication-TileImage" content="<?= $ico ?>" />
        <meta property="fb:app_id" content="" />
        <link rel="shortcut icon" type="image/x-icon" href="<?= $ico ?>" />
        <link rel="manifest" href="/assets/img/favicons/manifest.json" />
        <!-- CSS -->
        <link href="/assets/css/all.min.css?<?= time() ?>" rel="stylesheet" />
        <link href="/mod.css" rel="stylesheet" />
        <link href="/css.css?<?= time() ?>" rel="stylesheet" />
        <link href="/assets/css/app.css" rel="stylesheet" />
        <!-- Font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Icons CSS-->
        <link rel="stylesheet" type="text/css" href="/assets/css/icons.css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/v4-shims.css">
        <script defer src="https://use.fontawesome.com/releases/v5.15.3/js/all.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.15.3/js/v4-shims.js"></script>
        <!-- FONT CSS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet" />
        <!-- /./ -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <!--Sweet Alerts -->
        <link rel="stylesheet" type="text/css" href="/assets/swal/sweetalert2.min.css">
        <script type="text/javascript" src="/assets/swal/sweetalert2.min.js"></script>
        <!-- Auto fill -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/autofill/2.3.5/css/autoFill.bootstrap4.min.css">
        <!-- table CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">  
        <!-- Toatrs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"/>
        
        <!--/./ -->
        <script src="/assets/js/config.navbar-vertical.min.js?<?= time() ?>"></script>
        <style> 
         .page_speed{font-size:16px}.page_speed{max-width:20rem}.page_speed1{background-image:url('<?= $domain_url ?>/assets/img/illustrations/corner-1.png')}.page_speed2{background-image:url('<?= $domain_url ?>/assets/img/illustrations/corner-2.png')}.page_speed3{background-image:url('<?= $domain_url ?>/assets/img/illustrations/corner-3.png')}.page_speed4{background-image:url('<?= $domain_url ?>/assets/img/illustrations/corner-3.png')}.page_speed{max-width:50px;max-height:52px}.page_speed{vertical-align:middle}/*! new !*/
         ::-webkit-scrollbar{width:0;height:10px;border-radius:0}::-webkit-scrollbar-track{box-shadow:inset 0 0 5px grey;border-radius:0}::-webkit-scrollbar-thumb{background:#ccc;border-radius:0}::-webkit-scrollbar-thumb:hover{background:#ccc}         
        </style>
        <script>
            const WEBSITE_URL = '<?= $domain_url ?>/';
            const account = {
                "chietkhau": <?= $chietkhau ? $chietkhau : 0; ?>,
                "username": "<?= $username  ? $username : '' ?>",
                "vnd": <?= $vnd ? $vnd : 0 ?>,
            };
        </script>
        <script type="text/javascript" src="<?= $domain_url ?>/assets/main.js?<?= time() ?>"></script>
</head>
