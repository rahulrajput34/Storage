<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

// This request extends ParentIdBaseRequest, inheriting its validation rules and authorization logic, and adds additional rules specific to creating a new folder.
class StoreFolderRequest extends ParentIdBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // TODO: a good Bug I have faced for unique file 
        // We want the rules coming from the ParentIdBaseRequest and also our own rules
        return array_merge(parent::rules(),
            [
                'name' => [
                    'required',
                    'unique:files',
                    Rule::unique(File::class, 'name')
                        ->where('created_by', Auth::id())
                        ->where('parent_id', $this->input('parent_id'))
                        ->whereNull('deleted_at')
                ]
            ]
        );        
    }

    public function messages()
    {
        return [
            'name.unique' => 'A folder ":input" already exists in this location.',
        ];
    }

}



//************************************  How They Work Together

/*

When a request to create a new folder is made, the StoreFolderRequest is triggered.
This request first applies all the validation rules defined in ParentIdBaseRequest (checking that the parent_id is valid and owned by the user).
It then adds its own unique folder name validation on top of the parent class’s rules.
If all the validations pass, the controller logic that follows can safely create the new folder, knowing that the parent_id is valid and the name doesn’t conflict with existing folders.

*/