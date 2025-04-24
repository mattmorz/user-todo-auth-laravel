<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    protected $fillable = ['user_id','title','completed','icon_path','user_id'];
    protected $casts    = ['completed'=>'boolean'];
    //protected $table = 'to_dos';

    // A Todo belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
