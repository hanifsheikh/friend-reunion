<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    protected $fillable = [
                        'name',
                        'photo',
                        'nid',
                        'contact_no',
                        'alternative_contact_no',
                        'mailing_address',
                        'email_address',
                        'date_of_birth',
                        'marital_status',
                        'marriage_anniversary',
                        'spouse_name',
                        'no_of_children',
                        'educational_qualification',
                        'professional_status',
                        'religion',
                        'presence_of_upcoming_event'
    ];
}
