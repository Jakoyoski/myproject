<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | MyShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .table img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; }
        .cart-card { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= site_url('/') ?>"><i class="bi bi-shop me-2"></i>MyShop</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Continue Shopping
            </a>
        </div>
    </nav>
    
    <div class="container">
        <h2 class="mb-4 fw-bold">Shopping Cart</h2>
        
        <?php if(empty($cartItems)): ?>
            <div class="card cart-card p-5 text-center">
                <div class="card-body">
                    <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3">Your cart is currently empty!</h4>
                    <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
                    <a href="<?= site_url('/') ?>" class="btn btn-primary px-4 mt-2">Start Shopping</a>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card cart-card mb-4">
                        <div class="table-responsive p-3">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th style="width: 150px;">Quantity</th>
                                        <th>Total</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cartItems as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold"><?= $item['product']['name'] ?></div>
                                            <small class="text-muted">ID: #<?= $item['id'] ?></small>
                                        </td>
                                        <td>$<?= number_format($item['product']['price'], 2) ?></td>
                                        <td>
                                            <form method="post" action="<?= site_url('/update-cart') ?>" class="input-group input-group-sm">
                                                <?= csrf_field() ?> <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="form-control">
                                                <button type="submit" class="btn btn-outline-secondary">
                                                    <i class="bi bi-arrow-clockwise"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="fw-bold">$<?= number_format($item['quantity'] * $item['product']['price'], 2) ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('remove-from-cart/'.$item['id']) ?>" class="text-danger fs-5" title="Remove Item">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card cart-card border-0">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Order Summary</h5>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>$<?= number_format($cartTotal, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>Shipping</span>
                                <span>Free</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="h5 fw-bold">Total</span>
                                <span class="h5 fw-bold">$<?= number_format($cartTotal, 2) ?></span>
                            </div>
                            <a href="<?= base_url('checkout/') ?>" class="btn btn-success w-100 py-2 fw-bold">
                                Proceed to Checkout <i class="bi bi-credit-card ms-2"></i>
                            </a>
                            <div class="text-center mt-3">
                                <a href="<?= site_url('/') ?>" class="text-muted text-decoration-none small">
                                    <i class="bi bi-chevron-left"></i> Keep Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>