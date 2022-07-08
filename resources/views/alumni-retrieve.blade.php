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

    <form method="post" action="/retrieve" novalidate>
        @csrf
        <h2 id="mh1">CSULB Alumni Membership ID Retrieval Form</h2>
        <div class="container">
            <p>In our effort to create an inclusive program, as of January 2022 all graduates are now CSULB Alumni Members. We created this simple form for you to claim your membership card. Your membership card can be used to access CSULB Alumni benefits, connecting you further with your alma mater and fellow 49ers. </p>
            <span>* Required Fields</span>
        </div>

        <fieldset>
            <legend>Member Information</legend>
    <div class="form-group">

        <label for="alumniEmail">*Email:</label>
        <input type="email" name="alumniEmail" id="alumniEmail" class="form-control " value="{{old('alumniEmail')}}" required />
    </div>

        </fieldset>
        <fielset>


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
