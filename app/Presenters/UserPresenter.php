<?php

namespace App\Presenters;

use App\Transformers\UserTransformer;
use League\Fractal\TransformerAbstract;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserPresenter.
 *
 * @package namespace App\Presenters;
 */
class UserPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }

    public function nameOrEmail()
    {
        return trim($this->name()) ?: $this->entity->email;
    }

    public function name()
    {
        return $this->name();
    }
}
