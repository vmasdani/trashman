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
 * @property int|null $member_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $ordering
 * @property string|null $uuid
 * @property int|null $created_by
 * @property string|null $provinsi
 * @property string|null $kabupaten
 * @property string|null $kecamatan
 * @property string|null $kelurahan
 * @property int|null $member_type
 * @property int|null $partner_id
 * @property-read \App\Models\User|null $member
 * @property-read \App\Models\Partner|null $partner
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereKabupaten($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereKelurahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereMemberType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereProvinsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartnerMember whereUuid($value)
 * @mixin \Eloquent
 */
class PartnerMember extends Model
{
    protected $fillable = [
        'id',
        'partner_id',
        'member_id',


        'deleted_at',
        'ordering',
        'uuid',
        'created_by'

    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
