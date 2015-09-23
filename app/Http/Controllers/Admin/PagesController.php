<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Session;

class PagesController extends Controller {

    public function index() {

        return view(Config('constants.adminView') . '.dashboard');
    }

}
