<?php
// src/Controller/TopController.php

namespace App\Controller;

class TopController extends AppController {

    function top() {
        $this->render('top', 'top_layout');
    }
}
