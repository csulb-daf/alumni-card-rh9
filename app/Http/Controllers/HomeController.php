<?php

namespace App\Http\Controllers;

use App\Exports\AlumniExport;
use Illuminate\Http\Request;
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
    public function index()
    {
        return view('home');
    }

    public function export()
    {
        $headers = ['Alumni ID',
            'Alumni First Name',
            'Alumni Middle Initial',
            'Alumni Last Name',
            'Alumni Pronouns',
            'Alumni Name With Attending',
            'Alumni Email',
            'Alumni Affiliation',
            'Alumni Grad Year',
            'Alumni Degree Type',
            'Alumni Major',
            'Alumni Beach Family Member',
            'Alumni Beach Name',
            'Alumni Home Phone',
            'Alumni Cell Phone',
            'Alumni Street Address One',
            'Alumni Street Address Two',
            'Alumni City',
            'Alumni State',
            'Alumni Zip',
            'Alumni Country',
            'Alumni LinkedIn Profile',
            'Alumni Facebook Profile',
            'Alumni Twitter Profile',
            'Alumni Instagram Profile',
            'Alumni Membership Token',
            'Alumni Business Employer',
            'Alumni Job Title',
            'Alumni Business Phone Number',
            'Alumni Business Email',
            'Alumni Business Address',
            'Alumni Opportunities',
            'Alumni Digital Card Link',
            'Alumni Created Date',
            'Alumni Updated Link'
            ];
        return Excel::download(new AlumniExport, 'alumni.xlsx',null,  $headers);


    }
}
