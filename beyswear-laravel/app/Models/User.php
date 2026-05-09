<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name','email','password','role','no_hp','jabatan'];

    public function getJabatanAttribute()
    {
        return $this->role === 'admin' ? 'Administrator' : 'Staff Kasir';
    }
}