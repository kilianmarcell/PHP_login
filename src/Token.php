<?php

namespace Kilianmarcell\Login;

use Illuminate\Database\Eloquent\Model;

class Token extends Model {
    // Ha a created_at / updated_at nélkül hoztuk létre:
    public $timestamps = false;
}