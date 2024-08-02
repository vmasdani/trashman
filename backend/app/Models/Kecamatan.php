<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $code
 * @property int|null $kabupaten_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereKabupatenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kecamatan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kecamatan extends Model
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'kabupaten_id'
    ];
}
