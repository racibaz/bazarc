<?php

namespace App\Transformers;

use App\Policies\ActivityLogPolicy;
use League\Fractal\TransformerAbstract;

class ActivityLogTransformer extends TransformerAbstract
{
    /**
     * Transform the User entity.
     *
     * @param ActivityLogPolicy $model
     *
     * @return array
     */
    public function transform(ActivityLogPolicy $model)
    {
        return [
            'id' => (int)$model->id,
            'log_name' => $model->log_name,
            'description' => $model->description,
            'subject_id' => $model->subject_id,
            'subject_type' => $model->subject_type,
            'causer_id' => $model->causer_id,
            'causer_type' => $model->causer_type,
            'properties' => (string) $model->properties,
            'created_at' => (string)$model->created_at,
            'updated_at' => (string)$model->updated_at,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.show', $model->id),
                ],
            ]
        ];
    }

    /**
     * @param $index
     * @return mixed|null
     */
    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'log_name' => 'log',
            'description' => 'description',
            'subject_id' => 'subject_id',
            'subject_type' => 'subject_type',
            'causer_id' => 'causer_id',
            'causer_type' => 'causer_type',
            'properties' => 'properties',
            'status' => 'status'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    /**
     * @param $index
     *
     * @return mixed|null
     */
    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identifier',
            'log' => 'log_name',
            'description' => 'description',
            'subject_id' => 'subject_id',
            'subject_type' => 'subject_type',
            'causer_id' => 'causer_id',
            'causer_type' => 'causer_type',
            'properties' => 'properties',
            'status' => 'status'
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }


}
