<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;

class UserQuery extends Authenticatable
{
    use HasFactory;
    protected $rules = ['query' => 'required|unique'];
    protected $table = 'user_queries';
    protected $guarded = [];

    public function validate($inputs) {
        $v = Validator::make($inputs, $this->rules);
        if($v->passes()) return true;
        $this->errors = $v->messages();
        return false;
    }

}
