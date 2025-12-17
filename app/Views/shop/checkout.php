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