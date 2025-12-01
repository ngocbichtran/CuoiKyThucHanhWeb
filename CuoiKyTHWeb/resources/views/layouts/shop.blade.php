<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAPYSHOP</title>
</head>

<body>

<h1 style="text-align:center;">CAPYSHOP</h1>

<main class="product-grid">

<?php foreach ($products as $product): ?>
    <div class="product-card"
        data-id="<?= $product->ID ?>"
        data-name="<?= htmlspecialchars($product->NAME) ?>"
        data-price="<?= $product->PRICE ?>"
    >

        <img src="<?= $product->IMG_URL ?>" width="250">

        <h3><?= htmlspecialchars($product->NAME) ?></h3>

        <p>Giá: <?= number_format($product->PRICE, 0, ',', '.') ?> VNĐ</p>

        <button onclick="openOrderModal(<?= $product->ID ?>)">ĐẶT HÀNG</button>
    </div>
<?php endforeach; ?>

<?= $products->links() ?>

</main>

<!-- MODAL -->
<div id="orderModal" class="modal" style="display:none;">
    <div class="modal-content">

        <h2>Thông tin đặt hàng</h2>

        <h3 id="modalProductName"></h3>
        <p id="modalProductPrice"></p>

        <form id="orderForm" action="<?= route('shop.order') ?>" method="POST">
            <?= csrf_field() ?>

            <input type="hidden" name="product_id" id="productId">
            <input type="hidden" name="don_gia" id="productPrice">

            <label>Số lượng:</label>
            <input type="number" name="so_luong" value="1" min="1">

            <button type="submit">Xác nhận đặt hàng</button>
        </form>

        <button onclick="closeOrderModal()">Đóng</button>
    </div>
</div>

<script>
function openOrderModal(id) {
    let card = document.querySelector(`.product-card[data-id="${id}"]`);

    let name = card.getAttribute("data-name");
    let price = card.getAttribute("data-price");

    document.getElementById('modalProductName').textContent = name;
    document.getElementById('modalProductPrice').textContent =
        "Giá: " + Number(price).toLocaleString('vi-VN') + " VNĐ";

    document.getElementById('productId').value = id;
    document.getElementById('productPrice').value = price;

    document.getElementById('orderModal').style.display = "block";
}

function closeOrderModal() {
    document.getElementById('orderModal').style.display = "none";
}
</script>

</body>
</html>
