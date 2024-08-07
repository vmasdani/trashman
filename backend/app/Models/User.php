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
 * @property string|null $username
 * @property mixed|null $password
 * @property string|null $email
 * @property string|null $phone
 * @property int|null $role
 * @property int|null $gender
 * @property float|null $latitude
 * @property float|null $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $ordering
 * @property string|null $uuid
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUuid($value)
 * @property int|null $created_by
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedBy($value)
 * @property string|null $address
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @property string|null $mp
 * @property string|null $provinsi
 * @property string|null $kabupaten
 * @property string|null $kecamatan
 * @property string|null $kelurahan
 * @property int|null $member_type
 * @property string|null $family_id
 * @property int|null $verified
 * @property string|null $verified_date
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKabupaten($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKelurahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMemberType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProvinsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerifiedDate($value)
 * @mixin \Eloquent
 */
class User extends Model
{
    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'password',
        'phone',
        'role',
        'gender',
        'latitude',
        'longitude',
        'address',
        'mp',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'member_type',
        'family_id',
        'verified',
        'verified_date',

        'deleted_at',
        'ordering',
        'uuid',
        'created_by'

    ];
}
