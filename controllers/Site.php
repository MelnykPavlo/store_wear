<?php

namespace controllers;

class Site extends Controller
{
    protected $productsModel;

    public function __construct()
    {
        $this->productsModel = new \models\Products();
    }

    public function actionIndex()
    {
        if(count($this->productsModel->GetLastProduct()) > 3)
            $count = 3;
        else
            $count = count($this->productsModel->GetLastProduct());
        $products = $this->productsModel->GetLastCountProduct($count);
        return $this->render('index', ['model' => $products], [
            'MainTitle' => 'MainTitle',
            'PageTitle' => ''
        ]);
    }

}