<?php

namespace Web\Templates;

use Web\Classes\Request;
use Web\Classes\Validator;
use Web\Model\Setting;
use Web\Classes\Auth;

abstract class Template
{

  protected $title;
  protected $setting;
  protected $request;
  protected $validator;

  public function __construct()
  {
    $this->request = new Request();
    $settingModel = new Setting();
    $this->validator = new Validator($this->request);
    $this->setting = $settingModel->getFirstData();
  }

  protected function getHead()
  {
?>

    <head>
      <meta http-equiv="Content-Type" content="<?= $this->setting->getAuthor() ?>">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <title><?= $this->title ?></title>
      <link rel="shortcut icon" type="image/x-icon" href="<?= asset("images/ico/home.png") ?>">
      <meta name="theme-color" content="#5A8DEE">

      <!-- BEGIN: Vendor CSS-->
      <link rel="stylesheet" type="text/css" href="<?= asset("vendors/css/vendors.min.css") ?>">
      <link rel="stylesheet" type="text/css" href="<?= asset("vendors/css/charts/apexcharts.css") ?>">
      <link rel="stylesheet" type="text/css" href="<?= asset("vendors/css/extensions/dragula.min.css") ?>">
      <!-- END: Vendor CSS-->

      <!-- BEGIN: Theme CSS-->
      <link rel="stylesheet" type="text/css" href="<?= asset("css/bootstrap.min.css") ?>">
      <link rel="stylesheet" type="text/css" href="<?= asset("css/bootstrap-extended.css") ?>">
      <link rel="stylesheet" type="text/css" href="<?= asset("css/colors.css") ?>">
      <link rel="stylesheet" type="text/css" href="<?= asset("css/components.css") ?>">
      <link rel="stylesheet" type="text/css" href="<?= asset("css/themes/dark-layout.css") ?>">
      <link rel="stylesheet" type="text/css" href="<?= asset("css/themes/semi-dark-layout.css") ?>">
      <!-- END: Theme CSS-->

      <!-- BEGIN: Page CSS-->
      <link rel="stylesheet" type="text/css" href="<?= asset("css/core/menu/menu-types/horizontal-menu.css") ?>">
      <link rel="stylesheet" type="text/css" href="<?= asset("css/pages/dashboard-analytics.css") ?>">
      <!-- END: Page CSS-->

    </head>

  <?php
  }

  protected function getHeader()
  {
  ?>

    <body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
      <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed bg-black navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item"><a class="navbar-brand" href="<?= url('index.php') ?>">
                <div class="brand-logo"><img class="logo" src="<?= asset("images/elements/homeone.png") ?>"></div>
                <h2 class="brand-text mb-0">HomeLuck</h2>
              </a></li>
          </ul>
        </div>
        <div class="navbar-wrapper">
          <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
              <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav">
                  <li class="nav-item mobile-menu mr-auto"><a class="nav-link nav-menu-main menu-toggle" href="#"><i class="bx bx-menu"></i></a></li>
                </ul>

                <ul class="nav navbar-nav">
                  <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon bx bx-star warning"></i></a>
                    <div class="bookmark-input search-input">
                      <div class="bookmark-input-icon"><i class="bx bx-search primary"></i></div>
                      <input class="form-control input" type="text" placeholder="جستجو ..." tabindex="0" data-search="template-search">
                      <ul class="search-list"></ul>
                    </div>
                  </li>
                </ul>
              </div>
              <ul class="nav navbar-nav float-right d-flex align-items-center">

                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                <li class="nav-item nav-search"><a class="nav-link nav-link-search pt-2"><i class="ficon bx bx-search"></i></a>
                  <div class="search-input">
                    <div class="search-input-icon"><i class="bx bx-search primary"></i></div>
                    <input class="input" type="text" placeholder="جستجو ..." tabindex="-1" data-search="template-search">
                    <div class="search-input-close"><i class="bx bx-x"></i></div>
                    <ul class="search-list"></ul>
                  </div>
                </li>


              </ul>
            </div>
          </div>
        </div>
      </nav>


    <?php
  }

  protected function getMainMenu()
  {
    ?>
      <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-header d-xl-none d-block">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html">
                <div class="brand-logo"><img class="logo" src="<?= asset("images/logo/logo.png") ?>"></div>
                <h2 class="brand-text mb-0"><?= $this->title ?></h2>
              </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i></a></li>
          </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
          <!-- include ../../includes/mixins-->
          <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="filled">
            <li class="dropdown nav-item" data-menu="dropdown"><a style="color:black;" class="dropdown-toggle nav-link" href="<?= url('index.php', ['action' => 'login']) ?>" data-toggle="dropdown">ثبت نام</a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li data-menu=""><a style="color: black;" class="dropdown-item align-items-center" href="<?= url('index.php', ['action' => 'login']) ?>" data-toggle="dropdown"><i class="bx bx-left-arrow-alt"></i>ثبت نام</a>
                </li>
              </ul>
            <li class="dropdown nav-item" data-menu="dropdown"><a style="color:black" class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="comments"></i><span> دسته بندی </span></a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li data-menu=""><a style="color: black;" class="dropdown-item align-items-center" href="<?= url('index.php', ['action' => 'category', 'category' => 'villa']) ?>" data-toggle="dropdown"><i class="bx bx-left-arrow-alt"></i>ویلا</a>
                </li>
                <li data-menu=""><a style="color: black;" class="dropdown-item align-items-center" href="<?= url('index.php', ['action' => 'category', 'category' => 'apartment']) ?>" data-toggle="dropdown"><i class="bx bx-left-arrow-alt"></i>آپارتمان</a>
                </li>
                <li data-menu=""><a style="color: black;" class="dropdown-item align-items-center" href="<?= url('index.php', ['action' => 'category', 'category' => 'groundfloor']) ?>" data-toggle="dropdown"><i class="bx bx-left-arrow-alt"></i>همکف</a>
                </li>
              </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown"><a style="color:black" class="dropdown-toggle nav-link" href="<?= url('index.php') ?>" data-toggle="dropdown"><i class="menu-livicon" data-icon="briefcase"></i>صفحه اصلی</a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li data-menu=""><a style="color: black;" class="dropdown-item align-items-center" href="<?= url('index.php') ?>" data-toggle="dropdown"><i class="bx bx-left-arrow-alt"></i>صفحه اصلی</a>
                </li>
              </ul>

            </li>

            <li class="dropdown nav-item" data-menu="dropdown"><a style="color:black" class="dropdown-toggle nav-link" href="<?= url('index.php', ['action' => 'main']) ?>" data-toggle="dropdown"><i class="menu-livicon" data-icon="notebook"></i><span>دیدن خانه ها</span></a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li data-menu=""><a style="color: black;" class="dropdown-item align-items-center" href="<?= url('index.php', ['action' => 'main']) ?>" data-toggle="dropdown"><i class="bx bx-left-arrow-alt"></i>دیدن خانه ها</a>
                </li>
              </ul>

            <li class="dropdown nav-item" data-menu="dropdown"><a style="color:black" class="dropdown-toggle nav-link" href="<?= url('index.php', ['action' => 'createhome']) ?>" data-toggle="dropdown"><i class="menu-livicon" data-icon="notebook"></i><span>ثبت خانه</span></a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li data-menu=""><a style="color: black;" class="dropdown-item align-items-center" href="<?= url('index.php', ['action' => 'createhome']) ?>" data-toggle="dropdown"><i class="bx bx-left-arrow-alt"></i>ثبت خانه</a>
                </li>
              </ul>

            <li class="dropdown nav-item" data-menu="dropdown"><a style="color:red" class="dropdown-toggle nav-link" href="<?= url('index.php', ['action' => 'login']) ?>" data-toggle="dropdown"><i class="menu-livicon" data-icon="notebook"></i><span>خروج از حساب کاربری</span></a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li data-menu=""><a style="color: red;" class="dropdown-item align-items-center" href="<?= url('index.php', ['action' => 'logout']) ?>" data-toggle="dropdown"><i class="bx bx-left-arrow-alt"></i>خروج از حساب کاربری</a>
                </li>
              </ul>


          </ul>
          </li>
          </ul>
        </div>
        <!-- /horizontal menu content-->
      </div>

    <?php
  }

  protected function getFooter()
  {
    ?>
      <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-left d-inline-block">ارائه شده در وب‌سایت هوم لاک<a href="https://www.rtl-theme.com" target="_blank"></a></span><span class="float-right d-sm-inline-block d-none"><?= $this->setting->getFooter() ?><i class="bx bxs-heart pink ml-50 font-small-3"></i></span>
          <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
      </footer>
    </body>

<?php
  }

  abstract public function renderPage();
}
