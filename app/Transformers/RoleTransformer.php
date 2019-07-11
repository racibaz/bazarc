<?php

namespace App\Transformers;

use App\Models\Role;
use App\Models\User;
use League\Fractal\TransformerAbstract;

/**
 * Class RoleTransformer.
 *
 * @package namespace App\Transformers;
 */
class RoleTransformer extends TransformerAbstract
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
            'guard_name' => 'guard_name',
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
            'guard_name' => 'guard_name',
            'created_at' => 'creationDate',
            'updated_at' => 'lastChange',
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
    public function transform(Role $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->name,
            'guard_name' => $model->guard_name,
            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('roles.show', $model->id),
                ],
            ]
        ];
    }
}
