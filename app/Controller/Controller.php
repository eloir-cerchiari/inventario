<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

class Controller {

    /**
     * @var \Slim\Slim
     */
    protected $app;

    /**
     * Constructor
     */
    public function __construct() {

        $this->app = \Slim\Slim::getInstance();
    }

    /**
     * 
     * @param \League\Fractal\Resource\ResourceInterface $fractal
     */
    protected function writeJson($resource, $status = 200) {


        $fractal = new \League\Fractal\Manager();

        $this->app->response->setStatus($status);


        $this->app->response->headers->set('Content-Type', 'application/json');
        $this->app->contentType('application/json;  charset=utf-8');

        $this->app->response->setBody(json_encode($fractal->createData($resource)->toArray(), JSON_UNESCAPED_SLASHES));
    }

    protected function renderHtml($htmlFile, $data = [], $status = 200) {
        $this->app->render($htmlFile, $data, $status);
    }

    protected function error($message, $status = 404) {
        $this->app->response()->setStatus($status);
        $this->app->response->setBody('{"error":{"text":' . $message . '}}');
    }

}
