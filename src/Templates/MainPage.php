<?php

namespace Web\Templates;

use Web\Model\Home;

class MainPage extends Template
{

  private $homes;

  public function __construct()
  {
    parent::__construct();
    $this->title = $this->setting->getTitle();

    $homeModel = new Home();
    $this->homes = $homeModel->getAllData();
  }


  public function renderPage()
  {
?>
    <!DOCTYPE html>
    <html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">

    <?php $this->getHead() ?>

    <body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
      <?php $this->getHeader() ?>
      <?php $this->getMainMenu() ?>
      <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
          <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
              <div class="row breadcrumbs-top">
                <div class="col-12">
                  <h5 class="content-header-title float-left pr-1"><?= $this->setting->getTitle() ?></h5>
                  <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb p-0 mb-0">
                      <li class="breadcrumb-item"><a href="index.html"><i class="bx bx-home-alt"></i></a>
                      </li>
                      <li class="breadcrumb-item"><a href="<?= url('index.php', ['action' => null]) ?>">خانه ها</a>
                      </li>
                      <li class="breadcrumb-item active">
                        <?php $this->setting->getTitle() ?>
                      </li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="content-body">
            <div class="alert bg-rgba-black">
              <i class="bx bx-info-circle mr-1 align-middle"></i>
              <span class="align-middle">
                <a style="color:black" href="https://getbootstrap.com/docs/4.3/components/card/" target="_blank"> برای اطلاعات بیشتر درباره خانه ها <u>اینجا</u> کلیک کنید</a>
              </span>
            </div>
            <!-- Basic card section start -->
            <section id="content-types">
              <div class="row">
                <?php foreach ($this->homes as $home) : ?>
                  <div class="col-md-3 col-sm-6">
                    <div class="card">
                      <div class="card-content">
                        <img class="card-img-top img-fluid" src="<?= asset($home->getImage()) ?>" alt="Card image cap">
                        <div class="card-body">
                          <h4 class="card-title"><?= $home->getTitle() ?></h4>
                          <p class="card-text">
                            <?= $home->getExcerpt() ?>
                          </p>
                          <p class="card-text">
                            <?= $home->getAddress() ?>
                          </p>
                          <a href="<?= url('index.php', ['action' => 'single', 'id' => $home->getId()]) ?>" class="btn btn-black block">اطلاعات بیشتر</a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </section>
          </div>
        </div>
      </div>

      <div class="customizer d-none d-md-block"><a class="customizer-close" href="#"><i class="bx bx-x"></i></a><a class="customizer-toggle" href="#"><i class="bx bx-cog bx bx-spin white"></i></a>
        <div class="customizer-content p-2">
          <h4 class="text-uppercase mb-0 mt-n50">سفارشی سازی قالب</h4>
          <small>سفارشی سازی کنید و به صورت زنده مشاهده کنید.</small>
          <hr>
          <h5 class="mt-n25">طرح قالب</h5>
          <div class="theme-layouts">
            <div class="d-flex justify-content-start">
              <div class="mx-50">
                <fieldset>
                  <div class="radio">
                    <input type="radio" name="layoutOptions" value="false" id="radio-light" class="layout-name" data-layout="" checked>
                    <label for="radio-light">روشن</label>
                  </div>
                </fieldset>
              </div>
              <div class="mx-50">
                <fieldset>
                  <div class="radio">
                    <input type="radio" name="layoutOptions" value="false" id="radio-dark" class="layout-name" data-layout="dark-layout">
                    <label for="radio-dark">تیره</label>
                  </div>
                </fieldset>
              </div>
              <div class="mx-50">
                <fieldset>
                  <div class="radio">
                    <input type="radio" name="layoutOptions" value="false" id="radio-semi-dark" class="layout-name" data-layout="semi-dark-layout">
                    <label for="radio-semi-dark">نیمه تیره</label>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
          <!-- Theme options starts -->
          <hr>

          <!-- Menu Colors Starts -->
          <div id="customizer-theme-colors">
            <h5>رنگ های فهرست</h5>
            <ul class="list-inline unstyled-list">
              <li class="color-box bg-primary selected" data-color="theme-primary"> </li>
              <li class="color-box bg-success" data-color="theme-success"> </li>
              <li class="color-box bg-danger" data-color="theme-danger"> </li>
              <li class="color-box bg-info" data-color="theme-info"> </li>
              <li class="color-box bg-warning" data-color="theme-warning"> </li>
              <li class="color-box bg-dark" data-color="theme-dark"> </li>
            </ul>
            <hr>
          </div>
          <!-- Menu Colors Ends -->
          <!-- Menu Icon Animation Starts -->
          <div id="menu-icon-animation">
            <div class="d-flex justify-content-between align-items-center">
              <div class="icon-animation-title">
                <h5 class="pt-25">انیمیشن آیکن ها</h5>
              </div>
              <div class="icon-animation-switch">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" checked id="icon-animation-switch">
                  <label class="custom-control-label" for="icon-animation-switch"></label>
                </div>
              </div>
            </div>
            <hr>
          </div>
          <!-- Menu Icon Animation Ends -->
          <!-- Collapse sidebar switch starts -->
          <div class="collapse-sidebar d-flex justify-content-between align-items-center">
            <div class="collapse-option-title">
              <h5 class="pt-25">جمع کردن فهرست</h5>
            </div>
            <div class="collapse-option-switch">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="collapse-sidebar-switch">
                <label class="custom-control-label" for="collapse-sidebar-switch"></label>
              </div>
            </div>
          </div>
          <!-- Collapse sidebar switch Ends -->
          <hr>

          <!-- Navbar colors starts -->
          <div id="customizer-navbar-colors">
            <h5>رنگ های نوار بالایی</h5>
            <ul class="list-inline unstyled-list">
              <li class="color-box bg-white border selected" data-navbar-default=""> </li>
              <li class="color-box bg-primary" data-navbar-color="bg-primary"> </li>
              <li class="color-box bg-success" data-navbar-color="bg-success"> </li>
              <li class="color-box bg-danger" data-navbar-color="bg-danger"> </li>
              <li class="color-box bg-info" data-navbar-color="bg-info"> </li>
              <li class="color-box bg-warning" data-navbar-color="bg-warning"> </li>
              <li class="color-box bg-dark" data-navbar-color="bg-dark"> </li>
            </ul>
            <small><strong>نکته :</strong> این گزینه تنها در حالت نوار ثابت و در هنگام اسکرول صفحه نمایش داده خواهد شد.</small>
            <hr>
          </div>
          <!-- Navbar colors starts -->
          <!-- Navbar Type Starts -->
          <h5 class="mt-n25">نوع نوار بالایی</h5>
          <div class="navbar-type d-flex justify-content-start">
            <div class="hidden-ele mx-50">
              <fieldset>
                <div class="radio">
                  <input type="radio" name="navbarType" value="false" id="navbar-hidden">
                  <label for="navbar-hidden">مخفی</label>
                </div>
              </fieldset>
            </div>
            <div class="mx-50">
              <fieldset>
                <div class="radio">
                  <input type="radio" name="navbarType" value="false" id="navbar-static">
                  <label for="navbar-static">ایستا</label>
                </div>
              </fieldset>
            </div>
            <div class="mx-50">
              <fieldset>
                <div class="radio">
                  <input type="radio" name="navbarType" value="false" id="navbar-sticky" checked>
                  <label for="navbar-sticky">ثابت</label>
                </div>
              </fieldset>
            </div>
          </div>
          <hr>
          <!-- Navbar Type Starts -->

          <!-- Footer Type Starts -->
          <h5 class="mt-n25">نوع فوتر</h5>
          <div class="footer-type d-flex justify-content-start">
            <div class="mx-50">
              <fieldset>
                <div class="radio">
                  <input type="radio" name="footerType" value="false" id="footer-hidden">
                  <label for="footer-hidden">مخفی</label>
                </div>
              </fieldset>
            </div>
            <div class="mx-50">
              <fieldset>
                <div class="radio">
                  <input type="radio" name="footerType" value="false" id="footer-static" checked>
                  <label for="footer-static">ایستا</label>
                </div>
              </fieldset>
            </div>
            <div class="mx-50">
              <fieldset>
                <div class="radio">
                  <input type="radio" name="footerType" value="false" id="footer-sticky">
                  <label for="footer-sticky" class="">چسبان</label>
                </div>
              </fieldset>
            </div>
          </div>
          <!-- Footer Type Ends -->
          <hr>

          <!-- Card Shadow Starts-->
          <div class="card-shadow d-flex justify-content-between align-items-center py-25">
            <div class="hide-scroll-title">
              <h5 class="pt-25">سایه کارت</h5>
            </div>
            <div class="card-shadow-switch">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" checked id="card-shadow-switch">
                <label class="custom-control-label" for="card-shadow-switch"></label>
              </div>
            </div>
          </div>
          <!-- Card Shadow Ends-->
          <hr>

          <!-- Hide Scroll To Top Starts-->
          <div class="hide-scroll-to-top d-flex justify-content-between align-items-center py-25">
            <div class="hide-scroll-title">
              <h5 class="pt-25">مخفی سازی دکمه اسکرول به بالا</h5>
            </div>
            <div class="hide-scroll-top-switch">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="hide-scroll-top-switch">
                <label class="custom-control-label" for="hide-scroll-top-switch"></label>
              </div>
            </div>
          </div>
          <!-- Hide Scroll To Top Ends-->
        </div>
      </div>
      <!-- End: Customizer-->

      <!-- Buynow Button-->
      <div class="buy-now"><a href="#" target="_blank" class="btn btn-danger">ارتباط با ما</a>

      </div>
      <!-- demo chat-->
      <div class="widget-chat-demo"><!-- widget chat demo footer button start -->
        <button class="btn btn-primary chat-demo-button glow px-1"><i class="livicon-evo" data-options="name: comments.svg; style: lines; size: 24px; strokeColor: #fff; autoPlay: true; repeat: loop;"></i></button>
        <!-- widget chat demo footer button ends -->
        <!-- widget chat demo start -->
        <div class="widget-chat widget-chat-demo d-none">
          <div class="card mb-0">
            <div class="card-header border-bottom p-0">
              <div class="media m-75">
                <a href="JavaScript:void(0);">
                  <div class="avatar mr-75">
                    <img src="../../assets/images/portrait/small/avatar-s-2.jpg" alt="avtar images" width="32" height="32">
                    <span class="avatar-status-online"></span>
                  </div>
                </a>
                <div class="media-body">
                  <h6 class="media-heading mb-0 mt-n25"><a href="javaScript:void(0);">جان اسنو</a></h6>
                  <span class="text-muted font-small-3">فعال</span>
                </div>
                <i class="bx bx-x widget-chat-close float-right my-auto cursor-pointer"></i>
              </div>
            </div>
            <div class="card-body widget-chat-container widget-chat-demo-scroll">
              <div class="chat-content">
                <div class="badge badge-pill badge-light-secondary my-1">امروز</div>
                <div class="chat">
                  <div class="chat-body">
                    <div class="chat-message">
                      <p>لورم ایپسوم متن ساختگی</p>
                      <span class="chat-time">7:45 ق.ظ</span>
                    </div>
                  </div>
                </div>
                <div class="chat chat-left">
                  <div class="chat-body">
                    <div class="chat-message">
                      <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت</p>
                      <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم</p>
                      <span class="chat-time">7:50 ق.ظ</span>
                    </div>
                  </div>
                </div>
                <div class="chat">
                  <div class="chat-body">
                    <div class="chat-message">
                      <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                      <span class="chat-time">8:01 ق.ظ</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer border-top p-1">
              <form class="d-flex" onsubmit="widgetChatMessageDemo();" action="javascript:void(0);">
                <input type="text" class="form-control chat-message-demo mr-75" placeholder="اینجا بنویسید ...">
                <button type="submit" class="btn btn-primary glow px-1"><i class="bx bx-paper-plane"></i></button>
              </form>
            </div>
          </div>
        </div>
        <!-- widget chat demo ends -->

      </div>
      <div class="sidenav-overlay"></div>
      <div class="drag-target"></div>

      <!-- BEGIN: Footer-->
      <?php $this->getFooter() ?>
      <!-- END: Footer-->


      <!-- BEGIN: Vendor JS-->
      <script src="<?= asset("vendors/js/vendors.min.js") ?>"></script>
      <script src="<?= asset("fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js") ?>"></script>
      <script src="<?= asset("fonts/LivIconsEvo/js/LivIconsEvo.defaults.js") ?>"></script>
      <script src="<?= asset("fonts/LivIconsEvo/js/LivIconsEvo.min.js") ?>"></script>
      <!-- BEGIN Vendor JS-->

      <!-- BEGIN: Page Vendor JS-->
      <script src="<?= asset("fonts/LivIconsEvo/js/LivIconsEvo.min.js") ?>"></script>
      <script src="<?= asset("vendors/js/charts/apexcharts.min.js") ?>"></script>
      <script src="<?= asset("vendors/js/extensions/dragula.min.js") ?>"></script>
      <!-- END: Page Vendor JS-->

      <!-- BEGIN: Theme JS-->
      <script src="<?= asset("js/scripts/configs/horizontal-menu.js") ?>"></script>
      <script src="<?= asset("js/core/app-menu.js") ?>"></script>
      <script src="<?= asset("js/core/app.js") ?>"></script>
      <script src="<?= asset("js/scripts/components.js") ?>"></script>
      <script src="<?= asset("js/scripts/footer.js") ?>"></script>
      <script src="<?= asset("js/scripts/customizer.js") ?>"></script>
      <!-- END: Theme JS-->

      <!-- BEGIN: Page JS-->
      <script src="<?= asset("js/scripts/pages/dashboard-analytics.js") ?>"></script>
      <!-- END: Page JS-->

    </body>
    <!-- END: Body-->

    </html>

    </body>



<?php
  }
}
