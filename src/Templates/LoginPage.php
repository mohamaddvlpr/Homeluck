<?php

namespace Web\Templates;

use Web\Model\User;
use Web\Classes\Auth;

class LoginPage extends Template
{

    private $errors = [];

    public function __construct()
    {
        parent::__construct();

        if (Auth::isAuthenticated())
            redirect('index.php', ['action' => 'main']);

        $this->title = $this->setting->getTitle() . ' - Login To Website';

        if ($this->request->isPostMethod()) {
            $data = $this->validator->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6']
            ]);
            if (!$data->hasErrors()) {
                $userModel = new User();
                $user = $userModel->authenticatedUser($this->request->email, $this->request->password);
                if ($user) {
                    Auth::loginUser($user);
                    redirect('index.php', ['action' => 'main']);
                } else {
                    $this->errors[] = 'Invalid Credensial';
                }
            } else {
                $this->errors = $data->getErrors();
            }
        }
    }



    private function showError()
    {

        if (count($this->errors)) {
?>
            <div class="alert bg-rgba-red">
                <ul>
                    <?php foreach ($this->errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php

        }
    }


    public function renderPage()
    {
        ?>
        <!DOCTYPE html>
        <html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">
        <!-- BEGIN: Head-->
        <?php $this->getHead() ?>

        <body class="horizontal-layout horizontal-menu navbar-static 1-column   footer-static bg-full-screen-image  blank-page blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
            <div class="app-content content">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- login page start -->
                        <section id="auth-login" class="row flexbox-container">
                            <div class="col-xl-8 col-11">
                                <div class="card bg-authentication mb-0">
                                    <div class="row m-0">
                                        <!-- left section-login -->
                                        <div class="col-md-6 col-12 px-0">
                                            <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                                <div class="card-header pb-1">
                                                    <div class="card-title">
                                                        <h4 class="text-center mb-2"><?= $this->setting->getTitle() ?></h4>
                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="d-flex flex-md-row flex-column justify-content-around">
                                                            <a href="#" class="btn btn-social btn-google btn-block font-small-3 mr-md-1 mb-md-0 mb-1">
                                                                <i class="bx bxl-google font-medium-3"></i><span class="pl-50 d-block text-center">Google</span></a>
                                                            <a href="#" class="btn btn-social btn-block mt-0 btn-facebook font-small-3">
                                                                <i class="bx bxl-facebook-square font-medium-3"><a href="https://www.instagram.com/mamad._.dry/"></a></i><span class="pl-50 d-block text-center">Facebook</span></a>
                                                        </div>
                                                        <div class="divider">
                                                            <div class="divider-text text-uppercase text-muted"><small>Please Login With Your Email</small>

                                                            </div>
                                                            <?php $this->showError() ?>
                                                        </div>
                                                        <form method="post" action="<?= Auth::isAuthenticated() ? url('index.php') : url('index.php', ['action' => 'login']); ?>">
                                                            <div class="form-group mb-50">

                                                                <label class="text-bold-700" for="exampleInputEmail1">Email:</label>
                                                                <input type="email" name="email" class="form-control text-left" id="email" placeholder="Email Address" dir="ltr">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="text-bold-700" for="exampleInputPassword1">Password:</label>
                                                                <input type="password" name="password" class="form-control text-left" id="password" placeholder="Password" dir="ltr">
                                                            </div>
                                                            <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                                <div class="text-left">
                                                                    <div class="checkbox checkbox-sm">
                                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-black glow w-100 position-relative">Login<i id="icon-arrow" class="bx bx-left-arrow-alt"></i></button>
                                                        </form>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- right section image -->
                                        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                            <div class="card-content">
                                                <img class="img-fluid" src="<?= asset("images/pages/login.png") ?>" alt="branding logo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- login page ends -->
                    </div>
                </div>
            </div>
            <!-- END: Content-->


            <!-- BEGIN: Vendor JS-->
            <script src=<?= asset("vendors/js/vendors.min.js") ?>></script>
            <script src=<?= asset("fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js") ?>></script>
            <script src=<?= asset("fonts/LivIconsEvo/js/LivIconsEvo.defaults.js") ?>></script>
            <script src=<?= asset("fonts/LivIconsEvo/js/LivIconsEvo.min.js") ?>></script>
            <!-- BEGIN Vendor JS-->

            <!-- BEGIN: Page Vendor JS-->
            <script src=<?= asset("vendors/js/ui/jquery.sticky.js") ?>></script>
            <!-- END: Page Vendor JS-->

            <!-- BEGIN: Theme JS-->
            <script src=<?= asset("js/scripts/configs/horizontal-menu.js") ?>></script>
            <script src=<?= asset("js/core/app-menu.js") ?>></script>
            <script src=<?= asset("js/core/app.js") ?>></script>
            <script src=<?= asset("js/scripts/components.js") ?>></script>
            <script src=<?= asset("js/scripts/footer.js") ?>></script>
            <!-- END: Theme JS-->

            <!-- BEGIN: Page JS-->
            <!-- END: Page JS-->

        </body>
        <!-- END: Body-->

        </html>

<?php
    }
}


?>