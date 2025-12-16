<?php
namespace Config;

use CodeIgniter\Config\BaseService;
use App\Libraries\Cart;

class Services extends BaseService {
    // ...
    
    public static function cart($getShared = true) {
        if ($getShared) {
            return static::getSharedInstance('cart');
        }
        
        return new Cart();
    }
}