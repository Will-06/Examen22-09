<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'schedule',
        'business_id',
        'user_id',
        'service_id'
    ];

    protected $allowedIncludes = [
        'business',
        'user',
        'service'
    ];

    protected $allowedFilters = [
        'id',
        'name',
        'schedule'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeIncluded(Builder $query): void
    {
        $included = request('included');

        if (!$included || empty($this->allowedIncludes)) return;

        $relations = collect(explode(',', $included))
            ->intersect($this->allowedIncludes)
            ->toArray();

        if (!empty($relations)) {
            $query->with($relations);
        }
    }

    public function scopeFilter(Builder $query): void
    {
        if (!request()->filled('filter') || empty($this->allowedFilters)) return;

        foreach (request('filter') as $column => $value) {
            if (!in_array($column, $this->allowedFilters)) continue;

            if (str_contains($column, '.')) {
                [$relation, $field] = explode('.', $column);
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
