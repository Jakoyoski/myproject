<?php
namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'order_number', 'customer_name', 'email', 'phone', 
        'address', 'city', 'zipcode', 'notes', 'total', 'status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}