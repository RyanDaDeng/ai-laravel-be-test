<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $units
 * @property boolean $is_numeric
 * @property int $num_decimal_places
 * Class PropertyAnalytic
 * @package App\Models
 */
class PropertyAnalytic extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
}
