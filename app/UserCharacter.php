<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserCharacter
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $characterId
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserCharacter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCharacter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCharacter query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCharacter whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCharacter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCharacter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCharacter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCharacter whereUserId($value)
 * @mixin \Eloquent
 */
class UserCharacter extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'characterId', 'user_id'
    ];
}
