<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Model for spider table in db
 */
class CrawlerModel extends Model {
 
    protected $table = 'spider';
    public $timestamps = false;
    protected $fillable = [
        'url',
        'title',
        'num_of_links',
        'status_code',
        'body',
        'crawled_on',
    ];
}