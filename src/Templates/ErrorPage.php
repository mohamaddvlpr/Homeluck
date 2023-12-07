<?php
namespace Web\Templates;

class ErrorPage extends Template{

    private $messages;

    public function __construct($messages)
    {
        parent::__construct();
        $this->messages = $messages;
        $this->title = $messages;
    }

    public function renderPage()
    {
        ?>
            <!DOCTYPE html>
            <html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">
            <!-- BEGIN: Head-->
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
                <title><?= $this->title ?></title>
                <link rel="shortcut icon" type="image/x-icon" href=<?= asset("images/ico/favicon.ico") ?>>
                <meta name="theme-color" content="#5A8DEE">
                
                <!-- BEGIN: Vendor CSS-->
                <link rel="stylesheet" type="text/css" href="<?= asset("vendors/css/vendors.min.css") ?>">
                <!-- END: Vendor CSS-->

                <!-- BEGIN: Theme CSS-->
                <link rel="stylesheet" type="text/css" href=<?= asset("css/bootstrap.min.css") ?>>
                <link rel="stylesheet" type="text/css" href=<?= asset("css/bootstrap-extended.css") ?>>
                <link rel="stylesheet" type="text/css" href=<?= asset("css/colors.css") ?>>
                <link rel="stylesheet" type="text/css" href=<?= asset("css/components.css") ?>>
                <link rel="stylesheet" type="text/css" href=<?= asset("css/themes/dark-layout.css") ?>>
                <link rel="stylesheet" type="text/css" href=<?= asset("css/themes/semi-dark-layout.css") ?>>
                <!-- END: Theme CSS-->

                <!-- BEGIN: Page CSS-->
                <link rel="stylesheet" type="text/css" href=<?= asset("css/core/menu/menu-types/horizontal-menu.css") ?>>
                <!-- END: Page CSS-->

            </head>
            <!-- END: Head-->

            <!-- BEGIN: Body-->
            <body class="horizontal-layout horizontal-menu navbar-static 1-column   footer-static bg-full-screen-image  blank-page blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
                <!-- BEGIN: Content-->
                <div class="app-content content">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body"><!-- error 404 -->
            <section class="row flexbox-container">
            <div class="col-xl-6 col-md-7 col-9">
                <div class="card bg-transparent shadow-none">
                <div class="card-content">
                    <div class="card-body text-center bg-transparent miscellaneous">
                    <h1 class="error-title">صفحه مورد نظر یافت نشد</h1>
                    <p class="pb-3">
                       <?= $this->messages ?></p>
                <img class="img-fluid" src="../../assets/images/pages/404.png" alt="404 error">
                    <a href="<?= url('index.php') ?>" class="btn btn-primary round glow mt-3">صفحه اصلی</a>
                    </div>
                </div>
                </div>
            </div>
            </section>
            <!-- error 404 end -->
                    </div>
                </div>
                </div>
                <!-- END: Content-->


                <!-- BEGIN: Vendor JS-->
                <script src=<?= asset("css/themes/semi-dark-layout.css") ?>></script>
                <script src=<?= asset("fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js") ?>></script>
                <script src=<?= asset("fonts/LivIconsEvo/js/LivIconsEvo.defaults.js") ?>></script>
                <script src=<?= asset("fonts/LivIconsEvo/js/LivIconsEvo.min.js") ?>></script>
                <!-- BEGIN Vendor JS-->

                <!-- BEGIN: Page Vendor JS-->
                <script src=<?= asset("vendors/js/ui/jquery.sticky.js") ?>></script>
                <!-- END: Page Vendor JS-->

                <!-- BEGIN: Theme JS-->
                <script src=<?= asset("js/scripts/configs/horizontal-menu.js") ?>></script>
                <script src=<?= asset("assets/js/core/app-menu.js") ?>></script>
                <script src=<?= asset("assets/js/core/app.js") ?>></script>
                <script src=<?= asset("assets/js/core/app.js") ?>></script>
                <script src=<?= asset("assets/js/scripts/footer.js") ?>></script>
                <!-- END: Theme JS-->

                <!-- BEGIN: Page JS-->
                <!-- END: Page JS-->

            </body>
            <!-- END: Body-->
            </html>

        <?php
    }
}