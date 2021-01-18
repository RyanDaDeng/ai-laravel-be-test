<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $guid
 * @property string $suburb
 * @property string $state
 * @property string $country
 * Class Property
 * @package App\Models
 */
class Property extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->guid = (string) Str::uuid();
        });
    }

    /**
     * The property that belong to many analytic types.
     */
    public function analytic_types()
    {
        return $this->belongsToMany(AnalyticType::class);
    }

}
