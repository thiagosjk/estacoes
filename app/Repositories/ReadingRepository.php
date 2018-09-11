<?php

namespace App\Repositories;

use App\Models\Reading;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ReadingRepository
 * @package App\Repositories
 * @version September 11, 2018, 6:13 pm UTC
 *
 * @method Reading findWithoutFail($id, $columns = ['*'])
 * @method Reading find($id, $columns = ['*'])
 * @method Reading first($columns = ['*'])
*/
class ReadingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'station_id',
        'value'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Reading::class;
    }
}
