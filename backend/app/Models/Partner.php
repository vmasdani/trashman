<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $pic
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $ordering
 * @property string|null $uuid
 * @property int|null $created_by
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner wherePic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereUuid($value)
 * @property string|null $provinsi
 * @property string|null $kabupaten
 * @property string|null $kecamatan
 * @property string|null $kelurahan
 * @property int|null $legal_entity
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereKabupaten($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereKelurahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereLegalEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereProvinsi($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PartnerMember> $partnerMembers
 * @property-read int|null $partner_members_count
 * @mixin \Eloquent
 */
class Partner extends Model
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'pic',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'legal_entity',

        'deleted_at',
        'ordering',
        'uuid',
        'created_by'

    ];

    public function partnerMembers()
    {
        return $this->hasMany(PartnerMember::class);
    }
}
