<?php

namespace App\Http\Requests;

use App\Models\Feedback;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'visit_date' => ['nullable', 'date', 'before_or_equal:today'],
            'name' => ['nullable', 'string', 'max:255'],
            'age_range' => ['nullable', Rule::in(Feedback::ageRanges())],
            'gender' => ['nullable', Rule::in(Feedback::genders())],
            'gender_other' => ['nullable', 'required_if:gender,'.Feedback::GENDER_OTHER, 'string', 'max:255'],
            'residence_type' => ['nullable', Rule::in(Feedback::residenceTypes())],
            'residence_detail' => ['nullable', 'string', 'max:255'],
            'overall_experience' => ['nullable', Rule::in(Feedback::overallExperiences())],
            'comments' => ['nullable', 'string', 'max:5000'],
            'privacy_agreement' => ['accepted'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'visit_date' => 'date of visit',
            'age_range' => 'age range',
            'gender_other' => 'gender specification',
            'residence_type' => 'place of residence',
            'residence_detail' => 'residence details',
            'overall_experience' => 'overall experience',
            'privacy_agreement' => 'data privacy notice',
        ];
    }
}
