<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivitiesRisk extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, Auditable;

    public $table = 'activities_risks';

    public static $search = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'activity_id',
        'name',
        'politic_id',
        'probability_id',
        'impact_id',
        'description',
    ];

    public $orderable = [
        'id',
        'activity.name',
        'activity.description',
        'name',
        'politic.name',
        'probability.name',
        'impact.name',
        'description',
    ];

    public $filterable = [
        'id',
        'activity.name',
        'activity.description',
        'name',
        'politic.name',
        'probability.name',
        'impact.name',
        'description',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function activity()
    {
        return $this->belongsTo(ProcessesActivity::class);
    }

    public function politic()
    {
        return $this->belongsTo(ActivitiesRisksPolitic::class);
    }

    public function probability()
    {
        return $this->belongsTo(ActivitiesRisksProbability::class);
    }

    public function impact()
    {
        return $this->belongsTo(ActivitiesRisksImpact::class);
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

    public function causes()
    {
        return $this->hasMany(ActivitiesRisksCause::class, 'risk_id', 'id');
    }

    public function consequences()
    {
        return $this->hasMany(ActivitiesRisksConsequence::class, 'risk_id', 'id');
    }

    public function controls()
    {
        return $this->hasMany(RisksControl::class, 'risk_id', 'id');
    }
}
