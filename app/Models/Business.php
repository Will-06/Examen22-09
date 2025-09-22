<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'status_id',
        'category_id',
        'plan_id',
    ];

    protected $allowIncluded = [
        'appointments',
        'category',
        'status',
        'plan',
        'services',
        'customizations',
        'users',
        'agendas',
    ];

    protected $allowFilter = [
        'id',
        'name',
        'address',
        'phone',
        'created_at',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function customizations()
    {
        return $this->hasMany(Customization::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    public function scopeIncluded(Builder $query): void
    {
        $included = request('included');

        if (!$included || empty($this->allowIncluded)) {
            return;
        }

        $relations = collect(explode(',', $included))
            ->intersect($this->allowIncluded)
            ->toArray();

        if (!empty($relations)) {
            $query->with($relations);
        }
    }

    public function scopeFilter(Builder $query): void
    {
        if (!request()->filled('filter') || empty($this->allowFilter)) return;

        foreach (request('filter') as $column => $value) {
            if (!in_array($column, $this->allowFilter)) continue;

            if (str_contains($column, '.')) {
                [$relation, $field] = explode('.', $column, 2);
                $query->whereHas($relation, fn ($q) => $q->where($field, 'LIKE', "%$value%"));
            } elseif ($column === 'created_at') {
                $query->whereDate($column, $value);
            } else {
                $query->where($column, 'LIKE', "%$value%");
            }
        }
    }

    public function scopeGetOrPaginate(Builder $query)
    {
        if (request('perPage')) {
            $perPage = intval(request('perPage'));
            if ($perPage) {
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }
}
