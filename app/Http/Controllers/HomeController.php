<?php

namespace App\Http\Controllers;

use App\Exports\AlumniExport;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    /**
     * Show the application dashboard.
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
