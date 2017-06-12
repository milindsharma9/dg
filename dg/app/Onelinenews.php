<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;
use Log;
use Cache;
use DB;

use Illuminate\Pagination\Paginator;

class Onelinenews extends Model
{
    //
	    protected $table = "onelinenews";
    //only allow the following items to be mass-assigned to our model
    protected $fillable = ['title',  'published'];
}
