<?php

$pronouns = config('global.pronouns');
$affiliations = config('global.affiliations');
$degreeTypes = config('global.degreeTypes');
$states = config('global.states');
$familyMembers = config('global.familyMembers');


?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="#">
    <title>Alumni Membership Card</title>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
<div class="banner"><h1 id="toptext"> Alumni Membership</h1></div>
    <div class="container" id="alumniForm">
        @if ($errors->any())
            <div class="alert alert-danger ">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form method="post" action="/" novalidate>
        @csrf
        <h2 id="mh1">CSULB Alumni Membership Form</h2>
        <div class="container">
            <p>In our effort to create an inclusive program, as of January 2022 all graduates are now CSULB Alumni Members. We created this simple form for you to claim your membership card. Your membership card can be used to access CSULB Alumni benefits, connecting you further with your alma mater and fellow 49ers. </p>
            <span>* Required Fields</span>
        </div>

        <fieldset>
            <legend>Member Information</legend>
    <div class="form-group">

        <label for="firstName">*First Name:</label>
        <input type="text" name="firstName" id="firstName" class="form-control " value="{{old('firstName')}}" required />
    </div>
    <div class="form-group">
        <label for="middleName">Middle Name:</label>
        <input type="text" name="middleName" id="middleName" class="form-control " value="{{old('middleName')}}" />
    </div>
        <div class="form-group">
            <label for="lastName">*Last Name:</label>
            <input type="text" name="lastName" id="lastName" class="form-control " value="{{old('lastName')}}" required>
        </div>
        <div class="form-group">
            <label for="pronouns">Pronouns:</label>
            <select name="pronouns" id="pronouns" class="form-control ">
            @isset($pronouns)
                    @foreach ($pronouns as $pronoun)
                        @if(old('pronouns') == $pronoun)
                            <option value="{{$pronoun}}" selected>{{$pronoun}}</option>
                            @else
                        <option value="{{$pronoun}}">{{$pronoun}}</option>
                        @endif
                    @endforeach
            @endisset
            </select>
        </div>
        <div class="form-group">
            <label for="nameWhileAtCSULB">Name while attending CSULB if different:</label>
            <input type="text" name="nameWhileAtCSULB" id="nameWhileAtCSULB" class="form-control "  value="{{old('nameWhileAtCSULB')}}"/>
        </div>
        <div class="form-group">
            <label for="alumniEmail">*Email:</label>
            <input type="email" name="alumniEmail" id="alumniEmail" class="form-control " value="{{old('alumniEmail')}}" required  />
        </div>
        <div class="form-group">
            <label for="affiliation">*Affiliation:</label>
            <select name="affiliation" id="affiliation" class="form-control " required >
                <option value="" (!@isset($affiliations)) selected @endif>Make a selection</option>
                @isset($affiliations)
                    @foreach ($affiliations as $aff)
                        @if(old('affiliation') == $aff)
                            <option value="{{$aff}}" selected>{{$aff}}</option>
                        @else
                            <option value="{{$aff}}">{{$aff}}</option>
                        @endif
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="form-group">
            <label for="gradYear">Grad Year:</label>
            <input type="text" name="gradYear" id="gradYear" class="form-control " value="{{old('gradYear')}}" />
        </div>
        <div class="form-group">
            <label for="degreeType">Degree Type</label>
            <select name="degreeType" id="degreeType" class="form-control ">
                @isset($degreeTypes)
                    @foreach ($degreeTypes as $dt)
                        @if(old('degreeType') == $dt)
                            <option value="{{$dt}}" selected>{{$dt}}</option>
                        @else
                            <option value="{{$dt}}">{{$dt}}</option>
                        @endif
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="form-group">
            <label for="major">Major</label>
            <input type="text" name="major" id="major" class="form-control " value="{{old('major')}}">
        </div>
        <div class="form-group">
            <label for="familyMember">Beach Family members</label>
            <select name="familyMember" id="familyMember" class="form-control " required>
                @isset($familyMembers)
                    @foreach ($familyMembers as $member)
                        @if(old('familyMember') == $member  )
                            <option value="{{$member}}" selected>{{$member}}</option>
                        @else
                            <option value="{{$member}}">{{$member}}</option>
                        @endif
                    @endforeach
                @endisset
            </select>

        </div>

        <div class="form-group">
            <label for="names">Names:</label>
            <input type="text" name="names" id="names" class="form-control " value="{{old('names')}}" />
        </div>
        </fieldset>
        <fieldset class="Contact Information">
            <legend >Contact Information</legend>
        <div class="form-group">
            <label for="homePhone">Home Phone</label>
            <input type="tel" name="homePhone" id="homePhone" class="form-control " value="{{old('homePhone')}}" />
        </div>

        <div class="form-group">
            <label for="cellPhone">*Cell Phone</label>
            <input type="tel" name="cellPhone" id="cellPhone" class="form-control " value="{{old('cellPhone')}}" required/>
        </div>

        <div class="form-group">
            <label for="streetAddressOne">*Street Address Line 1</label>
            <input type="text" name="streetAddressOne" id="streetAddressOne" class="form-control " value="{{old('streetAddressOne')}}"required />
        </div>

        <div class="form-group">
            <label for="streetAddressTwo">Street Address Line 2</label>
            <input type="text" name="streetAddressTwo" id="streetAddressTwo" class="form-control " value="{{old('streetAddressTwo')}}" />
        </div>

            <div class="form-group">
                <label for="city">*City</label>
                <input type="text" name="city" id="city" class="form-control " value="{{old('city')}}" required />
            </div>
            <div class="form-group">
                <label for="state">*State</label>
                <select name="state" id="state" class="form-control " required>
                    @isset($states)
                        @foreach ($states as $stateAbrev => $stateName)
                            @if(old('state') == $stateAbrev  )
                                <option value="{{$stateAbrev}}" selected>{{$stateName}}</option>
                            @else
                                <option value="{{$stateAbrev}}">{{$stateName}}</option>
                            @endif
                        @endforeach
                    @endisset

                </select>
            </div>
            <div class="form-group">
                <label for="zip">*Zip</label>
            <input type="text" name="zip" id="zip" class="form-control " value="{{old('zip')}}" required />
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" class="form-control " value="{{old('country')}}" />
            </div>

            <div class="form-group">
                <label for="linkedInProfile">LinkedIn Profile</label>
                <input type="text" name="linkedInProfile" id="linkedInProfile" class="form-control " value="{{old('linkedInProfile')}}">
            </div>

            <div class="form-group"><label for="facebookProfile">Facebook Profile</label>
                <input type="text" name="facebookProfile" id="facebookProfile" class="form-control " value="{{old('facebookProfile')}}" ></div>

            <div class="form-group"><label for="twitterProfile">Twitter Profile</label>
                <input type="text" name="twitterProfile" id="twitterProfile" class="form-control " value="{{old('twitterProfile')}}">
            </div>

            <div class="form-group"><label for="instagramProfile">Instagram Profile</label>
                <input type="text" name="instagramProfile" id="instagramProfile" class="form-control " value="{{old('instagramProfile')}}">
            </div>

        </fieldset>
        <fielset>

            <legend>Business Information</legend>
            <div class="form-group"><label for="businessEmployer">Employer</label>
                <input type="text" name="businessEmployer" id="businessEmployer" class="form-control " value="{{old('businessEmployer')}}"></div>

            <div class="form-group"><label for="jobTitle">Job Title</label>
                <input type="text" name="jobTitle" id="jobTitle" class="form-control " value="{{old('jobTitle')}}"></div>
            <div class="form-group"><label for="businessPhoneNumber">Business Phone</label>
                <input type="text" name="businessPhoneNumber" id="businessPhoneNumber" class="form-control " value="{{old('businessPhoneNumber')}}"></div>
            <div class="form-group"><label for="businessEmail">Business Email</label>
                <input type="email" name="businessEmail" id="businessEmail" class="form-control " value="{{old('businessEmail')}}"></div>
            <div class="form-group"><label for="businessAddress">Business Address</label>
                <input type="text" name="businessAddress" id="businessAddress" class="form-control " value="{{old('businessAddress')}}"></div>
            <div class="form-group"><label for="checkBox">Opportunities to connect and get involved at The Beach. I am interested in receiving more information on:</label>
            </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="opportunities[]" id="opportunityChkBox1" class="form-check-input" value="Sharing my expertise and being a guest speaker">
                    <label for="opportunityChkBox1">Sharing my expertise and being a guest speaker</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="opportunities[]" id="opportunityChkBox2" class="form-check-input" value="Receiving information on mentoring on Beach Nexus">
                    <label for="opportunityChkBox2">Receiving information on mentoring on Beach Nexus</label>
                </div>
                    <div class="form-group form-check">
                    <label for="opportunityChkBox3"><input type="checkbox" name="opportunities[]" id="opportunityChkBox3" class="form-check-input" value="Provide Internships">Provide Internships</label>
                    </div>
                        <div class="form-group form-check">
                    <label for="opportunityChkBox4"><input type="checkbox" name="opportunities[]" id="opportunityChkBox4" class="form-check-input" value="Making a gift to CSULB">Making a gift to CSULB</label>
                </div>

        </fielset>
            <div class="form-submit">
                <input type="submit" class="btn btn-dark" name="sendForm" id="sendForm" value="Submit" />
            </div>


    </form>


</div>
<footer class="footer">
    <div class="container text-center">
        <span>CSULB Alumni</span>
    </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>
