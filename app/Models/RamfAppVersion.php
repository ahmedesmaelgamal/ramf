<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RamfAppVersion extends Model
{
    use HasFactory;
    protected $fillable = [
        'app',
        'web_api',
        'built',
        'app_full_name',
        'comment'
    ];
    // public function ramfApp(): BelongsTo
    // {
    //     return $this->belongsTo(RamfApp::class,'version_id');
    // }
    public function ramfApp(): HasOne
    {
        return $this->hasOne(RamfApp::class, 'ramf_app_version_id');
    }
}
