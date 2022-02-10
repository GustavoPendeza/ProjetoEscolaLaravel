<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Método responsável por retornar a página index de home
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('site.home.index');
    }
}
