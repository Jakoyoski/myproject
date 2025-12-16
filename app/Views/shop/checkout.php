<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Checkout</h2>
        <div class="row">
            <div class="col-md-8">
                <form method="post" action="/process-checkout">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Shipping Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    
                    <h5 class="mt-4">Order Summary</h5>
                    <div class="card">
                        <div class="card-body">
                            <p class="h4 text-end">Total: $<?= number_format($cartTotal, 2) ?></p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="/cart" class="btn btn-secondary">Back to Cart</a>
                        <button type="submit" class="btn btn-success">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>