<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'points',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Admin's activities.
     * 
     * @return HasMany
     */
    public function createdActivities() : HasMany
    {
        return $this->hasMany(Activity::class, 'creator_id');
    }

    /**
     * Member's activities.
     * 
     * @return BelongsToMany
     */
    public function joinedActivities() : BelongsToMany
    {
        return $this->belongsToMany(Activity::class)->withTimestamps()->withPivot('points_earned');
    }

    /**
     * Admin's created reward.
     * 
     * @return HasMany
     */
    public function rewards() : HasMany
    {
        return $this->hasMany(Reward::class, 'creator_id');
    }

    /**
     * Member's claimed rewards.
     * 
     * @return HasManyThrough
     */
    public function claimedRewards() : HasManyThrough
    {
        return $this->hasManyThrough(Redeem::class, Reward::class, 'member_id');
    }

    /**
     * Admin's redeem.
     * 
     * @return HasMany
     */
    public function redeems() : HasMany
    {
        return $this->hasMany(Redeem::class, 'admin_id');
    }

    /**
     * Member's redeem.
     * 
     * @return HasMany
     */
    public function claims() : HasMany
    {
        return $this->hasMany(Redeem::class, 'member_id');
    }
}
