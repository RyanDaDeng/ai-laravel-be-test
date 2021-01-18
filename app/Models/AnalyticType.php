<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $value
 * @property int $property_id
 * @property int $analytic_type_id
 * Class AnalyticType
 * @package App\Models
 */
class AnalyticType extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
}
