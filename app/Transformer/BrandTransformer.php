<?php

namespace Transformer;

/**
 * Description of BrandTransformer
 *
 * @author eloir
 */
class BrandTransformer extends \League\Fractal\TransformerAbstract {

    public function transform(\Entity\Brand $brand) {

        return[
            'id' => (int) $brand->getBrandId(),
            'name' => $brand->getName(),
            'links' => [
                'rel' => 'self',
                'uri' => \Util\SlimUtil::absoluteUrlFor('brand_by_id', ['id'=>$brand->getBrandId()]),
                'method' => 'GET',
            ]
        ];
    }

}
