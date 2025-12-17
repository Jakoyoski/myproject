<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('/') ?>">MyShop</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline-light">Continue Shopping</a>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2>Your Shopping Cart</h2>
        
        <?php if(empty($cartItems)): ?>
            <div class="alert alert-info">Your cart is empty!</div>
            <a href="<?= site_url('/') ?>" class="btn btn-primary">Go Shopping</a>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cartItems as $item): ?>
                    <tr>
                        <td><?= $item['product']['name'] ?></td>
                        <td>$<?= number_format($item['product']['price'], 2) ?></td>
                        <td>
                            <form method="post" action="/update-cart" class="d-inline">
                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" style="width: 70px;">
                                <button type="submit" class="btn btn-sm btn-info">Update</button>
                            </form>
                        </td>
                        <td>$<?= number_format($item['quantity'] * $item['product']['price'], 2) ?></td>
                        <td>
                            <a href="<?=base_url('remove-from-cart/'.$item['id']) ?>" class="btn btn-danger btn-sm">Remove</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td><strong>$<?= number_format($cartTotal, 2) ?></strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            
            <div class="text-end">
                <a href="<?= site_url('/') ?>"class="btn btn-secondary">Continue Shopping</a>
                <a href="<?=base_url('checkout/')?>" class="btn btn-success">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>