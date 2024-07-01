<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }

        // Ambil semua data produk
        $data['products'] = $this->productModel->findAll();

        // Tampilkan view index dengan data produk
        return view('products/index', $data);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }

        return view('products/create');
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }
        helper(['form']);
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Proses simpan data produk
        $image = $this->request->getFile('image');
        $imageName = $image->getRandomName();
        $image->move(ROOTPATH . 'public/uploads', $imageName);

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'image' => $imageName,
            'created_by' => session()->get('id'), // Sesuaikan dengan session user Anda
            'updated_by' => session()->get('id')  // Sesuaikan dengan session user Anda
        ];

        $this->productModel->insert($data);

        // Redirect ke halaman produk setelah berhasil disimpan
        return redirect()->to('/products')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }
        // Ambil data produk berdasarkan ID
        $data['product'] = $this->productModel->find($id);

        // Tampilkan form edit produk
        return view('products/edit', $data);
    }

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }
        helper(['form']);
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'max_size[image,1024]|is_image[image]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data produk berdasarkan ID
        $product = $this->productModel->find($id);
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }

        // Proses update data produk
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'updated_by' => session()->get('id'), // Sesuaikan dengan session user Anda
        ];

        // Cek apakah ada file gambar yang diupload
        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            // Hapus gambar lama jika ada
            if ($product['image'] && file_exists(ROOTPATH . 'public/uploads/' . $product['image'])) {
                unlink(ROOTPATH . 'public/uploads/' . $product['image']);
            }

            // Pindahkan gambar baru
            $imageName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $imageName);

            $data['image'] = $imageName;
        }

        $this->productModel->update($id, $data);

        // Redirect ke halaman produk setelah berhasil diupdate
        return redirect()->to('/products')->with('success', 'Product updated successfully');
    }


    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }
        // Hapus data produk berdasarkan ID
        $this->productModel->delete($id);

        // Redirect ke halaman produk setelah berhasil dihapus
        return redirect()->to('/products')->with('success', 'Product deleted successfully');
    }
}
