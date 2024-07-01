<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\ProductModel;

class CartController extends BaseController
{
    protected $productModel;
    protected $orderModel;
    protected $orderItemModel;


    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->orderModel = new OrderModel();
    }


    public function add()
    {
        // Ambil product_id dari form POST
        $productId = $this->request->getPost('product_id');

        // Ambil session keranjang jika ada atau buat baru jika belum ada
        $cart = session()->get('cart') ?? [];

        // Tambahkan product_id ke dalam session keranjang
        $cart[] = $productId;

        // Simpan kembali session keranjang
        session()->set('cart', $cart);

        // Tampilkan pesan sukses atau error jika perlu
        session()->setFlashdata('success', 'Produk telah ditambahkan ke keranjang.');

        // Redirect ke halaman sebelumnya atau ke halaman produk jika perlu

        return redirect()->to('/products')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function index()
    {
        // Ambil session keranjang jika ada
        $cart = session()->get('cart') ?? [];

        // Contoh pengambilan data produk berdasarkan $cart['product_id'] dari database
        // Misalnya, Anda memiliki model ProductModel untuk mengelola data produk
        $productModel = new \App\Models\ProductModel();
        $products = [];
        foreach ($cart as $productId) {
            $product = $productModel->find($productId);
            if ($product) {
                $products[] = $product;
            }
        }

        // Tampilkan view list keranjang dengan data produk yang berhasil diambil
        return view('cart/index', ['products' => $products]);
    }

    public function checkout()
    {
        // dd(session());
        // Ambil user_id dari sesi atau sesuaikan dengan kebutuhan Anda
        $userId = session('id'); // Contoh: Ganti dengan sesuai dengan cara Anda mengelola user_id

        // Ambil produk yang dipilih untuk checkout dari form POST
        $selectedProducts = $this->request->getPost('selected_products');
        // dd($selectedProducts);
        if (empty($selectedProducts)) {
            session()->setFlashdata('error', 'Please select at least one product to checkout.');
            return redirect()->to('/cart');
        }

        // Hitung total harga dari produk yang dipilih untuk checkout
        $totalPrice = 0;
        $productIds = [];
        foreach ($selectedProducts as $productId) {
            // Hitung total harga dengan mengambil data produk dari database (misalnya dari ProductModel)
            $productModel = new \App\Models\ProductModel();
            $product = $productModel->find($productId);
            if ($product) {
                $totalPrice += $product['price'];
                $productIds[] = $productId;
            }
        }

        // Simpan data pesanan ke dalam tabel orders
        $orderModel = new OrderModel();
        $data = [
            'user_id' => $userId,
            'product_id' => implode(',', $productIds), // Simpan dalam bentuk string pisahkan dengan koma jika perlu
            'total_price' => $totalPrice,
            'status' => 'Pending', // Atur status sesuai dengan logika aplikasi Anda
        ];
        $orderModel->save($data);

        // Hapus session keranjang setelah checkout
        // session()->remove('cart');

        // Tampilkan pesan sukses dan redirect ke halaman terima kasih atau halaman lain yang sesuai
        session()->setFlashdata('success', 'Pesanan berhasil diproses.');
        return redirect()->to('/orders');
    }
}
