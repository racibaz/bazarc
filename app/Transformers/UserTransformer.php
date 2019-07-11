<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * @param $index
     * @return mixed|null
     */
    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'slug' => 'slug',
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
            'name' => 'name',
            'email' => 'email',
            'verified' => 'isVerified',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    /**
     * Transform the User entity.
     *
     * @param User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name,
            'slug' => $model->slug,
            'email' => $model->email,
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
}
