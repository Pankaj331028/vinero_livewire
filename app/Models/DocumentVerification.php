<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentVerification extends Model {
	use HasFactory;

	protected $fillable = ['cash_verified_amount', 'downpayment_verified_amount', 'loan_application_status', 'loan_application_amount', 'loan_interest_rate', 'direct_lender_name', 'other_documents', 'status'];

	public function offer() {
		return $this->belongsTo(Offers::class, 'offer_id', 'id');
	}

	public function documents() {
		return $this->morphMany('App\Models\Document', 'documentable');
	}

	public function downpaymentFiles() {
		return $this->documents()->where(['type' => 'downpayment_verified_image','status'=> 'AC'])->select('id', 'name', \DB::raw("CONCAT('" . asset("") . "', path) image"))->orderBy('created_at', 'desc');
	}

	public function cashVerifiedFiles() {
		return $this->documents()->where(['type' =>  'cash_verified_image','status'=> 'AC'])->select('id', 'name', \DB::raw("CONCAT('" . asset("") . "', path) image"))->orderBy('created_at', 'desc');
	}

	public function loanApplicationFiles() {
		return $this->documents()->where(['type' =>'loan_application_image' ,'status'=> 'AC'])->select('id', 'name', \DB::raw("CONCAT('" . asset("") . "', path) image"))->orderBy('created_at', 'desc');
	}

	public function otherFiles() {
		return $this->documents()->where(['type' => 'other_document_image','status'=> 'AC'])->select('id', 'name', \DB::raw("CONCAT('" . asset("") . "', path) image"))->orderBy('created_at', 'desc');
	}
}
