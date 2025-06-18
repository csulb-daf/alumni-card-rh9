<?php

namespace App\Exports;

use App\Alumni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumniExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Alumni::all();
    }

    public function headings(): array
    {
        return [
            'Alumni ID',
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
            'Alumni Updated Link'];
    }
}
