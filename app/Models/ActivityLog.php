<?php

namespace App\Models;

use App\Presenters\ActivityLogPresenter;
use App\Transformers\ActivityLogTransformer;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ActivityLog.
 */
class ActivityLog extends Model implements Transformable
{
    use TransformableTrait;

    public $transformer = ActivityLogTransformer::class;
    protected $table = 'activity_log';
    protected $presenter = ActivityLogPresenter::class;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'log_name',
        'description',
        'subject_id',
        'subject_type',
        'causer_id',
        'causer_type',
        'properties',
    ];
}
