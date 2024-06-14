<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => ['required', new Enum(TaskStatusEnum::class)],
        ];
    }
}
