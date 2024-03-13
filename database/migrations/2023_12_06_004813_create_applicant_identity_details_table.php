<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_identity_details', function (Blueprint $table) {
            $table->id();
            $table->longText('applicant_name')->nullable();
            $table->longText('passport_expire_date')->nullable();
            $table->longText('passport_update_date')->nullable();
            $table->longText('birth_certificate_expire_date')->nullable();
            $table->longText('birth_certificate_update_date')->nullable();
            $table->longText('swiss_passport_expire_date')->nullable();
            $table->longText('swiss_passport_update_date')->nullable();
            $table->longText('identity_card_expire_date')->nullable();
            $table->longText('identity_card_update_date')->nullable();
            $table->longText('other_passport_expire_date')->nullable();
            $table->longText('other_passport_update_date')->nullable();
            $table->longText('visa_card_expire_date')->nullable();
            $table->longText('visa_card_update_date')->nullable();
            $table->longText('right_to_work_expire_date')->nullable();
            $table->longText('right_to_work_update_date')->nullable();
            $table->longText('driving_license_expire_date')->nullable();
            $table->longText('driving_license_update_date')->nullable();
            $table->longText('passport_photo_expire_date')->nullable();
            $table->longText('passport_photo_update_date')->nullable();
            $table->longText('college_id_expire_date')->nullable();
            $table->longText('college_id_update_date')->nullable();
            $table->longText('office_uk_id_expire_date')->nullable();
            $table->longText('office_uk_id_update_date')->nullable();
            $table->longText('other_id_expire_date')->nullable();
            $table->longText('other_id_update_date')->nullable();
            $table->longText('utility_bill_expire_date')->nullable();
            $table->longText('utility_bill_update_date')->nullable();
            $table->longText('proof_driving_expire_date')->nullable();
            $table->longText('proof_driving_update_date')->nullable();
            $table->longText('bank_statement_expire_date')->nullable();
            $table->longText('bank_statement_update_date')->nullable();
            $table->longText('council_tax_expire_date')->nullable();
            $table->longText('council_tax_update_date')->nullable();
            $table->longText('govt_expire_date')->nullable();
            $table->longText('govt_update_date')->nullable();
            $table->longText('other_photo_id_expire_date')->nullable();
            $table->longText('other_photo_id_update_date')->nullable();
            $table->longText('post_name')->nullable();
            $table->longText('name')->nullable();
            $table->longText('date')->nullable();
            $table->longText('signature')->nullable();
            $table->string('candidate_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant_identity_details');
    }
};
