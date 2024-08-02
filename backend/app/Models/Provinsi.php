<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi whereUpdatedAt($value)
 * @property int|null $code
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi whereCode($value)
 * @mixin \Eloquent
 */
class Provinsi extends Model
{
    protected $fillable = [
        'id',
        'name',
        'code'
    ];
}
