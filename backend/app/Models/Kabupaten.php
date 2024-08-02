<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $code
 * @property int|null $provinsi_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereProvinsiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kabupaten whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kabupaten extends Model
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'provinsi_id'
    ];
}
