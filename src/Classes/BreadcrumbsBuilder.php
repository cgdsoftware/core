<?php

namespace LaravelEnso\Core\Classes;

use LaravelEnso\Core\Classes\MenuManager\CurrentMenuDetector;
use LaravelEnso\Core\Enums\PagesBreadcrumbsEnum;

class BreadcrumbsBuilder
{
    private $breadcrumbs;
    private $breadcrumbsEnum;
    private $menus;
    private $currentMenu;

    public function __construct($menus)
    {
        $this->menus = $menus;
        $this->breadcrumbs = collect();
        $this->breadcrumbsEnum = new PagesBreadcrumbsEnum();
        $currentMenuDetector = new CurrentMenuDetector($menus);
        $this->currentMenu = $currentMenuDetector->getData();
    }

    public function getBreadcrumbs()
    {
        $this->buildBreadcrumbs();

        return $this->breadcrumbs;
    }

    private function buildBreadcrumbs()
    {
        $currentMenu = $this->currentMenu;

        while ($currentMenu) {
            $this->prependBreadcrumb($currentMenu);

            $currentMenu = $currentMenu->parent;
        }

        $this->appendTermination();
    }

    private function appendTermination()
    {
        $termination = $this->getRouteTermination();

        if ($this->breadcrumbsEnum->hasKey($termination)) {
            $termination = $this->breadcrumbsEnum->getValueByKey($termination);
        }

        $this->pushBreadcrumb($termination);
    }

    private function prependBreadcrumb($currentMenu)
    {
        $this->breadcrumbs->prepend([
            'label' => strtolower(__($currentMenu->name)),
            'link'  => $currentMenu->link,
        ]);
    }

    private function pushBreadcrumb($termination)
    {
        $this->breadcrumbs->push([
            'label' => $termination,
            'link'  => request()->path(),
        ]);
    }

    private function getRouteTermination()
    {
        $routeArray = explode('.', request()->route()->getName());

        return end($routeArray);
    }
}
