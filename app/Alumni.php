<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = ['firstName', 'middleName', 'lastName', 'pronouns', 'nameWhileAttending', 'alumniEmail', 'affiliation', 'gradYear', 'degreeType', 'major', 'degreeType2', 'major2', 'beachFamilyMember', 'beachName', 'homePhone', 'cellPhone', 'streetAddressOne', 'streetAddressTwo', 'city', 'state', 'zip', 'country', 'linkedInProfile', 'facebookProfile', 'membershipToken', 'businessEmployer', 'businessEmail', 'businessAddress', 'opportunities', 'digitalCardLink'];

    protected $casts = ['zip' => 'string'];
}
