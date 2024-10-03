<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class STB extends Model
{
    use HasFactory;
    protected $fillable=[
        'ret_code',
        'stb_name',
        'stb_version_id',
        'card_inserted',
        'channels_exist',
        'streaming_channel',
        'serial',
        'download_link',
        'events',
        'sleep',
    ];
    public function STBVersion():BelongsTo
    {
        return $this->belongsTo(STBVersion::class,'stb_version_id')->select(['stb','web_api','base_struct','comment']);
    }

}
