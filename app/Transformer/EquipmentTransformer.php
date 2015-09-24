<?php

namespace Transformer;
/**
 * Description of EquipmentTransformer
 *
 * @author eloir
 */
class EquipmentTransformer extends \League\Fractal\TransformerAbstract{
    
    public function transform(\Entity\Equipment $equipment) {
    
        return[
            'equipment_id' => (int) $equipment->getEquipmentId(),
            'area_id' => (int) $equipment->getAreaId(),
            'name' => $equipment->getName(),
            'links' => [
                'rel' => 'self',
                'uri' => \Util\SlimUtil::absoluteUrlFor('equipment_by_id', ['id'=>$equipment->getEquipmentId()]),
                'method' => 'GET',
            ]
        ];    
    }
    
}
