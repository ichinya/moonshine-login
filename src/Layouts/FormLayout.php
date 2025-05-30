<?php

declare(strict_types=1);

namespace Ichinya\MoonshineLogin\Layouts;

use MoonShine\Laravel\Layouts\CompactLayout;
use MoonShine\UI\Components\Components;
use MoonShine\UI\Components\Layout\Body;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Components\Layout\Flash;
use MoonShine\UI\Components\Layout\Html;
use MoonShine\UI\Components\Layout\Layout;

final class FormLayout extends CompactLayout
{
    protected function getHomeUrl(): string
    {
        return route('home');
    }

    public function build(): Layout
    {
        return Layout::make([
            Html::make([
                $this->getHeadComponent(),
                Body::make([
                    Div::make([
                        Div::make([
                            $this->getLogoComponent(),
                        ])->class('authentication-logo'),
                        Div::make([
                            Flash::make(),
                            Components::make($this->getPage()->getComponents()),
                        ])->class('authentication-content'),
                    ])->class('authentication'),
                ]),
            ])
                ->customAttributes([
                    'lang' => $this->getHeadLang(),
                ])
                ->withAlpineJs()
                ->withThemes(),
        ]);
    }
}
