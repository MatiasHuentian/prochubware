<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use HasFactory, HasAdvancedFilter, SoftDeletes, Auditable;

    public $table = 'processes';

    public static $search = [
        'name',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $orderable = [
        'id',
        'name',
        'owner.name',
        'owner.email',
        'dependency.name',
        'state.name',
        'state.color',
        'start_date',
        'end_date',
    ];

    public $filterable = [
        'id',
        'name',
        'owner.name',
        'owner.email',
        'dependency.name',
        'state.name',
        'state.color',
        'start_date',
        'end_date',
    ];

    protected $fillable = [
        'name',
        'owner_id',
        'objective',
        'dependency_id',
        'state_id',
        'introduction',
        'contextual_memo',
        'start_date',
        'end_date',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function dependency()
    {
        return $this->belongsTo(Dependency::class);
    }

    public function state()
    {
        return $this->belongsTo(ProcessesState::class);
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('project.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('project.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function glosary()
    {
        return $this->belongsToMany(Glossary::class)->withPivot('description');
    }

    public function input()
    {
        return $this->belongsToMany(Input::class)->withPivot('description');
    }

    public function output()
    {
        return $this->belongsToMany(Output::class)->withPivot('description');
    }

    public function objectiveGroup()
    {
        return $this->belongsToMany(ObejctivesGroup::class)->withPivot('description');
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

    // Fabricated code
    public function activities()
    {
        return $this->hasMany(ProcessesActivity::class, 'process_id', 'id');
    }

    public function kpis()
    {
        return $this->hasMany(ProcessesKpi::class, 'process_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'process_id', 'id');
    }

    // Scopes
    public function scopeOnlyActives($query,  $bool)
    {
        if ($bool) {
            return $query->where('state_id', '=', '2')
                ->whereDate('end_date', '>', Carbon::now());
        }
    }

    public function scopeDireccionDependency($query, $direction, $dependency)
    {
        if ($direction) {
            $query->whereHas('dependency', function ($query) use ($direction) {
                return $query->where('direction_id', '=',  $direction);
            });
        }
        if ($dependency) {
            $query->where('dependency_id', '=', $dependency);
        }
        return $query;
    }

    public function scopeOnlyOwner($query, $value)
    {
        if ($value) {
            return $query->where('owner_id', '=', $value);
        }
    }
}
