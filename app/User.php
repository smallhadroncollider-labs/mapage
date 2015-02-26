<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
    use Authenticatable, CanResetPassword;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function toArray() {
       $array = parent::toArray();
       $array['gravatar'] = $this->gravatar;
       return $array;
   }

    public function getGravatarAttribute() {
        $hash = md5(strtolower(trim($this->email)));
        $default = urlencode(env("SITE_URL") . "/img/avatar.png");
        $size = 48;

        return "http://www.gravatar.com/avatar/{$hash}?d={$default}&s={$size}";
    }
}
