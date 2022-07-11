<?php

namespace App\Http\Controllers;

use App\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'alumniEmail' => 'required|unique:alumni',
            'affiliation' => 'required',
            'cellPhone' => 'required',
            'streetAddressOne' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ]);

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
            imagettftext($jpg_image, 18, 0, $xpos, 410, $white, $font_path, $alumniText);
            imagettftext($jpg_image, 18, 0, $xpos, 435, $white, $degree_font_path, $degreeText);

// Send Image to Browser
            $imageOffset = time();
            $imageLink = '/alumin-card/testimage' . $imageOffset .'.jpg';
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


             return view('alumni-success')->with('message', 'IT WORKS!')->with('alumniImageLink', $imageLink);

        }

    }

    public function retrieve(Request $request)
    {
        $alumniEmail = $request->input('alumniEmail');


        if(empty($alumniEmail))
        {
            return redirect()->back()->withErrors(['msg' => 'You must entered an alumni email.']);
        }
        else {

            $alumniSection = Alumni::where('businessEmail', $alumniEmail)->first();

           if($alumniSection != NULL) {
               $digitalCardLink = $alumniSection->digitalCardLink;
               return view('alumni-success')->with('message', 'IT WORKS!')->with('alumniImageLink', $digitalCardLink);
           }
           else
           {
               return redirect()->back()->withErrors(['msg' => 'You must entered a valid alumni email.']);
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
