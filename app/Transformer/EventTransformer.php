<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Transformer;

/**
 * Description of EventTransformer
 *
 * @author eloir
 */
class EventTransformer extends \League\Fractal\TransformerAbstract {

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'user'
    ];

    public function transform(\Entity\Event $event) {

        return[
            'id' => (int) $event->getId(),
            'equipment_id' => (int) $event->getEquipmentId(),
            'user_id' => (int) $event->getUserId(),
            'create_timestamp' => $event->getTimestamp(),
            'description' => $event->getDescription(),
            'type' => $event->getType(),
            'time' => $event->getTime(),
            'links' => [
                'rel' => 'self',
                'uri' => \Util\SlimUtil::absoluteUrlFor('list_events_by_id', ['id' => $event->getId()]),
                'method' => 'GET',
            ]
        ];
    }
    
    /**
     * Include Author
     *
     * @return League\Fractal\ItemResource
     */
    public function includeUser(\Entity\Event $event)
    {
        $user = $event->getUser();

        return $this->item($user, new UserTransformer());
    }

}
