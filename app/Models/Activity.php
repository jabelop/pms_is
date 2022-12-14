<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Activity extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'project_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * The users that belong to the activity.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_activities', 'activity_id', 'user_id')->withPivot('rol');
    }

    /**
     * The incidences that belong to the activity.
     */
    public function incidences()
    {
        return $this->hasMany(Incidence::class,'activity_id');
    }
}