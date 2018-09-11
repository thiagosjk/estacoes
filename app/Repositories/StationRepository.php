<?php

namespace App\Repositories;

use App\Models\Station;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class StationRepository
 * @package App\Repositories
 * @version September 11, 2018, 6:13 pm UTC
 *
 * @method Station findWithoutFail($id, $columns = ['*'])
 * @method Station find($id, $columns = ['*'])
 * @method Station first($columns = ['*'])
*/
class StationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'latitude',
        'longitude'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Station::class;
    }
}
