<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = "administrator";
    protected $table = "administrators";
    protected $primaryKey = "id";
    protected $fillable = [
        "name", "email", "password",
    ];

    protected $hidden = [
        "password", "remember_token",
    ];
}
