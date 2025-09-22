<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'features',
        'discounts',
        'status_id'
    ];

    protected $allowIncluded = [
        'businesses',
        'status',
        'businesses.users',
    ];

    protected $allowFilter = [
        'id',
        'name',
        'features',
        'discounts',
    ];

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
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
        if (!request()->filled('filter') || empty($this->allowFilter)) {
            return;
        }

        foreach (request('filter') as $column => $value) {
            if (!in_array($column, $this->allowFilter)) {
                continue;
            }

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
        if ($perPage = intval(request('perPage'))) {
            return $query->paginate($perPage);
        }
        return $query->get();
    }
}
