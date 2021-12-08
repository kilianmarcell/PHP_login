<?php

namespace Kilianmarcell\Login;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    // Ha a created_at / updated_at nélkül hoztuk létre:
    public $timestamps = false;

    protected $visible = [ 'id', 'email' ];
}