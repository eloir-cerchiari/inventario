<?php

namespace Transformer;

/**
 * Description of AreaTransformer
 *
 * @author eloir
 */
class AreaTransformer extends \League\Fractal\TransformerAbstract {

    public function transform(\Entity\Area $area) {

        return[
            'id' => (int) $area->getAreaId(),
            'name' => $area->getName(),
            'links' => [
                'rel' => 'self',
                'uri' => \Util\SlimUtil::absoluteUrlFor('area_by_id', ['id'=>$area->getAreaId()]),
                'method' => 'GET',
            ]
        ];
    }

}
