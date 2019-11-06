<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
/**
 * Example model for table
 */
class Crawler extends Model {
 
 
    protected $table = '';
    public $timestamps = false;
    protected $fillable = [
        'url',
        'title',
        'date_accessed',
    ];
}