<?php
namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderModel;

class Shop extends BaseController
{
    protected $productModel;
    protected $cart;
    protected $orderModel;
    
    public function __construct()
    {
        helper(['url', 'form']);
        $this->productModel = model('ProductModel'); 
        $this->orderModel   = model('OrderModel');
        $this->cart = service('cart');
        
    }
    
    // Display all products
    public function index()
    {
        $data = [
            'title' => 'Products',
            'products' => $this->productModel->findAll(),
            'cartCount' => $this->cart->count(),
            'cartTotal' => $this->cart->getTotal()
        ];
        
        return view('shop/products', $data);
    }
    
    // View cart contents
    public function viewCart()
    {
        $cartItems = $this->cart->getItems();
        
        // Get full product details for items in cart
        if (!empty($cartItems)) {
            $productIds = array_column($cartItems, 'id');
            $products = $this->productModel->whereIn('id', $productIds)->findAll();
            
            // Merge product details with cart items
            $productMap = [];
            foreach ($products as $product) {
                $productMap[$product['id']] = $product;
            }
            
            foreach ($cartItems as &$item) {
                if (isset($productMap[$item['id']])) {
                    $item['product'] = $productMap[$item['id']];
                }
            }
        }
        
        $data = [
            'title' => 'Shopping Cart',
            'cartItems' => $cartItems,
            'cartCount' => $this->cart->count(),
            'cartTotal' => $this->cart->getTotal()
        ];
        
        return view('shop/view_cart', $data);
    }
    
    // Add product to cart
    public function addToCart($id)
    {
        $product = $this->productModel->find($id);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
        
        // Check stock availability
        if ($product['stock'] <= 0) {
            return redirect()->back()->with('error', 'Product out of stock!');
        }
        
        $this->cart->add($id, 1, $product);
        
        return redirect()->back()->with('success', '"' . $product['name'] . '" added to cart!');
    }
    
    // Update cart item quantity
    public function updateCart()
    {
        $productId = $this->request->getPost('product_id');
        $quantity = (int)$this->request->getPost('quantity');
        
        if ($quantity < 1) {
            return redirect()->to('/cart')->with('error', 'Quantity must be at least 1!');
        }
        
        // Check product stock
        $product = $this->productModel->find($productId);
        if ($product && $quantity > $product['stock']) {
            return redirect()->to('/cart')->with('error', 'Only ' . $product['stock'] . ' items in stock!');
        }
        
        if ($this->cart->update($productId, $quantity)) {
            return redirect()->to('/cart')->with('success', 'Cart updated successfully!');
        }
        
        return redirect()->to('/cart')->with('error', 'Failed to update cart!');
    }
    
    // Remove item from cart
    public function removeFromCart($id)
    {
        if ($this->cart->remove($id)) {
            return redirect()->to('/cart')->with('success', 'Item removed from cart!');
        }
        
        return redirect()->to('/cart')->with('error', 'Item not found in cart!');
    }
    
    // Clear entire cart
    public function clearCart()
    {
        $this->cart->clear();
        return redirect()->to('/cart')->with('success', 'Cart cleared!');
    }
    
    // Checkout page
    public function checkout()
    {
        if ($this->cart->count() == 0) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty!');
        }
        
        $data = [
            'title' => 'Checkout',
            'cartCount' => $this->cart->count(),
            'cartTotal' => $this->cart->getTotal(),
            'cartItems' => $this->cart->getItems()
        ];
        
        return view('shop/checkout', $data);
    }
    
    // Process checkout - COMPLETE FUNCTION
    public function processCheckout()
    {
        // Validate cart has items
        if ($this->cart->count() == 0) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty!');
        }
        
        // Validation rules
        $rules = [
            'customer_name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]|max_length[15]',
            'address' => 'required|min_length[10]',
            'city' => 'required',
            'zipcode' => 'required|numeric'
        ];
        
        // Custom error messages
        $messages = [
            'customer_name' => [
                'required' => 'Please enter your name',
                'min_length' => 'Name must be at least 3 characters'
            ],
            'email' => [
                'required' => 'Email is required',
                'valid_email' => 'Please enter a valid email address'
            ]
        ];
        
        // Run validation
        if (!$this->validate($rules, $messages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        
        // Get cart items with product details
        $cartItems = $this->cart->getItems();
        $productIds = array_column($cartItems, 'id');
        $products = $this->productModel->whereIn('id', $productIds)->findAll();
        
        // Create product map for quick lookup
        $productMap = [];
        foreach ($products as $product) {
            $productMap[$product['id']] = $product;
        }
        
        // Prepare order data
        $orderData = [
            'order_number' => 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid()),
            'customer_name' => $this->request->getPost('customer_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'city' => $this->request->getPost('city'),
            'zipcode' => $this->request->getPost('zipcode'),
            'notes' => $this->request->getPost('notes'),
            'total' => $this->cart->getTotal(),
            'status' => 'pending'
        ];
        
        // Prepare order items
        $orderItems = [];
        foreach ($cartItems as $item) {
            if (isset($productMap[$item['id']])) {
                $product = $productMap[$item['id']];
                
                // Check stock again before processing
                if ($item['quantity'] > $product['stock']) {
                    return redirect()->to('/cart')->with('error', 
                        'Insufficient stock for ' . $product['name'] . 
                        '. Only ' . $product['stock'] . ' available.');
                }
                
                $orderItems[] = [
                    'product_id' => $item['id'],
                    'product_name' => $product['name'],
                    'quantity' => $item['quantity'],
                    'price' => $product['price'],
                    'subtotal' => $item['quantity'] * $product['price']
                ];
                
                // Update stock (you could move this to after payment success)
                // $this->productModel->update($item['id'], [
                //     'stock' => $product['stock'] - $item['quantity']
                // ]);
            }
        }
        
        try {
            // Start database transaction
            $db = \Config\Database::connect();
            $db->transStart();
            
            // Save order
            $this->orderModel->save($orderData);
            $orderId = $this->orderModel->insertID();
            
            // Save order items
            $orderItemModel = new \App\Models\OrderItemModel();
            foreach ($orderItems as &$item) {
                $item['order_id'] = $orderId;
                $orderItemModel->save($item);
                
                // Update product stock
                $product = $productMap[$item['product_id']];
                $newStock = $product['stock'] - $item['quantity'];
                $this->productModel->update($item['product_id'], ['stock' => $newStock]);
            }
            
            // Complete transaction
            $db->transComplete();
            
            if ($db->transStatus() === FALSE) {
                throw new \Exception('Failed to save order');
            }
            
            // Clear cart
            $this->cart->clear();
            
            // Send confirmation email (optional)
            $this->sendOrderConfirmation($orderData, $orderItems);
            
            // Redirect to success page
            return redirect()->to('/order-success/' . $orderId)
                ->with('order_number', $orderData['order_number'])
                ->with('order_total', $orderData['total']);
                
        } catch (\Exception $e) {
            log_message('error', 'Checkout error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Order processing failed. Please try again.');
        }
    }
    
    // Order success page
    public function orderSuccess($orderId)
    {
        $order = $this->orderModel->find($orderId);
        
        if (!$order) {
            return redirect()->to('/')->with('error', 'Order not found!');
        }
        
        $orderItemModel = new \App\Models\OrderItemModel();
        $items = $orderItemModel->where('order_id', $orderId)->findAll();
        
        $data = [
            'title' => 'Order Confirmation',
            'order' => $order,
            'items' => $items,
            'cartCount' => $this->cart->count()
        ];
        
        return view('shop/order_success', $data);
    }
    
    // Send confirmation email (optional)
    private function sendOrderConfirmation($orderData, $items)
    {
        $email = \Config\Services::email();
        
        $email->setTo($orderData['email']);
        $email->setFrom('noreply@yourstore.com', 'Your Store');
        $email->setSubject('Order Confirmation: ' . $orderData['order_number']);
        
        $message = view('emails/order_confirmation', [
            'order' => $orderData,
            'items' => $items
        ]);
        
        $email->setMessage($message);
        
        // Uncomment to actually send
        // if (!$email->send()) {
        //     log_message('error', 'Email sending failed: ' . $email->printDebugger());
        // }
    }
    
    // AJAX: Get cart summary
    public function getCartSummary()
    {
        return $this->response->setJSON([
            'count' => $this->cart->count(),
            'total' => number_format($this->cart->getTotal(), 2)
        ]);
    }
}