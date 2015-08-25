<?php

namespace Controller;

/**
 * Description of BrandController
 *
 * @author eloir
 */
class BrandController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function listBrandsAction() {

        $brandsRep = new \Repository\BrandRepository();
        $brands = $brandsRep->listBrands();

        $resource = new \League\Fractal\Resource\Collection($brands, new \Transformer\BrandTransformer());

        $this->writeJson($resource);
    }

    public function getBrandAction($id) {

        $brandsRep = new \Repository\BrandRepository();
        $brand = $brandsRep->getBrand($id);
//echo json_encode($brand);

        $resource = new \League\Fractal\Resource\Item($brand, new \Transformer\BrandTransformer());

        return $this->writeJson($resource);
    }

    public function postBrandAction() {

        try {

            $app = \Slim\Slim::getInstance();
            $data = $app->request->getBody();

            $brandPost = json_decode($data);

            $brand = new \Entity\Brand();
            $brand->setName($brandPost->name);

            $this->validateBrand($brand);

            $brandsRep = new \Repository\BrandRepository();

            if ($brandsRep->exists($brand)) {
                throw new \Exception('Brand already exists');
            }

            $brandsRep->insert($brand);


            $returnBrands = $brandsRep->finByName($brand->getName());
            
            if (count($returnBrands) > 1){
                throw new Exception('Many brands');
            }

            $resource = new \League\Fractal\Resource\Item($returnBrands[0], new \Transformer\BrandTransformer());

            return $this->writeJson($resource, 200);
        } catch (\Exception $exc) {

            return $this->error($exc->getMessage());
        }
    }

    public function putBrandAction($id) {

        try {

            $app = \Slim\Slim::getInstance();
            $app->add(new \Slim\Middleware\ContentTypes());
            $data = $app->request()->getBody();

            $brandPut = json_decode($data);


            $brandRep = new \Repository\BrandRepository();
            $brand = $brandRep->getBrand($id);


            $brand->setName($brandPut->name);


            $this->validateBrand($brand);

            $brand->getName();

            $brandRep->update($brand);

            $resource = new \League\Fractal\Resource\Item($brand, new \Transformer\BrandTransformer());
            return $this->writeJson($resource, 200);
        } catch (\Exception $exc) {

            return $this->error($exc->getMessage());
        }
    }

    /**
     * 
     * @param \Entity\Brand $brand
     */
    public function validateBrand($brand) {

        if (get_class($brand) != 'Entity\Brand') {
            throw new \Exception('Invalid Brand');
        }

        if (strlen($brand->getName()) < 3) {
            throw new \Exception('Minimun name size is 3 chars');
        }

        if (strlen($brand->getName()) > 40) {
            throw new \Exception('Maximun name size is 40 chars');
        }

        return true;
    }

}
