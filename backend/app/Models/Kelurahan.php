<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $code
 * @property int|null $kecamatan_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kelurahan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelurahan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelurahan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelurahan whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelurahan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelurahan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelurahan whereKecamatanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelurahan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelurahan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kelurahan extends Model
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'kecamatan_id'
    ];
}
