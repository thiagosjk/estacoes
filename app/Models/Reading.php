<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reading
 * @package App\Models
 * @version September 11, 2018, 6:13 pm UTC
 *
 * @property \App\Models\Station station
 * @property integer station_id
 * @property float value
 */
class Reading extends Model
{
    use SoftDeletes;

    public $table = 'readings';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'station_id',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'station_id' => 'integer',
        'value' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'station_id' => 'required',
        'value' => array('required','regex:/(^([-]?([0-9]+[.,]?[0-9]*))$)/u')
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function station()
    {
        return $this->belongsTo(\App\Models\Station::class, 'station_id', 'id');
    }

    /**
     * Store value with '.' as decimal separator
     */
    public function setValueAttribute($value)
    {
        return $this->attributes['value'] = str_replace(',', '.', $value);
    }
}
