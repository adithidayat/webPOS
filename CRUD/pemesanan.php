<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <div class="row">
            <!-- Left Side -->
            <div class="col-md-8">
                <h5 class="mb-3">Menu Item</h5>

                <!-- Item 1 -->
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <div class="d-flex">
                        <img src="https://via.placeholder.com/80" alt="Fusion Kitkat" class="img-thumbnail me-3">
                        <div>
                            <h6 class="mb-0">Fusion Kitkat&reg;</h6>
                        </div>
                    </div>
                    <div>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary">-</button>
                            <input type="text" class="form-control text-center" value="4" style="width: 50px;">
                            <button class="btn btn-outline-secondary">+</button>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-0">Rp. 74,544</h6>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <div class="d-flex">
                        <img src="https://via.placeholder.com/80" alt="Ayam Spicy" class="img-thumbnail me-3">
                        <div>
                            <h6 class="mb-0">1 Ayam Spicy 🌶️ 👍 + Nasi</h6>
                            <small class="text-decoration-line-through text-muted">Rp. 37,000</small>
                        </div>
                    </div>
                    <div>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary">-</button>
                            <input type="text" class="form-control text-center" value="1" style="width: 50px;">
                            <button class="btn btn-outline-secondary">+</button>
                        </div>
                    </div>
                    <div>
                        <h6 class="text-danger">Rp. 17,909</h6>
                    </div>
                </div>

                <!-- Continue Shopping -->
                <a href="#" class="text-primary">Continue Shopping</a>

                <!-- Add Notes -->
                <div class="mt-4">
                    <label for="notes" class="form-label">Add Notes</label>
                    <textarea class="form-control" id="notes" rows="2" placeholder="Add notes to your order here..."></textarea>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-md-4">
                <div class="border rounded p-4">
                    <h5 class="mb-3">Order Subtotal*</h5>
                    <h4 class="mb-4">Rp. 92,453</h4>
                    <small class="text-muted">*Price might change due to your delivery location.</small>
                    <div class="mt-4">
                        <button class="btn btn-warning w-100 mb-2">Login To Order</button>
                        <button class="btn btn-outline-secondary w-100">Continue as Guest</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
