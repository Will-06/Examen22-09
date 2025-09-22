<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'group',
    ];

    protected $allowIncluded = [
        'plans',
        'appointments',
        'services',
        'categories',
        'users',
        'business',
        'roles',
    ];

    protected $allowFilter = [
        'id',
        'name',
        'description',
        'group',
    ];


    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function business()
    {
        return $this->hasMany(Business::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
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
                $query->whereHas($relation, fn($q) => $q->where($field, 'LIKE', "%$value%"));
            } elseif ($column === 'created_at' || $column === 'updated_at') {
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
