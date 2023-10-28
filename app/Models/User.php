<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Common\Users\Entities\BasicProfile;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Str;
class User extends Authenticatable implements MustVerifyEmail,JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'link_expire_time',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends=['basic_profile'];



    protected static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            $user->slug = $user->generateSlug($user->name);
            $user->save();
        });
    }
    private function generateSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return $slug."-".rand(10, 10000);
        }
        return $slug;
    } 





    public function getIdAttribute($value)
    {
        return InwntEncrypt($value);
    }



    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return InwntDecrypt($this->getKey());
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

    public function getImageAttribute($value)
    {

        return StorageFile($value);
    }

    public function getBasicProfileAttribute()
    {
        if(BasicProfile::where('user_id', InwntDecrypt($this->id))->count()>0){
            return true;
        }else{
            return false;
        }
    }


    public function basicProfile()
    {
        return $this->hasOne(BasicProfile::class, 'user_id', 'id');
    }

}
