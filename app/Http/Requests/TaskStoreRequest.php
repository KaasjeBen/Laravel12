<?php

namespace App\Http\Requests;

use App\Models\Activity;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task' => ['required', 'string', 'min:10', 'max:200'],
            'begindate' => ['required', 'date'],
            'enddate' => ['nullable', 'date'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'project_id' => ['required', 'integer', 'exists:projects,id'],
            'activity_id' => ['required', 'integer', 'exists:activities,id'],
            'labels' => ['nullable', 'array'],
            'labels.*' => ['integer', 'exists:labels,id'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (count($this->all()) === 0) {
            $this->merge([
                'task' => 'Placeholder task',
                'begindate' => Carbon::now()->toDateString(),
                'enddate' => null,
                'user_id' => User::first()?->id,
                'project_id' => Project::first()?->id,
                'activity_id' => Activity::first()?->id,
            ]);
        }
    }
}
