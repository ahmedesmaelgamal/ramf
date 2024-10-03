<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class STBVersion extends Model
{
    use HasFactory;
    protected $table = 's_t_b_versions';  // Add this line
    protected $fillable=[
        'stb',
        'version',
        'date',
        'web_api',
        'base_struct',
        'comment'
    ];
    public function STB():HasOne
    {
        return $this->hasOne(STB::class,'stb_version_id');
    }
}
