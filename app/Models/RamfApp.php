<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RamfApp extends Model
{
    use HasFactory;
    protected $fillable = [
        'ret_code',
        'ramf_app_name',
        // 'version_id',
        'serial',
        'ramf_app_version_id',
        'download_link'
    ];
    // public function Version(): HasOne
    // {
    //     return $this->hasOne(Version::class,'version_id');
    // }

    public function appVersion(): BelongsTo
    {
        return $this->belongsTo(RamfAppVersion::class, 'ramf_app_version_id')->select(['app', 'web_api', 'built','app_full_name','comment']);
    }
}
