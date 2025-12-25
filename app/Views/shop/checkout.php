
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>checkoute</title>
    
    <style>
        /* Your custom CSS goes here */
        body { background-color: #f8f9fa; }
    </style>
  </head>
  <body>
    <main class="container my-5">
        <h1>Welcome to MyShop</h1>
        <p>Start shopping our amazing collection.</p>
    </main>
<div class="container mt-4">
<form method="post" action="<?= base_url('process-checkout') ?>">
    <?= csrf_field() ?>
    
    <h4>Customer Information</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Full Name *</label>
                <input type="text" name="customer_name" class="form-control" 
                       value="<?= old('customer_name') ?>" required>
                <?php if(isset($errors['customer_name'])): ?>
                    <div class="text-danger"><?= $errors['customer_name'] ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label>Email *</label>
                <input type="email" name="email" class="form-control" 
                       value="<?= old('email') ?>" required>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Phone *</label>
                <input type="tel" name="phone" class="form-control" 
                       value="<?= old('phone') ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label>City *</label>
                <input type="text" name="city" class="form-control" 
                       value="<?= old('city') ?>" required>
            </div>
        </div>
    </div>
    
    <div class="mb-3">
        <label>Address *</label>
        <textarea name="address" class="form-control" rows="3" required><?= old('address') ?></textarea>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label>Zip Code *</label>
                <input type="text" name="zipcode" class="form-control" 
                       value="<?= old('zipcode') ?>" required>
            </div>
        </div>
    </div>
    
    <div class="mb-3">
        <label>Order Notes (Optional)</label>
        <textarea name="notes" class="form-control" rows="2"><?= old('notes') ?></textarea>
    </div>
    
    <h5 class="mt-4">Order Total: $<?= number_format($cartTotal, 2) ?></h5>
    
    <div class="mt-4">
        <a href="<?= base_url('cart') ?>" class="btn btn-secondary">Back to Cart</a>
        <button type="submit" class="btn btn-success">Place Order</button>
    </div>
</form>

</div>
<footer class="bg-light text-center py-4 mt-auto border-top">
        <div class="container">
            <p class="text-muted">&copy; 2025 MyShop Creation. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>