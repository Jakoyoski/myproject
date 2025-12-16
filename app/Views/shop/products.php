<!DOCTYPE html>
<html>
<head>
    <title>Online Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card { transition: transform 0.2s; }
        .product-card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">MyShop</a>
            <div class="ms-auto">
                <a href="<?=base_url('cart')?>" class="btn btn-outline-light">
                    🛒 Cart <span class="badge bg-danger"><?= $cartCount ?></span>
                </a>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2>Our Products</h2>
        
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        
        <div class="row mt-4">
            <?php foreach($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card product-card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text"><?= $product['description'] ?></p>
                        <p class="h4 text-primary">$<?= number_format($product['price'], 2) ?></p>
                        <a href="<?= base_url('add-to-cart/' . $product['id']) ?>" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
  
</body>
</html>