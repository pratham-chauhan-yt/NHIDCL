<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhidclDisclouserQuestions extends Model
{
    use HasFactory;
    protected $table = "nhidcl_disclouser_questions";

    protected $fillable = [
        "conviction",
        "criminal_case",
        "financial_liabilities",
        "conflict_of_interest",
        "terms_agreement",
        "documentary_proof",
        "eligibility_criteria",
        "information_accuracy",
        "draft_or_submit",
        "ref_users_id",
        "conviction_file",
        "criminal_case_file",
        "financial_liabilities_file",
        "conflict_of_interest_file",
        "conviction_filepath",
        "criminal_case_filepath",
        "financial_liabilities_filepath",
        "conflict_of_interest_filepath",
    ];

    public function scopeOfUser($query, $user_id)
    {
        return $query->where("ref_users_id", $user_id);
    }
}
