<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $messages = [
            'alumniEmail.unique' => 'The alumni email has already been taken. If you wish to print another membership card, navigate to the <a href="/alumni-card/retrieve">Retrieve Card page.</a>',
        ];

        preg_replace('/[^0-9]/', '', $request->input('cellPhone'));
        preg_replace('/[^0-9]/', '', $request->input('homePhone'));
        preg_replace('/[^0-9]/', '', $request->input('businessPhoneNumber'));
        //
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'alumniEmail' => 'required|unique:alumni|email',
            'affiliation' => 'required',
            'cellPhone' => 'required|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/',
            'streetAddressOne' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ], $messages);

        /*   'homePhone' =>'digits:10',
                    'businessPhoneNumber' => 'digits:10',*/

        if ($validator->fails()) {

            return redirect('/')->withErrors($validator)->withInput();
        } else {
            $alumni = new Alumni;
            $opportun = ($request->input('opportunities') ? implode(',', $request->input('opportunities')) : '');

            // Create Image From Existing File
            $jpg_image = imagecreatefromjpeg(base_path('/public/img').'/mcard_final.jpg');

            // Allocate A Color For The Text
            $white = imagecolorallocate($jpg_image, 255, 255, 255);
            $gray = imagecolorallocate($jpg_image, 219, 219, 219);

            // Set Path to Font File
            $font_path = base_path().'/public/Kanit-Bold.ttf';
            $degree_font_path = base_path().'/public/Kanit-ExtraLight.ttf';
            // echo "Font Path " . $font_path . "<br />";
            // Set Text to Be Printed On Image
            $alumniText = $request->input('firstName').' '.$request->input('lastName');
            $degree = ($request->input('degreeType') ? $request->input('degreeType') : '');
            $dyear = ($request->input('gradYear') ? $request->input('gradYear') : '');
            $expireYear = date('Y') + 5;
            $expireText = 'Exp. '.date('m').'/'.$expireYear;
            $degreeText = $degree.' '.$dyear;
            $stlen = strlen($alumniText);
            $xpos = ($stlen < 10 ? 425 : 335);

            // Print Text On Image
            imagettftext($jpg_image, 9, 0, 140, 400, $gray, $font_path, $expireText);
            imagettftext($jpg_image, 18, 0, $xpos, 390, $white, $font_path, $alumniText);
            imagettftext($jpg_image, 18, 0, $xpos, 415, $white, $degree_font_path, $degreeText);

            // Send Image to Browser
            $imageOffset = time();
            $imageLink = 'alumni_image_'.$imageOffset.'.jpg';
            imagejpeg($jpg_image, $imageLink, 100);

            $imageSize = filesize($imageLink);
            $imageType = exif_imagetype($imageLink);
            //  var_dump($imageType);

            // Clear Memory
            imagedestroy($jpg_image);

            $alumni->firstName = $request->input('firstName');
            $alumni->middleName = $request->input('middleName');
            $alumni->lastName = $request->input('lastName');
            $alumni->pronouns = $request->input('pronouns');
            $alumni->nameWhileAttending = $request->input('nameWhileAtCSULB');
            $alumni->alumniEmail = $request->input('alumniEmail');
            $alumni->affiliation = $request->input('affiliation');
            $alumni->gradYear = $request->input('gradYear');
            $alumni->degreeType = $request->input('degreeType');
            $alumni->major = $request->input('major');
            $alumni->degreeType2 = $request->input('degreeType2');
            $alumni->major2 = $request->input('major2');
            $alumni->beachFamilyMember = $request->input('familyMember');
            $alumni->beachName = $request->input('names');
            $alumni->homePhone = $request->input('homePhone');
            $alumni->cellPhone = $request->input('cellPhone');
            $alumni->streetAddressOne = $request->input('streetAddressOne');
            $alumni->streetAddressTwo = $request->input('streetAddressTwo');
            $alumni->city = $request->input('city');
            $alumni->state = $request->input('state');
            $alumni->zip = $request->input('zip');
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
            $alumni->membershipToken = rand(0, 100000);
            $alumni->save();

            $htmlEmailTxt = '<html>
                <head>
                <style type="text/css" media="screen">
                body {font-family:Arial,Helvetica, sans-serif;}
                h1{font-size:1.25em;}
                h2{font-size:1.15em;}
                h3{font-size:1.05em;border-bottom:solid 1px #555555;padding:1em 1em 0 1em;}
                p{line-height: 1.75em;font-size:.9em;}
                .under{border-bottom:2px solid #333;}
                </style>
                </head>
                <body>
                <table role="presentation" id="email_tbl" width="650" align="left" border="0" cellpadding="0" cellspacing="0" >
                <tr><td>
<p>Thank you for claiming your CSULB Alumni digital Membership card! With a network of more than 369,000 proud alumni, <a href="https://www.csulb.edu/alumni">CSULB Alumni</a> is a lifelong partner that will help you stay connected to the people, programs, and activities that mean the most to you.</p>
 <p>Please save this card image or print this page to access your <a href="https://www.csulb.edu/alumni/benefits">Membership benefits.</a></p>
<p>Looking to get involved in CSULB Alumni programs? Mentor CSULB students and network with Alumni and Community members on <a href="https://beachnexus.peoplegrove.com/v2/">Beach Nexus</a>, our online social networking platform for the CSULB Community. You can also view our 49er Industry Chat <a href="https://www.youtube.com/playlist?list=PLC-sCO7Agl8ILjydeVA5_WZExRdzn2xbG">video library</a> to learn from CSULB Alumni.</p>
<p>Please be sure to keep CSULB updated with your news, successes, and <a href="https://www.csulb.edu/alumni/form/update-your-information">contact information</a> (especially important so that you can stay up-to-date on the many exciting happenings at The Beach).</p>
<p>To volunteer for an upcoming event or opportunity, <a href="https://csulbalumni.galaxydigital.com/" title="Create you Volunteer profile">create your Alumni volunteer profile.</a></p>
<p>If you\'d like to make a gift to CSULB at this time to the designation of your choosing, please visit <a href="https://www.csulb.edu/give">www.csulb.edu/give.</a></p>
<p>If you have any questions, please contact us at <a href="mailto:alumni@csulb.edug">alumni@csulb.edu</a> or 562.985.5252.</p>

<p>With Beach Pride,</p>
<p>Ilana Tel-Oren, \'11</p>
<p>Alumni Engagement Associate</p>
</td></tr></table></body></html>';

            $this->sendNotification('Message for Alumni', $htmlEmailTxt, $alumni->alumniEmail, $imageLink, $imageSize);

            return view('/alumni-success')->with('message', 'completed')->with('alumniImageLink', $imageLink);

        }

    }

    public function sendNotification($subject, $messageNew, $sentEmail, $fileName, $size)
    {

        //        $handle = fopen($fileName, "r"); // set the file handle only for reading the file
        //        $content = fread($handle, $size); // reading the file
        //
        //        //var_dump($content);
        //        fclose($handle);                 // close upon completion
        //
        //       // exit();
        //
        //        $encoded_content = chunk_split(base64_encode($content));
        //        $boundary = md5("random"); // define boundary with a md5 hashed value
        //        // Multiple recipients
        //        $to = $sentEmail;
        //
        //        $headers[] = 'From: <CSULB-Alumni@csulb.edu>';
        //        $headers[] = 'MIME-Version: 1.0';
        //        $headers[] = 'Content-Type: multipart/mixed;';
        //        $headers[] = 'boundary = $boundary\r\n';
        //        // Additional headers
        //
        //        $body = "--$boundary\r\n";
        //        $body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        //        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        //        $body .= chunk_split(base64_encode($message));
        //
        //        //attachment
        //        $body .= "--$boundary\r\n";
        //        $body .="Content-Type: application/octet-stream; name=".$fileName."\r\n";
        //        $body .="Content-Disposition: attachment; filename=".$fileName."\r\n";
        //        $body .="Content-Transfer-Encoding: base64\r\n";
        //        $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
        //        $body .= $encoded_content; // Attaching the encoded file with email

        $from_email = 'alumni@csulb.edu'; // from mail, sender email address
        $to = $sentEmail; // 'stevecreed@gmail.com'; //recipient email address

        // Load POST data from HTML form
        $sender_name = 'CSULB Alumni'; // sender name
        $reply_to_email = 'alumni@csulb.edu'; // sender email, it will be used in "reply-to" header
        $subject = 'CSULB Alumni Membership Card'; // subject for the email
        $message = $messageNew; // body of the email

        /*Always remember to validate the form fields like this
        if(strlen($sender_name)<1)
        {
            die('Name is too short or empty!');
        }
        */
        // Get uploaded file data using $_FILES array
        //        $tmp_name = $_FILES['attachment']['tmp_name']; // get the temporary file name of the file on the server
        //        $name     = $_FILES['attachment']['name']; // get the name of the file
        //        $size     = $_FILES['attachment']['size']; // get size of the file for size validation
        //        $type     = $_FILES['attachment']['type']; // get type of the file
        //        $error     = $_FILES['attachment']['error']; // get the error (if any)

        // validate form field for attaching the file
        //        if($error > 0)
        //        {
        //            die('Upload error or No files uploaded');
        //        }

        // read from the uploaded file & base64_encode content
        $handle = fopen($fileName, 'r'); // set the file handle only for reading the file
        $content = fread($handle, $size); // reading the file
        fclose($handle);                 // close upon completion

        $encoded_content = chunk_split(base64_encode($content));
        $boundary = md5('random'); // define boundary with a md5 hashed value

        // header
        $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
        $headers .= 'From:'.$from_email."\r\n"; // Sender Email
        $headers .= 'Reply-To: '.$reply_to_email."\r\n"; // Email address to reach back
        $headers .= 'Content-Type: multipart/mixed;'; // Defining Content-Type
        $headers .= "boundary = $boundary\r\n"; // Defining the Boundary

        // plain text
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($message));

        // attachment
        $body .= "--$boundary\r\n";
        $body .= 'Content-Type: image/jpg; name='.$fileName."\r\n";
        $body .= 'Content-Disposition: attachment; filename='.$fileName."\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= 'X-Attachment-Id: '.rand(1000, 99999)."\r\n\r\n";
        $body .= $encoded_content; // Attaching the encoded file with email
        // Mail it
        mail($to, $subject, $body, $headers);

    }

    public function sendEmail()
    {
        $mail = '
';
    }

    public function retrieve(Request $request)
    {
        $alumniEmail = $request->input('alumniEmail');

        if (empty($alumniEmail)) {
            return redirect()->back()->withErrors(['msg' => 'You must enter an alumni email.']);
        } else {

            $alumniSection = Alumni::where('alumniEmail', $alumniEmail)->first();

            if ($alumniSection != null) {
                $digitalCardLink = $alumniSection->digitalCardLink;

                return view('alumni-success')->with('message', 'retrieved')->with('alumniImageLink', $digitalCardLink);
            } else {
                return redirect()->back()->withErrors(['msg' => 'The email provided did not return any records. If you wish to register for a membership card, please navigate to the <a href="/alumni-card/">alumni-card page</a> to fill out the form.']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
