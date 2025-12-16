<?php
namespace App\Libraries;

class Cart {
    protected $session;
    
    public function __construct() {
        $this->session = session();
        if(!$this->session->has('cart')) {
            $this->session->set('cart', []);
        }
    }
    
    public function add($productId, $quantity = 1, $productData = null) {
        $cart = $this->session->get('cart');
        
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'quantity' => $quantity,
                'product' => $productData
            ];
        }
        
        $this->session->set('cart', $cart);
        return true;
    }
    
    public function update($productId, $quantity) {
        $cart = $this->session->get('cart');
        
        if(isset($cart[$productId])) {
            if($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
            
            $this->session->set('cart', $cart);
            return true;
        }
        
        return false;
    }
    
    public function remove($productId) {
        $cart = $this->session->get('cart');
        
        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->session->set('cart', $cart);
            return true;
        }
        
        return false;
    }
    
    public function getItems() {
        return $this->session->get('cart') ?? [];
    }
    
    public function getTotal() {
        $total = 0;
        $cart = $this->getItems();
        
        foreach($cart as $item) {
            if(isset($item['product']['price'])) {
                $total += $item['quantity'] * $item['product']['price'];
            }
        }
        
        return $total;
    }
    
    public function count() {
        $count = 0;
        $cart = $this->getItems();
        
        foreach($cart as $item) {
            $count += $item['quantity'];
        }
        
        return $count;
    }
    
    public function clear() {
        $this->session->remove('cart');
    }
}