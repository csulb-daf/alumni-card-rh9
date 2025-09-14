<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Exports\AlumniExport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        return view('home');
    }

    public function export()
    {
        $dataTimestamp = date('m_d_Y');

        return Excel::download(new AlumniExport, 'alumni export '.$dataTimestamp.'.xlsx');

    }
}
