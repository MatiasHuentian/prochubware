<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Attachment extends Model implements HasMedia
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, InteractsWithMedia, Auditable;

    public $table = 'attachments';

    protected $appends = [
        'src',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'process_id',
        'category_id',
        'description',
    ];

    public $orderable = [
        'id',
        'process.name',
        'process.objective',
        'category.name',
        'onemedia.mime_type',
        'description',
    ];

    public $filterable = [
        'id',
        'process.name',
        'process.objective',
        'category.name',
        'onemedia.mime_type',
        'description',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function category()
    {
        return $this->belongsTo(AttachmentsCategory::class);
    }

    public function onemedia()
    {
        return $this->morphOne(config('media-library.media_model'), 'model');
    }

    public function getMimeTypeForHumanAttribute()
    {
        $mimeTypes = [
            'text/plain' => 'Texto plano',
            'text/html' => 'HTML',
            'text/css' => 'CSS',
            // ... otras opciones ...
            'application/pdf' => 'PDF',
            'application/zip' => 'ZIP',
            'application/json' => 'JSON',
            'application/xml' => "XML",
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'Excel',
            // ... otras opciones ...
            'image/jpeg' => 'JPEG',
            'image/png' => 'PNG',
            'image/gif' => 'GIF',
            // ... otras opciones ...
            'audio/mpeg' => 'Audio MPEG',
            'audio/wav' => 'Audio WAV',
            'audio/ogg' => 'Audio OGG',
            // ... otras opciones ...
            'video/mp4' => 'Video MP4',
            'video/webm' => 'Video WEBM',
            'video/ogg' => 'Video OGG',
            // ... otras opciones ...
        ];
        return $this->onemedia ? ($mimeTypes[$this->onemedia->mime_type] ?? null) : (null);
    }

    public function getSrcAttribute()
    {
        return $this->getMedia('attachment_src')->map(function ($item) {
            $media        = $item->toArray();
            $media['url'] = $item->getUrl();

            return $media;
        });
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }
}
