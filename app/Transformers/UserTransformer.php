<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.7.18.
 * Time: 09.28
 */

namespace App\Transformers;

use App\User;

/**
 * Class UserTransformer
 * @package App\Transformers
 */
class UserTransformer extends \League\Fractal\TransformerAbstract
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'   => $user->id,
            'name' => $user->name,
        ];
    }
}