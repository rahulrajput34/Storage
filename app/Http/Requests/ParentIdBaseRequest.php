<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\File;

// its checking that the user has the right to create or manage files within the specified parent folder
class ParentIdBaseRequest extends FormRequest
{
    public ?File $parent = null;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $this->parent = File::query()->where('id', $this->input('parent_id'))->first();

        // isOwnedBy is a helper method inside the File that we defined not in-build
        if ($this->parent && !$this->parent->isOwnedBy(Auth::id())) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // parent_id must be exits inside the 'files' table with below rules
        // The rules are is_folder is 1 and create_by authenticated user
        // That is what we pass inside the controller to define the rules
        return [
            'parent_id' => [
                Rule::exists(File::class, 'id')
                    ->where(function (Builder $query) {
                        return $query
                            ->where('is_folder', '=', '1')
                            ->where('created_by', '=', Auth::id());
                    })
            ]
        ];
    }
}
