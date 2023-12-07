<?php

session_start();

require "./vendor/autoload.php";

use Web\Classes\Auth;
use Web\Classes\Request;
use Web\Exceptions\DoesNotExistsException;
use Web\Exceptions\NotFoundPage;
use Web\Templates\CategoryPage;
use Web\Templates\CreateHomePage;
use Web\Templates\LoginPage;
use Web\Templates\MainPage;
use Web\Templates\SearchPage;
use Web\Templates\SinglePage;
use Web\Templates\ErrorPage;
use Web\Templates\HomePage;
use Web\Templates\NotFoundException;




try {
    $request = new Request();
    switch ($request->get('action')) {
        case 'single';
            $page = new SinglePage();
            break;

        case 'search';
            $page = new SearchPage();
            break;

        case 'category';
            $page = new CategoryPage();
            break;

        case 'login';
            $page = new LoginPage();
            break;

        case 'main';
            $page = new MainPage();
            break;

        case 'logout':
            Auth::logoutUser();
            break;

        case 'createhome':
            $page = new CreateHomePage();
            break;

        case null;
            $page = new HomePage();
            break;

        default:
            throw new NotFoundPage("Page Not Found");
    }
} catch (DoesNotExistsException | NotFoundPage $exception) {
    $page = new NotFoundException($exception->getMessage());
} catch (Exception $exception) {
    $page = new ErrorPage($exception->getMessage());
}
$page->renderPage();
