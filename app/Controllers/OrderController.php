<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class OrderController extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;
    protected $productModel;
    protected $userModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }

        $data['orders'] = $this->orderModel->findAll();
        return view('orders/index', $data);
    }
}
