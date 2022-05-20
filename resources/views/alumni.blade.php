<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Grad Card</title>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


    <form method="post" action="/" novalidate>
        @csrf
        <h1>CSULB Alumni Membership Form</h1>
        <div class="container">
            <p>In our effort to create an inclusive program, as of January 2022 all graduates are now CSULB Alumni Members. We created this simple form for you to claim your membership card. Your membership card can be used to access CSULB Alumni benefits, connecting you further with your alma mater and fellow 49ers. </p>
            <span>* Required Fields</span>
        </div>

        <fieldset>
            <legend>Member Information</legend>
    <div class="form-group">

        <label for="firstName">*First Name:</label>
        <input type="text" name="firstName" id="firstName" class="form-control" value="{{old('firstName')}}" required />
    </div>
    <div class="form-group">
        <label for="middleName">Middle Name:</label>
        <input type="text" name="middleName" id="middleName" class="form-control" value="{{old('middleName')}}" />
    </div>
        <div class="form-group">
            <label for="lastName">*Last Name:</label>
            <input type="text" name="lastName" id="lastName" class="form-control" value="{{old('lastName')}}" required>
        </div>
        <div class="form-group">
            <label for="pronouns">Pronouns:</label>
            <select name="pronouns" id="pronouns" class="form-control">
                <option value="He/Him/His">He/Him/His</option>
                <option value="She/Her/Hers">She/Her/Hers</option>
                <option value="They/Them/Theirs">They/Them/Theirs</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nameWhileAtCSULB">Name while attending CSULB if different:</label>
            <input type="text" name="nameWhileAtCSULB" id="nameWhileAtCSULB" class="form-control"  value="{{old('nameWhileAtCSULB')}}"/>
        </div>
        <div class="form-group">
            <label for="alumniEmail">*Email:</label>
            <input type="email" name="alumniEmail" id="alumniEmail" class="form-control" value="{{old('alumniEmail')}}" required  />
        </div>
        <div class="form-group">
            <label for="affiliation">*Affiliation:</label>
            <select name="affiliation" id="affiliation" class="form-control" required >
                <option value="Alumni">Alumni</option>
                <option value="Student">Student</option>
                <option value="Friend">Friend</option>
            </select>
        </div>
        <div class="form-group">
            <label for="gradyear">Grad Year:</label>
            <input type="text" name="gradYear" id="gradYear" class="form-control" />
        </div>
        <div class="form-group">
            <label for="degreeType">Degree Type</label>
            <select name="degreeType" id="degreeType" class="form-control">
                <option value="BA">BA</option>
                <option value="MA">MA</option>
            </select>
        </div>
        <div class="form-group">
            <label for="major">Major</label>
            <input type="text" name="major" id="major" class="form-control">
        </div>
        <div class="form-group">
            <label for="familyMember">Beach Family members</label>
            <input type="text" name="familyMember" id="familyMember" class="form-control">


        </div>

        <div class="form-group">
            <label for="names">Names:</label>
            <input type="text" name="names" id="names" class="form-control" />
        </div>
        </fieldset>
        <fieldset class="Contact Information">
            <legend >Contact Information</legend>
        <div class="form-group">
            <label for="homePhone">Home Phone</label>
            <input type="tel" name="homePhone" id="homePhone" class="form-control" />
        </div>

        <div class="form-group">
            <label for="cellPhone">*Cell Phone</label>
            <input type="tel" name="cellPhone" id="cellPhone" class="form-control" required/>
        </div>

        <div class="form-group">
            <label for="streetAddressOne">*Street Address Line 1</label>
            <input type="text" name="streetAddressOne" id="streetAddressOne" class="form-control" required />
        </div>

        <div class="form-group">
            <label for="streetAddresTwo">Street Address Line 2</label>
            <input type="text" name="streetAddressTwo" id="streetAddressTwo" class="form-control" />
        </div>

            <div class="form-group">
                <label for="city">*City</label>
                <input type="text" name="city" id="city" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="state">*State</label>
                <select name="state" id="state" class="form-control" required>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>

                </select>
            </div>
            <div class="form-group">
                <label for="zip">*Zip</label>
            <input type="text" name="zip" id="zip" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" class="form-control" />
            </div>

            <div class="form-group">
                <label for="linkedInProfile">LinkedIn Profile</label>
                <input type="text" name="linkedInProfile" id="linkedInProfile" class="form-control">
            </div>

            <div class="form-group"><label for="facebookProfile">Facebook Profile</label>
                <input type="text" name="facebookProfile" id="facebookProfile" class="form-control"></div>

            <div class="form-group"><label for="twitterProfile">Twitter Profile</label>
                <input type="text" name="twitterProfile" id="twitterProfile" class="form-control">
            </div>

            <div class="form-group"><label for="instagramProfile">Instagram Profile</label>
                <input type="text" name="instagramProfile" id="instagramProfile" class="form-control">
            </div>

        </fieldset>
        <fielset>

            <legend>Business Information</legend>
            <div class="form-group"><label for="businessEmployer">Employer</label>
                <input type="text" name="businessEmployee" id="businessEmployer" class="form-control"></div>

            <div class="form-group"><label for="jobTitle">Job Title</label>
                <input type="text" name="jobTitle" id="jobTitle" class="form-control"></div>
            <div class="form-group"><label for="businessPhoneNumber">Business Phone</label>
                <input type="text" name="businessPhoneNumber" id="businessPhoneNumber" class="form-control"></div>
            <div class="form-group"><label for="businessEmail">Business Email</label>
                <input type="text" name="businessEmail" id="businessEmail" class="form-control"></div>
            <div class="form-group"><label for="businessAddress">Business Address</label>
                <input type="text" name="businessAddress" id="businessAddress" class="form-control"></div>
            <div class="form-group"><label for="checkBox">Opportunities to connect and get involved at The Beach. I am interested in receiving more information on:</label>
            </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="opportunities[]" id="" class="form-check-input">
                    <label>Sharing my expertise and being a guest speaker</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="opportunities[]" id="" class="form-check-input">
                    <label for="">Receiving information on mentoring on Beach Nexus</label>
                </div>
                    <div class="form-group form-check">
                    <label for=""><input type="checkbox" name="opportunities[]" id="" class="form-check-input">Provide Internships</label>
                    </div>
                        <div class="form-group form-check">
                    <label for=""><input type="checkbox" name="opportunities[]" id="" class="form-check-input">Making a gift to CSULB</label>
                </div>

        </fielset>
            <div class="form-submit">
                <input type="submit" name="sendForm" id="sendForm" />
            </div>


    </form>


</div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>
