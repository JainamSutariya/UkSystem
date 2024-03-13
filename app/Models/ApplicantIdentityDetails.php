<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantIdentityDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_name',
        'passport_expire_date',
        'passport_update_date',
        'birth_certificate_expire_date',
        'birth_certificate_update_date',
        'swiss_passport_expire_date',
        'swiss_passport_update_date',
        'identity_card_expire_date',
        'identity_card_update_date',
        'other_passport_expire_date',
        'other_passport_update_date',
        'visa_card_expire_date',
        'visa_card_update_date',
        'right_to_work_expire_date',
        'right_to_work_update_date',
        'driving_license_expire_date',
        'driving_license_update_date',
        'passport_photo_expire_date',
        'passport_photo_update_date',
        'college_id_expire_date',
        'college_id_update_date',
        'office_uk_id_expire_date',
        'office_uk_id_update_date',
        'other_id_expire_date',
        'other_id_update_date',
        'utility_bill_expire_date',
        'utility_bill_update_date',
        'proof_driving_expire_date',
        'proof_driving_update_date',
        'bank_statement_expire_date',
        'bank_statement_update_date',
        'council_tax_expire_date',
        'council_tax_update_date',
        'govt_expire_date',
        'govt_update_date',
        'other_photo_id_expire_date',
        'other_photo_id_update_date',
        'post_name',
        'name',
        'date',
        'signature',
        'candidate_id',
        'passport_file',
        'birth_certificate_file',
        'swiss_passport_file',
        'identity_card_file',
        'other_passport_file',
        'visa_card_file',
        'right_to_work_file',
        'driving_license_file',
        'passport_photo_file',
        'college_id_file',
        'office_uk_id_file',
        'other_id_file',
        'utility_bill_file',
        'proof_driving_file',
        'bank_statement_file',
        'council_tax_file',
        'govt_file',
        'other_photo_id_file'
    ];
}
