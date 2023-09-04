<?php

namespace User\Model;

use Spatie\Permission\Traits\HasPermissions;
use User\Support\Enum\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Address\Model\Address;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasRoles;
    use HasFactory;
    use Notifiable;
    use HasPermissions;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullName',
        'mobile',
        'email',
        'role_id',
        'avatar',
        'birthDate',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }



    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }



    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function scopeVerifyCode($code,  $user)
    {
        $status = $user->where('active_code',$code)->where('expired_at' , '>' , now())->first();

        if ($status != null){
            return true;
        }

        return false;
    }

    public function scopeGenerateCode($user)
    {
        if($code = $this->getAliveCodeForUser($user)) {
            $code = $code->code;
            return $code;
        } else {
            do {
                $code = mt_rand(10000, 99999);
            } while($this->checkCodeIsUnique($user , $code));

            // store the code
            $user->update([
                'active_code' => $code,
                'expired_at' => now()->addMinutes(10)
            ]);

            return $code;
        }
    }

    private function checkCodeIsUnique($user, int $code)
    {
        return !! $user->where('active_code',$code)->first();
    }

    private function getAliveCodeForUser($user)
    {
        return $user->where('expired_at' , '>' , now())->first();
    }

}
