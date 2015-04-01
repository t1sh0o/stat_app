<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    protected $guarded = ['id'];

    public $timestamps = false;

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = md5($password); // bcrypt($password, ['rounds' => 4]);
    }

}
