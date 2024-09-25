<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class UserCatalogue extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, QueryScopes;
    protected $fillable = [
        'name',
        'publish',
        'description',
    ];
    protected $table = 'user_catalogues';
    public function users(){
        return $this->hasMany(User::class, 'user_catalogue_id', 'id');
    }
}
