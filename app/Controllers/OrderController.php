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
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Pastikan pengguna telah login
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }

        // Ambil ID pengguna yang sedang login
        $userId = session()->get('id');

        // Ambil pesanan yang dimiliki oleh pengguna yang sedang login
        $data['orders'] = $this->orderModel->where('user_id', $userId)->findAll();

        return view('orders/index', $data);
    }

    public function view($id)
    {
        // Mengambil data pesanan berdasarkan $id dari database
        $order = $this->orderModel->find($id);

        // Mengambil data produk dari database berdasarkan product_id dari pesanan
        $product = $this->productModel->find($order['product_id']);

        // Mengambil data pengguna dari database berdasarkan user_id dari pesanan
        $user = $this->userModel->find($order['user_id']);

        // Tampilkan view detail pesanan dengan data $order, $product, dan $user
        return view('orders/view', [
            'order' => $order,
            'product' => $product,
            'user' => $user
        ]);
    }
}
