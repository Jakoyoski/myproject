<?php
namespace App\Controllers;

use App\Models\ProductModel;

class Shop extends BaseController {
    protected $productModel;
    protected $cart;
    
    public function __construct() {
        $this->productModel = new ProductModel();
        $this->cart = service('cart');
    }
    
    public function index() {
        $data = [
            'products' => $this->productModel->findAll(),
            'cartCount' => $this->cart->count()
        ];
        
        return view('shop/products', $data);
    }
    
    public function viewCart() {
        $cartItems = $this->cart->getItems();
        $productIds = array_keys($cartItems);
        
        // Get full product details for items in cart
        if(!empty($productIds)) {
            $products = $this->productModel->find($productIds);
            foreach($cartItems as &$item) {
                foreach($products as $product) {
                    if($product['id'] == $item['id']) {
                        $item['product'] = $product;
                        break;
                    }
                }
            }
        }
        
        $data = [
            'cartItems' => $cartItems,
            'cartTotal' => $this->cart->getTotal(),
            'cartCount' => $this->cart->count()
        ];
        
        return view('shop/view_cart', $data);
    }
    
    public function addToCart($productId) {
        $product = $this->productModel->find($productId);
        
        if($product) {
            $this->cart->add($productId, 1, $product);
            return redirect()->back()->with('success', 'Product added to cart!');
        }
        
        return redirect()->back()->with('error', 'Product not found!');
    }
    
    public function updateCart() {
        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity');
        
        if($this->cart->update($productId, $quantity)) {
            return redirect()->to('/cart')->with('success', 'Cart updated!');
        }
        
        return redirect()->to('/cart')->with('error', 'Failed to update cart!');
    }
    
    public function removeFromCart($productId) {
        if($this->cart->remove($productId)) {
            return redirect()->to('/cart')->with('success', 'Product removed from cart!');
        }
        
        return redirect()->to('/cart')->with('error', 'Failed to remove product!');
    }
    
    public function checkout() {
        if($this->cart->count() == 0) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty!');
        }
        
        return view('shop/checkout', [
            'cartTotal' => $this->cart->getTotal(),
            'cartCount' => $this->cart->count()
        ]);
    }
    public function processCheckout() {
    $cartItems = $this->cart->getItems();
    
    if(empty($cartItems)) {
        return redirect()->to('/cart')->with('error', 'Cart is empty!');
    }
    
    // Validate form input
    $rules = [
        'name' => 'required|min_length[3]',
        'email' => 'required|valid_email',
        'address' => 'required|min_length[10]'
    ];
    
    if(!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
    
    // Create order data
    $orderModel = new \App\Models\OrderModel();
    
    $orderData = [
        'order_number' => 'ORD-' . time() . rand(100, 999),
        'customer_name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'total' => $this->cart->getTotal()
    ];
    
    // Prepare order items
    $orderItems = [];
    foreach($cartItems as $item) {
        $orderItems[] = [
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price' => $item['product']['price']
        ];
    }
    
    // Save order
    if($orderModel->createOrder($orderData, $orderItems)) {
        // Clear cart
        $this->cart->clear();
        
        // Send email (optional)
        // $this->sendOrderConfirmation($orderData);
        
        return view('shop/order_success', [
            'orderNumber' => $orderData['order_number'],
            'orderTotal' => $orderData['total']
        ]);
    }
    
    return redirect()->back()->with('error', 'Failed to process order. Please try again.');
}
}