<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Station
 * @package App\Models
 * @version September 11, 2018, 6:13 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Reading
 * @property string name
 * @property string description
 * @property decimal(10 latitude
 * @property decimal(11 longitude
 */
class Station extends Model
{
    use SoftDeletes;

    public $table = 'stations';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'latitude' => 'float',
        'longitude' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'latitude' => array('nullable','regex:/(^([-]?(([0]*90[,.]?0{0,})|([0]*[1-8]?[0-9]?([,.][0-9]{0,})?)))$)/u'),
        'longitude' => array('nullable','regex:/(^([-]?(([0]*180[,.]?0{0,})|([0]*[1]?[0-7]?[0-9]?([,.][0-9]{0,})?)))$)/u')
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function readings()
    {
        return $this->hasMany(\App\Models\Reading::class, 'station_id');
    }

    /**
     * Store latitude with '.' as decimal separator
     */
    public function setLatitudeAttribute($value)
    {
        return $this->attributes['latitude'] = str_replace(',', '.', $value);
    }

    /**
     * Store longitude with '.' as decimal separator
     */
    public function setLongitudeAttribute($value)
    {
        return $this->attributes['longitude'] = str_replace(',', '.', $value);
    }
}
