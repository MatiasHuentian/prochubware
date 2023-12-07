<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RisksControl extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, Auditable;

    public $table = 'risks_controls';

    public static $search = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'risk_id',
        'name',
        'frecuency_id',
        'method_id',
        'type_id',
    ];

    public $orderable = [
        'id',
        'risk.name',
        'risk.description',
        'name',
        'frecuency.name',
        'method.name',
        'type.name',
    ];

    public $filterable = [
        'id',
        'risk.name',
        'risk.description',
        'name',
        'frecuency.name',
        'method.name',
        'type.name',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function risk()
    {
        return $this->belongsTo(ActivitiesRisk::class);
    }

    public function frecuency()
    {
        return $this->belongsTo(RisksControlsFrecuency::class);
    }

    public function method()
    {
        return $this->belongsTo(RisksControlsMethod::class);
    }

    public function type()
    {
        return $this->belongsTo(RisksControlsType::class);
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
