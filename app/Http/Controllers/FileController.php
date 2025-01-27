<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FileController extends Controller
{
    public function myFiles()
    {
        return Inertia::render('MyFiles');
    }

    public function createFolder(StoreFolderRequest $request)
    {
        // this will validate the rules we have inside the request
        $data = $request->validated();

        // We have created parent inside the ParentIdBaseRequest
        $parent = $request->parent;
        
        // If the parent is not exits then get the root
        if(!$parent){
            $parent = $this->getRoot();
        }

        // Create the Folder
        $file = new File();
        $file->is_folder = 1;
        $file->name = $data['name'];

        // Append it inside the parent
        $parent->appendNode($file);

    }

    public function getRoot()
    {
        return File::query()
            ->whereIsRoot()
            ->where('created_by', Auth::id())
            ->firstOrFail();
    }
}
