<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model {
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_number', 'customer_name', 'email', 'total'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    
    public function createOrder($data, $items) {
        $this->db->transStart();
        
        // Insert order
        $this->insert($data);
        $orderId = $this->insertID();
        
        // Insert order items
        $orderItemModel = new OrderItemModel();
        foreach($items as $item) {
            $item['order_id'] = $orderId;
            $orderItemModel->insert($item);
        }
        
        $this->db->transComplete();
        return $this->db->transStatus();
    }
}

class OrderItemModel extends Model {
    protected $table = 'order_items';
    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'price'];
}