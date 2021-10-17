<?php

namespace app\modules\portfolio\presentators;

use app\modules\portfolio\models\Portfolio;
use app\modules\portfolio\readModels\PortfolioReadRepository;
use yii\helpers\Url;
use yii\helpers\VarDumper;

class PortfolioPresentator
{
    private $portfolios;

    public function __construct(PortfolioReadRepository $portfolios)
    {
        $this->portfolios = $portfolios;
    }

    public function getPortfolios()
    {
        $dataProvider = $this->portfolios->getList();

        return [
            'reveiws' => array_map(function (Portfolio $portfolio) {
                return [
                    'id' => $portfolio->id,
                    'meta' => $portfolio->getMetaTags(),
                    'alias' => $portfolio->alias,
                    'description' => $portfolio->description,
                    'title' => $portfolio->title,
                    'image' => Url::to($portfolio->getImageFileUrl('image'), true),
                ];
            }, $dataProvider->getModels()),
            'pagination' => $dataProvider->pagination,
        ];
    }

    public function getPortfolio($alias)
    {
        $portfolio = $this->portfolios->getPortfolio($alias);

        return [
            'id' => $portfolio->id,
            'meta' => $portfolio->getMetaTags(),
            'alias' => $portfolio->alias,
            'description' => $portfolio->description,
            'title' => $portfolio->title,
            'image' => Url::to($portfolio->getImageFileUrl('image'), true),
        ];
    }
}