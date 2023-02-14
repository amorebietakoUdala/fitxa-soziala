<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    protected array $queryParams = []; 

    protected function loadQueryParameters(Request $request) {
        if (
            $request->getMethod() === Request::METHOD_GET || 
            $request->getMethod() === Request::METHOD_POST || 
            $request->getMethod() === Request::METHOD_DELETE ) {
            $this->queryParams['page'] = 0;
            $this->queryParams['pageSize'] = 10;
            $this->queryParams['sortName'] = 0;
            $this->queryParams['sortOrder'] = 'desc';
            $this->queryParams['returnUrl'] = null;
            $this->queryParams = array_merge($this->queryParams, $request->query->all());
            if ( $this->queryParams !== null ) {
                $query = parse_url($this->queryParams['returnUrl'], PHP_URL_QUERY);
                parse_str($query,$query);
                $this->queryParams = array_merge($this->queryParams, $query);
            }
        }
    }

    protected function getPaginationParameters() : array {
        return $this->queryParams;
    }

    protected function getAjax(): bool {
        if ( array_key_exists('ajax', $this->queryParams) ) {
            return $this->queryParams['ajax'] === 'true' ? true : false;
        }
        
        return false;
    }

    protected function render(string $view, array $parameters = [], Response $response = null): Response {
        $paginationParameters = $this->getPaginationParameters();
        $viewParameters = array_merge($parameters, $paginationParameters);
        return parent::render($view, $viewParameters, $response);
    }

    protected function redirectToRoute(string $route, array $parameters = [], int $status = 302): RedirectResponse {
        $paginationParameters = $this->getPaginationParameters();
        $viewParameters = array_merge($parameters, $paginationParameters);
        if ( strpos($route, '_index') || strpos($route, '_list') ) {
            unset($viewParameters['returnUrl']);
        }
        return parent::redirectToRoute($route, $viewParameters, $status);
    }    
}
