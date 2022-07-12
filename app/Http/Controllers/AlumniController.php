<?php

namespace App\Http\Controllers;

use App\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\PhoneNumber;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('alumni');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $messages = [
            'alumniEmail.unique' => 'The alumni email has already been taken. If you wish to print another membership card, navigate to the <a href="/alumni-card/retrieve">Retrieve Card page.</a>',
        ];

       preg_replace( '/[^0-9]/', '', $request->input('cellPhone') );
       preg_replace( '/[^0-9]/', '', $request->input('homePhone') );
       preg_replace( '/[^0-9]/', '', $request->input('businessPhoneNumber') );


        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'alumniEmail' => 'required|unique:alumni|email',
            'affiliation' => 'required',
            'cellPhone' => 'required|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/',

            'streetAddressOne' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|integer|digits:5',
        ], $messages );

/*   'homePhone' =>'digits:10',
            'businessPhoneNumber' => 'digits:10',*/

        if ($validator->fails()) {

            return redirect('/')->withErrors($validator)->withInput();
        }
        else
        {
            $alumni = new Alumni;
            $opportun=  ($request->input('opportunities') ? implode (',',$request->input('opportunities')): '');


            // Create Image From Existing File
            $jpg_image = imagecreatefromjpeg(base_path('/public/img').'/mcard_final.jpg');

// Allocate A Color For The Text
            $white = imagecolorallocate($jpg_image, 255, 255, 255);

// Set Path to Font File
            $font_path = base_path(). '/public/Kanit-Bold.ttf';
            $degree_font_path = base_path().'/public/Kanit-ExtraLight.ttf';
//echo "Font Path " . $font_path . "<br />";
// Set Text to Be Printed On Image
            $alumniText = $request->input('firstName'). ' '. $request->input('lastName');
            $degree = ($request->input('degreeType') ? $request->input('degreeType') : '');
            $dyear = ($request->input('gradYear') ? $request->input('gradYear') : '');
            $degreeText = $degree. " ".$dyear;
            $stlen = strlen($alumniText);
            $xpos = ($stlen < 10 ? 440 : 350);

// Print Text On Image
            imagettftext($jpg_image, 18, 0, $xpos, 390, $white, $font_path, $alumniText);
            imagettftext($jpg_image, 18, 0, $xpos, 415, $white, $degree_font_path, $degreeText);

// Send Image to Browser
            $imageOffset = time();
            $imageLink = 'testimage' . $imageOffset .'.jpg';
            imagejpeg($jpg_image,$imageLink,100);

// Clear Memory
            imagedestroy($jpg_image);

            $alumni->firstName = $request->input('firstName');
            $alumni->middleName = $request->input('middleName');
            $alumni->lastName = $request->input('lastName');
            $alumni->pronouns = $request->input('pronouns');
            $alumni->nameWhileAttending  = $request->input('nameWhileAtCSULB');
            $alumni->alumniEmail = $request->input('alumniEmail');
            $alumni->affiliation = $request->input('affiliation');
            $alumni->gradYear = $request->input('gradYear');
            $alumni->degreeType = $request->input('degreeType');
            $alumni->major = $request->input('major');
            $alumni->beachFamilyMember = $request->input('familyMember');
            $alumni->beachName = $request->input('names');
            $alumni->homePhone = $request->input('homePhone');
            $alumni->cellPhone = $request->input('cellPhone');
            $alumni->streetAddressOne = $request->input('streetAddressOne');
            $alumni->streetAddressTwo = $request->input('streetAddressTwo');
            $alumni->city = $request->input('city');
            $alumni->state = $request->input('state');
            $alumni->zip =  $request->input('zip');
            $alumni->country = $request->input('country');
            $alumni->linkedInProfile = $request->input('linkedInProfile');
            $alumni->facebookProfile = $request->input('facebookProfile');
            $alumni->twitterProfile = $request->input('twitterProfile');
            $alumni->instagramProfile = $request->input('instagramProfile');
            $alumni->businessEmployer = $request->input('businessEmployer');
            $alumni->jobTitle = $request->input('jobTitle');
            $alumni->businessPhoneNumber = $request->input('businessPhoneNumber');
            $alumni->businessEmail = $request->input('businessEmail');
            $alumni->businessAddress = $request->input('businessAddress');

            $alumni->digitalCardLink = $imageLink;
            $alumni->opportunities = $opportun;
            $alumni->membershipToken = rand(0,100000);
            $alumni->save();


             return view('alumni-success')->with('message', 'completed')->with('alumniImageLink', $imageLink);

        }

    }

    public function retrieve(Request $request)
    {
        $alumniEmail = $request->input('alumniEmail');


        if(empty($alumniEmail))
        {
            return redirect()->back()->withErrors(['msg' => 'You must enter an alumni email.']);
        }
        else {

            $alumniSection = Alumni::where('alumniEmail', $alumniEmail)->first();

           if($alumniSection != NULL) {
               $digitalCardLink = $alumniSection->digitalCardLink;
               return view('alumni-success')->with('message', 'retrieved')->with('alumniImageLink', $digitalCardLink);
           }
           else
           {
               return redirect()->back()->withErrors(['msg' => 'The email provided did not return any records. If you wish to register for a membership card, please navigate to the <a href="/alumni-card/">alumni-card page</a> to fill out the form.']);
           }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
