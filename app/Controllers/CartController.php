<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProductModel;

class CartController extends BaseController
{
    public function add()
    {
        // Ambil ID produk dari input
        $productId = $this->request->getPost('product_id');

        // Ambil keranjang dari sesi
        $cart = session()->get('cart');

        // Jika keranjang belum ada, buat keranjang baru
        if (!$cart) {
            $cart = [];
        }

        // Tambahkan produk ke keranjang
        if (isset($cart[$productId])) {
            $cart[$productId]++;
        } else {
            $cart[$productId] = 1;
        }

        // Simpan keranjang ke sesi
        session()->set('cart', $cart);

        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->to('/products')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function index()
    {
        $cart = session()->get('cart');
        $productModel = new ProductModel();
        $products = $productModel->findAll();
        return view('cart/index', ['cart' => $cart, 'products' => array_column($products, null, 'id')]);
    }

    public function remove($productId)
    {
        // Ambil keranjang dari sesi
        $cart = session()->get('cart');

        // Hapus produk dari keranjang
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        // Simpan kembali keranjang ke sesi
        session()->set('cart', $cart);

        // Redirect ke halaman keranjang dengan pesan sukses
        return redirect()->to('/cart')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        // Hapus keranjang dari sesi
        session()->remove('cart');

        // Redirect ke halaman keranjang dengan pesan sukses
        return redirect()->to('/cart')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function checkout()
    {
        $session = session();
        $cart = $session->get('cart');
        $user_id = $session->get('user_id'); // Assuming you store user ID in session
        $productModel = new ProductModel();

        // Calculate total price
        $totalPrice = 0;
        foreach ($cart as $productId => $quantity) {
            $product = $productModel->find($productId);
            $totalPrice += $product['price'] * $quantity;
        }

        // Insert into orders table
        $orderModel = new OrderModel();
        $orderData = [
            'user_id' => $user_id,
            'total_price' => $totalPrice,
            'status' => 'Pending', // Assuming the initial status is Pending
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $user_id,
            'updated_by' => $user_id
        ];
        $orderModel->insert($orderData);
        $orderId = $orderModel->getInsertID();

        // Insert into order_items table
        $orderItemModel = new OrderItemModel();
        foreach ($cart as $productId => $quantity) {
            $product = $productModel->find($productId);
            $orderItemData = [
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product['price'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => $user_id,
                'updated_by' => $user_id
            ];
            $orderItemModel->insert($orderItemData);
        }

        // Clear the cart
        $session->remove('cart');
        $session->setFlashdata('success', 'Checkout successful! Your order has been placed.');

        return redirect()->to('/cart');
    }
}
