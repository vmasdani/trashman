<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
