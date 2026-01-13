<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ApiKey extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'apikeys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'clientid',
        'key'
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'clientid');
    }

}