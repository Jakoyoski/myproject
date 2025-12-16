<?php
namespace App\Controllers;

class CartController extends BaseController {
    protected $cart;
    
    public function __construct() {
        $this->cart = service('cart');
    }
    
    public function ajaxAdd() {
        $productId = $this->request->getPost('product_id');
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($productId);
        
        if($product) {
            $this->cart->add($productId, 1, $product);
            return $this->response->setJSON([
                'success' => true,
                'cartCount' => $this->cart->count(),
                'message' => 'Product added to cart'
            ]);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Product not found']);
    }
    
    public function getCartSummary() {
        return $this->response->setJSON([
            'count' => $this->cart->count(),
            'total' => number_format($this->cart->getTotal(), 2)
        ]);
    }
}