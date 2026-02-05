<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $projectId = $this->route('project');

        return [
            'name' => [
                'required',
                'string',
                'min:5',
                'max:45',
                Rule::unique('projects', 'name')->ignore($projectId),
            ],
            'description' => ['required', 'string'],
        ];
    }
}
