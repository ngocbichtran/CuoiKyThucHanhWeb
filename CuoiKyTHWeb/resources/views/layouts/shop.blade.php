<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAPYSHOP</title>

    <style>
    /* 1. Định dạng chung cho tiêu đề */
    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    /* 2. Định dạng Grid Container */
    .product-grid {
        display: grid; /* Sử dụng CSS Grid */
        /* Chia thành 3 cột có chiều rộng bằng nhau. */
        grid-template-columns: repeat(3, 1fr); 
        gap: 20px; /* Tạo khoảng cách 20px giữa các cột và hàng */
        max-width: 1200px; /* Giới hạn chiều rộng tối đa */
        margin: 0 auto; /* Căn giữa */
        padding: 0 20px;
    }

    /* 3. Định dạng từng sản phẩm */
    .product-card {
        border: 1px solid #ccc;
        padding: 15px;
        text-align: center;
    }

    .product-card img {
        width: 50%; /* Đảm bảo hình ảnh chiếm toàn bộ chiều rộng thẻ */
        height: 50%;
        display: block;
        margin:auto;
    }

    .product-card h3 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    .product-card p {
        margin-bottom: 15px;
        font-weight: bold;
        color: #e53935;
    }

    .product-card button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 8px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        border-radius: 4px;
    }
    
</style>
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
<div id="orderModal" 
    class="modal" 
    style="
        /* LỚP PHỦ NỀN VÀ CĂN GIỮA TUYỆT ĐỐI */
        display: none; 
        position: fixed; 
        z-index: 1000; 
        left: 0; 
        top: 0; 
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgba(0,0,0,0.4); 
        
        /* Kích hoạt Flexbox để căn giữa nội dung */
        align-items: center; 
        justify-content: center;
    "
>
    <div class="modal-content" 
        style="
            /* KHUNG NỘI DUNG */
            background-color: #fefefe; 
            padding: 20px; 
            border: 1px solid #888; 
            max-width: 400px; /* Chiều rộng tối đa */
            width: 90%; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        "
    >

        <h2>Thông tin đặt hàng</h2>

        <h3 id="modalProductName"></h3>
        <p id="modalProductPrice"></p>

        <form id="orderForm" action="<?= route('shop.order') ?>" method="POST"
            style="
                /* CĂN CHỈNH NÚT VÀ Ô NHẬP */
                margin-top: 15px;
                margin-bottom: 15px;
                display: flex; 
                align-items: center; 
                gap: 10px; 
            "
        >
            <?= csrf_field() ?>

            <input type="hidden" name="product_id" id="productId">
            <input type="hidden" name="don_gia" id="productPrice">

            <label style="white-space: nowrap;">Số lượng:</label>
            <input type="number" name="so_luong" value="1" min="1" style="width: 80px;">

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

    document.getElementById('orderModal').style.display = "flex";
}

function closeOrderModal() {
    document.getElementById('orderModal').style.display = "none";
}
</script>

</body>
</html>
