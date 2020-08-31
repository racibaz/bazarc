<?php

namespace App\Presenters;

use App\Transformers\ActivityLogTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ActivityPresenter.
 */
class ActivityLogPresenter extends FractalPresenter
{
    /**
     * Transformer.
     *
     * @return ActivityLogTransformer
     */
    public function getTransformer()
    {
        return new ActivityLogTransformer();
    }
}
