<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'partyid'         => 'nullable|string',
            'name'            => 'nullable|string|max:255',
            'tel'             => 'nullable|string|max:20',
            'other_tel'       => 'nullable|string|max:20',
            'business_details' => 'nullable|string',
            'service'         => 'nullable|string|max:255',
            'channel'         => 'nullable|string|max:255',
            'campaign_id'     => 'nullable|integer',
            'branch_id'       => 'nullable|integer',
            'agent_id'        => 'nullable|integer',
            'service_id'      => 'nullable|integer',
            'sub_service_id'  => 'nullable|integer',
            'currency'        => 'nullable|string|max:10',
            'amount'          => 'nullable|numeric|min:0',
            'created_at'      => 'nullable|date',
            'updated_at'      => 'nullable|date',
        ];
    }
}
