<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadUpdateRequest extends FormRequest
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
            'partyid'          => 'required|string|max:255',
            'other_tel'        => 'nullable|string|max:255',
            'business_details' => 'nullable|string|max:255',
            'service'          => 'nullable|string|max:255',
            'channel'          => 'nullable|string|max:255',
            'campaign_id'      => 'nullable|integer',
            'branch_id'        => 'nullable|integer',
            'agent_id'         => 'nullable|integer',
            'service_id'       => 'nullable|integer',
            'sub_service_id'   => 'nullable|integer',
            'currency'         => 'nullable|string|max:10',
            'amount'           => [
                'nullable',
                'numeric',
                'regex:/^\d{1,18}(\.\d{1,3})?$/'
            ],
            'status'           => 'nullable|string|max:50',
            'remarks'          => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.regex' => 'Please add a valid amount i-e number with max 18 digits (quintillion) and up to 3 decimal points.',
        ];
    }

    /**
     * Prepare validated data for updating a lead.
     */
    public function validatedForUpdate($lead)
    {
        return array_merge($this->validated(), [
            'status' => $this->status ?? $lead->status,
            'approved_status' => !$this->status
                ? $this->qualified_status
                : ($this->status === 'Qualified' ? $this->qualified_status : null),
        ]);
    }
}
