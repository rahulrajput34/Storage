<?php

namespace App\Models;

use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class File extends Model
{
    use NodeTrait, SoftDeletes, HasCreatorAndUpdater;

    // File model contains a foreign key (created_by) that references the primary key of the User model.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    //File model includes a foreign key (parent_id) that points back to another entry in the same table.
    public function parent(): BelongsTo
    {
        return $this->belongsTo(File::class, 'parent_id');
    }

    // If the current folder is owned by the current authenticated user
    public function isOwnedBy($userId): bool
    {
        return $this->created_by == $userId;
    }

    // it returns the name of the user who created it
    // This will change the data of owner inside the database
    public function owner(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return $attributes['created_by'] == Auth::id() ? 'me' :
                    $this->user->name;
            }
        );
    }

    // checks if a file has no parent folder. If it doesn’t, it returns true.
    public function isRoot(): bool
    {
        return $this->parent_id == null;
    }

    // Runs every time a new file is added to the database.
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // If the file has no parent folder, it doesn’t do anything.
            if(!$model->parent){
                return;
            }
            // setting the “path” for each file so you don’t have to do it manually
            // If someone pass the filename          path
            //                      raul rajput     raul-rajput
            //                      urges           urges
            $model->path = (!$model->parent->isRoot() ? $model->parent->path.'/' : '').Str::slug($model->name);

        });
    }
}
