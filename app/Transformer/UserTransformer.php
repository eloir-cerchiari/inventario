<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Transformer;

/**
 * Description of UserTransformer
 *
 * @author eloir
 */
class UserTransformer  extends \League\Fractal\TransformerAbstract {

    public function transform(\Entity\User $user) {

        return[
            'id' => (int) $user->getUserId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'active' => $user->getActive(),
            'group' => $user->getGroup(),
            'links' => [
                'rel' => 'self',
                'uri' => \Util\SlimUtil::absoluteUrlFor('user_by_id', ['id'=>$user->getUserId()]),
                'method' => 'GET',
            ]
        ];
    }

}
