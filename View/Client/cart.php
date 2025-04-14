<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Danh sách sản phẩm</h2>
        <div class="row" id="product-list">
            <!-- Sản phẩm sẽ được đổ vào đây bằng JavaScript -->
        </div>

        <h2 class="mt-5">Giỏ hàng</h2>
        <table class="table table-bordered mt-3" id="cart-table">
            <thead>
                <tr>
                    <th>Tên SP</th>
                    <th>Size</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Mục giỏ hàng sẽ được đổ vào đây -->
            </tbody>
        </table>
        <h4 class="text-end">Tổng tiền: <span id="total-price">0</span> VND</h4>
    </div>

    <script>
        // Danh sách sản phẩm mẫu
        const products = [
            { id: 1, name: "Áo Thun", size: "M", price: 200000 },
            { id: 2, name: "Quần Jean", size: "L", price: 350000 },
            { id: 3, name: "Giày Sneaker", size: "42", price: 500000 }
        ];
        let cart = [];

        function renderProducts() {
            let productList = document.getElementById("product-list");
            productList.innerHTML = "";
            products.forEach(product => {
                productList.innerHTML += `
                    <div class="col-md-4">
                        <div class="card p-3 mb-3">
                            <h5>${product.name}</h5>
                            <p>Size: ${product.size} - Giá: ${product.price.toLocaleString()} VND</p>
                            <button class="btn btn-primary" onclick="addToCart(${product.id})">Thêm vào giỏ</button>
                        </div>
                    </div>
                `;
            });
        }

        function addToCart(productId) {
            let product = products.find(p => p.id === productId);
            let item = cart.find(i => i.id === productId);
            if (item) {
                item.quantity++;
            } else {
                cart.push({ ...product, quantity: 1 });
            }
            renderCart();
        }

        function updateQuantity(productId, change) {
            let item = cart.find(i => i.id === productId);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    cart = cart.filter(i => i.id !== productId);
                }
            }
            renderCart();
        }

        function renderCart() {
            let cartTable = document.querySelector("#cart-table tbody");
            cartTable.innerHTML = "";
            let total = 0;
            cart.forEach(item => {
                let subtotal = item.quantity * item.price;
                total += subtotal;
                cartTable.innerHTML += `
                    <tr>
                        <td>${item.name}</td>
                        <td>${item.size}</td>
                        <td>${item.price.toLocaleString()} VND</td>
                        <td>
                            <button class="btn btn-sm btn-secondary" onclick="updateQuantity(${item.id}, -1)">-</button>
                            ${item.quantity}
                            <button class="btn btn-sm btn-secondary" onclick="updateQuantity(${item.id}, 1)">+</button>
                        </td>
                        <td>${subtotal.toLocaleString()} VND</td>
                        <td><button class="btn btn-danger btn-sm" onclick="updateQuantity(${item.id}, -999)">Xóa</button></td>
                    </tr>
                `;
            });
            document.getElementById("total-price").innerText = total.toLocaleString();
        }

        renderProducts();
    </script>
</body>
</html> 