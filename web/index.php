<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';
$app = new \Slim\Slim(
        array(
            'debug' => true,
            'log.level' => \Slim\Log::DEBUG,
            'templates.path' => '../app/view'
        )
);
$app->get('/hello/:name', 'Controller\Foo:bar');
$app->get('/', 'Controller\IndexController:index');
$app->get('/cadastro', 'Controller\IndexController:cadastros');
$app->get('/api/v1/areas', 'Controller\AreaController:listAreasAction');
$app->get('/api/v1/areas/:id', 'Controller\AreaController:getAreaAction')->name('area_by_id');
/* $app->get('/api/v1/brands', 'Controller\BrandController:listBrandsAction');
 * $app->get('/api/v1/brands/:id', 'Controller\BrandController:getBrandAction')->name('brand_by_id');
 * $app->put('/api/v1/brands/:id', 'Controller\BrandController:putBrandAction')->name('brand_put_by_id');
 * $app->delete('/api/v1/brands/:id', 'Controller\BrandController:deleteBrandAction')->name('brand_delete_by_id');
 * $app->post('/api/v1/brands', 'Controller\BrandController:postBrandAction')->name('post_brand');
 */

$app->run();
