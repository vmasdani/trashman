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
 * @property int|null $transaction_id
 * @property int|null $material_id
 * @property float|null $qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $ordering
 * @property string|null $uuid
 * @property int|null $created_by
 * @property-read \App\Models\Material|null $material
 * @property-read \App\Models\Transaction|null $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionItem whereUuid($value)
 * @mixin \Eloquent
 */
class TransactionItem extends Model
{
    protected $fillable = [
        'id',
        'transaction_id',
        'material_id',
        'qty'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
