<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'link',
        'has_password',
        'password',
    ];

    /*
    
        RELATIONSHIP

    */

    public function presentations()
    {
        return $this->belongsTo(User::class);
    }
}
