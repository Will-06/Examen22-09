<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',    
        'last_name',   
        'birth_date',
        'phone',
        'address',
        'status_id',
        'role_id',
        'business_id',
    ];

    protected $allowIncluded = [
        'status',
        'appointments',
        'business',
        'role',
        'agendas',
        'category',
    ];

    protected $allowFilter = [
        'id',
        'name',
        'last_name',
        'birth_date',
        'phone',
        'address',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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

        if ($relations) {
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
                $query->whereHas($relation, fn($q) => $q->where($field, 'LIKE', "%$value%"));
            } elseif ($column === 'created_at' || $column === 'birth_date') {
                $query->whereDate($column, $value);
            } else {
                $query->where($column, 'LIKE', "%$value%");
            }
        }
    }

    public function scopeGetOrPaginate(Builder $query)
    {
        if ($perPage = intval(request('perPage'))) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }
}
