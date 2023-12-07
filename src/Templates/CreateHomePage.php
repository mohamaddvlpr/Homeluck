<?php

namespace Web\Templates;

use Web\Classes\Auth;
use Web\Classes\Session;
use Web\Entities\HomeEntity;
use Web\Model\Home;

class CreateHomePage extends Template
{

    private $errors = [];

    public function __construct()
    {
        parent::__construct();

        if (!Auth::isAuthenticated())
            redirect('index.php', ['action' => 'login']);

        $this->title = $this->setting->getTitle() . ' - Create Home';

        if ($this->request->isPostMethod()) {
            $data = $this->validator->validate([
                'title' => ['required', 'min:3', 'max:100'],
                'category' => ['required', 'in:villa,apartment,groundfloor'],
                'address' => ['required', 'min:3', 'max:100'],
                'price' => ['required', 'min:5', 'max:20'],
                'meter' => ['required', 'min:2', 'max:5'],
                'image' => ['required', 'file', 'size:2000', 'type:jpg,png,jpeg'],
                'description' => ['required', 'min:20', 'max:5000'],
                'yearofconstruction' => ['required']
            ]);

            if (!$data->hasErrors()) {
                $this->createHome();
            } else {
                $this->errors = $data->getErrors();
            }
        }
    }

    private function createHome()
    {
        $homeModel = new Home();
        $home = new HomeEntity([
            'id' => $homeModel->getLastData()->getId() + 1,
            'title' => $this->request->title,
            'category' => $this->request->category,
            'address' => $this->request->address,
            'price' => $this->request->price,
            'meter' => $this->request->meter,
            'image' => $this->request->image->upload(),
            'description' => $this->request->description,
            'yearofconstruction' => $this->request->yearofconstruction

        ]);

        $homeModel->createData($home);
        Session::flush('message', 'Home Created');
        redirect('index.php', ['action' => 'main']);
    }



    private function showErrors()
    {
?>
        <div class="errors">
            <ul>
                <?php foreach ($this->errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </ul>
        </div>


    <?php

    }


    public function renderPage()
    {
    ?>
        <!DOCTYPE html>
        <html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">
        <!-- BEGIN: Head-->

        <?php $this->getHead()  ?>
        <!-- END: Head-->

        <!-- BEGIN: Body-->

        <body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

            <!-- BEGIN: Header-->
            <?php $this->getHeader() ?>
            <!-- END: Header-->


            <!-- BEGIN: Main Menu-->
            <?php $this->getMainMenu() ?>
            <!-- END: Main Menu-->

            <!-- BEGIN: Content-->
            <div class="app-content content">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                        <div class="content-header-left col-12 mb-2 mt-1">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                    <h5 class="content-header-title float-left pr-1">ثبت خانه</h5>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb p-0 mb-0">
                                            <li class="breadcrumb-item"><a href="index.html"><i class="bx bx-home-alt"></i></a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">صفحات</a>
                                            </li>
                                            <li class="breadcrumb-item active" style="color: black;"> ثبت خانه
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-body"><!-- account setting page start -->
                        <section id="page-account-settings">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <!-- left menu section -->
                                        <div class="col-md-3 mb-2 mb-md-0 pills-stacked">
                                            <ul class="nav nav-pills flex-column">
                                                <li class="nav-item">

                                                </li>

                                            </ul>
                                        </div>
                                        <!-- right content section -->
                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                                                <h2 style="color: black;">ثبت خانه </h2>
                                                                <?php $this->showErrors() ?>
                                                                <hr>
                                                                <form action="<?= url('index.php', ['action' => 'createhome']) ?>" method="post" enctype="multipart/form-data">
                                                                    <div class="media">
                                                                        <a href="javascript:%20void(0);">
                                                                        </a>
                                                                        <div class="media-body mt-25">
                                                                            <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                                <label for="select-files" class="btn btn-sm btn-light-secondary ml-50 mb-50 mb-sm-0">
                                                                                    <span>ارسال تصویر جدید</span>
                                                                                    <input name="image" id="image" type="file">
                                                                                </label>
                                                                            </div>
                                                                            <p class="text-muted ml-1 mt-50"><small>فایل های مجاز: JPG، PNG و GIF. حداکثر اندازه مجاز: 800KB</small></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label>Title:</label>
                                                                                    <input type="text" name="title" class="form-control text-left" placeholder="title..." value="" dir="ltr">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="category">Home Type:</label>

                                                                                    <select name="category" id="category">
                                                                                        <option value="villa">Villa</option>
                                                                                        <option value="apartment">Apartment</option>
                                                                                        <option value="groundfloor">Ground Floor</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="address">Address:</label>
                                                                                    <input type="text" name="address" class="form-control text-left" placeholder="Address.." dir="ltr">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label for="price">Price</label>
                                                                                <input type="text" name="price" class="form-control" placeholder="Price..">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="meter">How Many Meter Are Your Home:</label>

                                                                                    <select name="meter" id="meter">
                                                                                        <?php for ($i = 1; $i <= 600; $i++) : ?>
                                                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                                                        <?php endfor ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="yearofconstruction">What year was your house built?</label>

                                                                                    <select name="yearofconstruction" id="yearofconstruction">
                                                                                        <?php for ($i = 1380; $i <= 1402; $i++) : ?>
                                                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                                                        <?php endfor ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label for="description">Description:</label>
                                                                                    <textarea type="text" name="description" class="form-control text-left" placeholder="Description.." dir="ltr"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                            <button type="submit" name="submit" class="btn btn-black glow mr-sm-1 mb-1">ثبت خانه</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                                <form novalidate>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label>رمز عبور قدیمی</label>
                                                                                    <input type="password" class="form-control text-left" required placeholder="رمز عبور قدیمی" data-validation-required-message="وارد کردن رمز عبور قدیمی الزامی است" dir="ltr">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label>رمز عبور جدید</label>
                                                                                    <input type="password" name="password" class="form-control text-left" placeholder="رمز عبور جدید" required data-validation-required-message="وارد کردن رمز عبور الزامی است" minlength="6" data-validation-minlength-message="حداقل 6 کاراکتر وارد کنید" dir="ltr">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label>تکرار رمز عبور جدید</label>
                                                                                    <input type="password" name="con-password" class="form-control text-left" required data-validation-match-match="password" placeholder="رمز عبور جدید" data-validation-required-message="وارد کردن تکرار رمز عبور الزامی است" minlength="6" dir="ltr">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                            <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">ذخیره تغییرات</button>
                                                                            <button type="reset" class="btn btn-light mb-1">انصراف</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                                <form novalidate>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>بیوگرافی</label>
                                                                                <textarea class="form-control" id="accountTextarea" rows="3" placeholder="اطلاعات بیوگرافی خود را وارد کنید ..."></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label>تاریخ تولد</label>
                                                                                    <input type="text" class="form-control birthdate-picker" required placeholder="تاریخ تولد" data-validation-required-message="وارد کردن تاریخ تولد الزامی است">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>کشور</label>
                                                                                <select class="form-control" id="accountSelect">
                                                                                    <option>آمریکا</option>
                                                                                    <option>هند</option>
                                                                                    <option>کانادا</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>زبان ها</label>
                                                                                <select class="form-control" id="languageselect2" multiple>
                                                                                    <option value="English" selected>انگلیسی</option>
                                                                                    <option value="Spanish">اسپانیایی</option>
                                                                                    <option value="French">فرانسوی</option>
                                                                                    <option value="Russian">روسی</option>
                                                                                    <option value="German">آلمانی</option>
                                                                                    <option value="Arabic" selected>عربی</option>
                                                                                    <option value="Sanskrit">لورم ایپسوم</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <label>تلفن</label>
                                                                                    <input type="text" class="form-control text-left" required placeholder="شماره تلفن" value="(+656) 254 2568" data-validation-required-message="وارد کردن شماره تلفن الزامی است" dir="ltr">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>وب‌سایت</label>
                                                                                <input type="text" class="form-control text-left" placeholder="آدرس وب سایت" dir="ltr">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>موزیک مورد علاقه</label>
                                                                                <select class="form-control" id="musicselect2" multiple>
                                                                                    <option value="Rock">راک</option>
                                                                                    <option value="Jazz" selected>جاز</option>
                                                                                    <option value="Disco">دیسکو</option>
                                                                                    <option value="Pop">پاپ</option>
                                                                                    <option value="Techno">تکنو</option>
                                                                                    <option value="Folk" selected>فولک</option>
                                                                                    <option value="Hip hop">هیپ هاپ</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>فیلم های مورد علاقه</label>
                                                                                <select class="form-control" id="moviesselect2" multiple>
                                                                                    <option value="The Dark Knight" selected>شوالیه تاریکی
                                                                                    </option>
                                                                                    <option value="Harry Potter" selected>هری پاتر</option>
                                                                                    <option value="Airplane!">هواپیما!</option>
                                                                                    <option value="Perl Harbour">پرل هاربور</option>
                                                                                    <option value="Spider Man">مرد عنکبوتی</option>
                                                                                    <option value="Iron Man" selected>مرد آهنی</option>
                                                                                    <option value="Avatar">آواتار</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                            <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">ذخیره تغییرات</button>
                                                                            <button type="reset" class="btn btn-light mb-1">انصراف</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane fade " id="account-vertical-social" role="tabpanel" aria-labelledby="account-pill-social" aria-expanded="false">
                                                                <form>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>توییتر</label>
                                                                                <input type="text" class="form-control text-left" placeholder="افزودن لینک" value="https://www.twitter.com" dir="ltr">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>فیسبوک</label>
                                                                                <input type="text" class="form-control text-left" placeholder="افزودن لینک" dir="ltr">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>گوگل+</label>
                                                                                <input type="text" class="form-control text-left" placeholder="افزودن لینک" dir="ltr">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>لینکدین</label>
                                                                                <input type="text" class="form-control text-left" placeholder="افزودن لینک" value="https://www.linkedin.com" dir="ltr">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>اینستاگرام</label>
                                                                                <input type="text" class="form-control text-left" placeholder="افزودن لینک" dir="ltr">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label>کورا</label>
                                                                                <input type="text" class="form-control text-left" placeholder="افزودن لینک" dir="ltr">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                            <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">ذخیره تغییرات</button>
                                                                            <button type="reset" class="btn btn-light mb-1">انصراف</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane fade" id="account-vertical-connections" role="tabpanel" aria-labelledby="account-pill-connections" aria-expanded="false">
                                                                <div class="row">
                                                                    <div class="col-12 my-2">
                                                                        <a href="javascript:%20void(0);" class="btn btn-info">اتصال به
                                                                            <strong>توییتر</strong></a>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="col-12 my-2">
                                                                        <button class=" btn btn-sm btn-light-secondary float-right">ویرایش</button>
                                                                        <h6>شما به فیسبوک متصل هستید.</h6>
                                                                        <p>Johndoe@gmail.com</p>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="col-12 my-2">
                                                                        <a href="javascript:%20void(0);" class="btn btn-danger">اتصال به
                                                                            <strong>گوگل</strong>
                                                                        </a>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="col-12 my-2">
                                                                        <button class=" btn btn-sm btn-light-secondary float-right">ویرایش</button>
                                                                        <h6>شما به اینستاگرام متصل هستید.</h6>
                                                                        <p>Johndoe@gmail.com</p>
                                                                    </div>
                                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">ذخیره تغییرات</button>
                                                                        <button type="reset" class="btn btn-light mb-1">انصراف</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="account-vertical-notifications" role="tabpanel" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                                                <div class="row">
                                                                    <h6 class="m-1">فعالیت</h6>
                                                                    <div class="col-12 mb-1">
                                                                        <div class="custom-control custom-switch custom-control-inline">
                                                                            <input type="checkbox" class="custom-control-input" checked id="accountSwitch1">
                                                                            <label class="custom-control-label mr-1" for="accountSwitch1"></label>
                                                                            <span class="switch-label">وقتی کسی به مقاله من دیدگاهی ارسال میکند به من ایمیل بزن</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-1">
                                                                        <div class="custom-control custom-switch custom-control-inline">
                                                                            <input type="checkbox" class="custom-control-input" checked id="accountSwitch2">
                                                                            <label class="custom-control-label mr-1" for="accountSwitch2"></label>
                                                                            <span class="switch-label">وقتی کسی به فرم من پاسخ می دهد به من ایمیل بزن</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-1">
                                                                        <div class="custom-control custom-switch custom-control-inline">
                                                                            <input type="checkbox" class="custom-control-input" id="accountSwitch3">
                                                                            <label class="custom-control-label mr-1" for="accountSwitch3"></label>
                                                                            <span class="switch-label">وقتی کسی مرا دنبال می کند به من ایمیل بزن</span>
                                                                        </div>
                                                                    </div>
                                                                    <h6 class="m-1">نرم افزار</h6>
                                                                    <div class="col-12 mb-1">
                                                                        <div class="custom-control custom-switch custom-control-inline">
                                                                            <input type="checkbox" class="custom-control-input" checked id="accountSwitch4">
                                                                            <label class="custom-control-label mr-1" for="accountSwitch4"></label>
                                                                            <span class="switch-label">اخبار و اطلاعیه ها</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-1">
                                                                        <div class="custom-control custom-switch custom-control-inline">
                                                                            <input type="checkbox" class="custom-control-input" id="accountSwitch5">
                                                                            <label class="custom-control-label mr-1" for="accountSwitch5"></label>
                                                                            <span class="switch-label">به روز رسانی هفتگی محصولات</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mb-1">
                                                                        <div class="custom-control custom-switch custom-control-inline">
                                                                            <input type="checkbox" class="custom-control-input" checked id="accountSwitch6">
                                                                            <label class="custom-control-label mr-1" for="accountSwitch6"></label>
                                                                            <span class="switch-label">خلاصه هفتگی وبلاگ</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">ذخیره تغییرات</button>
                                                                        <button type="reset" class="btn btn-light mb-1">انصراف</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- account setting page ends -->
                    </div>
                </div>
            </div>
            <!-- END: Content-->


            <!-- BEGIN: Customizer-->
            <div class="customizer d-none d-md-block"><a class="customizer-close" href="#"><i class="bx bx-x"></i></a><a class="customizer-toggle" href="#"><i class="bx bx-cog bx bx-spin white"></i></a>
                <div class="customizer-content p-2">
                    <h4 class="text-uppercase mb-0 mt-n50">سفارشی سازی قالب</h4>
                    <small>سفارشی سازی کنید و به صورت زنده مشاهده کنید.</small>
                    <hr>
                    <!-- Theme options starts -->
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
