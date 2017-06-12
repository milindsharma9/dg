<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;
use Log;
use Cache;
use DB;
use Illuminate\Pagination\Paginator;
class News extends Model
{
    //
	/**
     * Set table name.
     * @var type 
     */
    protected $table = "news";
    //only allow the following items to be mass-assigned to our model
    protected $fillable = ['title', 'description', 'filename',  'published'];
}
