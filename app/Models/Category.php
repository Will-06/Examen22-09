<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'group',
        'status_id',
    ];

    protected array $allowIncluded = [
        'businesses',
        'status',
        'services',
        'users',
    ];

    protected array $allowFilter = [
        'id',
        'name',
        'description',
        'group',
    ];

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
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
            } elseif ($column === 'created_at') {
                $query->whereDate($column, $value);
            } else {
                $query->where($column, 'LIKE', "%$value%");
            }
        }
    }
    
    public function scopeGetOrPaginate(Builder $query)
    {
        $perPage = intval(request('perPage'));

        return $perPage ? $query->paginate($perPage) : $query->get();
    }
}
