<?php
namespace App\Controller;

/**
 * トップページ
 * Class TopController
 * @package App\Controller
 */
class TopController extends AppController {

    function top() {
        $this->render('top', 'top_layout');
    }
}
