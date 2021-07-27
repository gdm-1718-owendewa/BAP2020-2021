<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author',
        'author_id',
        'title',
        'description',
        'capacity',
        'location',
        'start_date',    
        'end_date',     
        'start_time',    
        'start_hour',    
        'start_minute',   
        'end_time',         
        'end_hour',     
        'end_minute',     
    
    ];
}
