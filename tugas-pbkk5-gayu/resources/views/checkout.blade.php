<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0f0f0f;
            color: #fff;
        }
        .checkout-container {
            margin-top: 50px;
        }
        .order-summary {
            background-color: #111;
            border-radius: 10px;
            padding: 20px;
        }
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
        .product-details {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .product-info {
            margin-left: 15px;
            flex-grow: 1;
        }
        .product-name {
            font-weight: bold;
            margin-bottom: 0;
        }
        .product-size, .product-price, .product-quantity {
            font-size: 0.9em;
            margin-bottom: 0;
        }
        .total-price {
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container checkout-container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <!-- Form Shipping (Left Column) -->
            <div class="col-md-7">
                <div class="card p-4" style="background-color: #111;">
                    <h4>Delivery</h4>
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="country" class="form-label">Country/Region</label>
                            <select id="country" class="form-select" name="country">
                                <option value="Indonesia">Indonesia</option>
                                <!-- Tambahkan opsi negara lainnya jika diperlukan -->
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="first-name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first-name" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="last-name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last-name" name="last_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="province" class="form-label">Province</label>
                                    <input type="text" class="form-control" id="province" name="province" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="postal-code" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postal-code" name="postal_code" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Complete Order</button>
                    </form>
                </div>
            </div>

            <!-- Order Summary (Right Column) -->
            <div class="col-md-5">
                <h2 class="mb-4">Order Summary</h2>
    
                @if($cart && $cart->items->count() > 0)
                    @foreach($cart->items as $item)
                        <div class="product-details">
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="product-img">
                            <div class="product-info">
                                <p class="product-name">{{ $item->product->name }}</p>
                                <p class="product-size">Size: {{ $item->size }}</p>
                                <p class="product-price">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                                <p class="product-quantity">Quantity: {{ $item->quantity }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Your cart is empty.</p>
                @endif
    
                <!-- Total harga -->
                <div class="border-top pt-4 mt-4">
                    <p><strong>Subtotal:</strong> <span class="float-end">Rp{{ number_format($total, 0, ',', '.') }}</span></p>
                    <p><strong>Shipping:</strong> <span class="float-end">Enter shipping address</span></p>
                    <p class="total-price"><strong>Total:</strong> <span class="float-end">Rp{{ number_format($total, 0, ',', '.') }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>