<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FileController extends Controller
{
    public function myFiles()
    {
        // starting point where everything is stored
        $folder = $this->getRoot();

        //finding all the items (files and folders) that belong to the user’s main folder
        // sorted nicely, and only showing 10 at once.
        $files = File::query()
            ->where('parent_id', $folder->id)
            ->where('created_by', Auth::id())
            ->orderBy('is_folder', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        // dd($files);

        // Get this one is from the Resources folder to make data structured and readable
        $files = FileResource::collection($files);

        return Inertia::render('MyFiles', compact('files'));
        
    }

    public function createFolder(StoreFolderRequest $request)
    {
        // this will validate the rules we have inside the request
        $data = $request->validated();

        // We have created parent inside the ParentIdBaseRequest
        $parent = $request->parent;

        // If the parent is not exits then get the root
        if (!$parent) {
            $parent = $this->getRoot();
        }

        // Create the Folder
        $file = new File();
        $file->is_folder = 1;
        $file->name = $data['name'];

        // Append it inside the parent
        $parent->appendNode($file);
    }

    // find the root folder for the currently authenticated user
    public function getRoot()
    {
        return File::query()
            ->whereIsRoot()
            ->where('created_by', Auth::id())
            ->firstOrFail();
    }
}
