document.addEventListener('DOMContentLoaded', function() {
    let cart = [];
    const cartItemsList = document.getElementById('cartItemsList');
    const cartTotal = document.getElementById('cartTotalPrice');
    const cartBadge = document.getElementById('cartCountBadge');
    
    // Khởi tạo Toast nếu phần tử tồn tại
    const toastEl = document.getElementById('cartToast');
    const toast = toastEl ? new bootstrap.Toast(toastEl, { delay: 2000 }) : null;

    // Hàm định dạng giá tiền
    function formatMoney(num) {
        return new Intl.NumberFormat('vi-VN').format(num) + 'đ';
    }

    function updateCartUI() {
        // Luôn cập nhật localStorage 
        localStorage.setItem('cart', JSON.stringify(cart));
        
        if (!cartItemsList) return;

        if (cart.length === 0) {
            cartItemsList.innerHTML = `
                <div class="text-center mt-5">
                    <i class="fa-solid fa-hourglass-start text-muted mb-3" style="font-size: 3rem;"></i>
                    <p class="text-muted">Giỏ hàng của bạn đang trống</p>
                </div>`;
            if (cartTotal) cartTotal.textContent = '0đ';
            if (cartBadge) cartBadge.textContent = '0';
            
            updateCheckoutButtonState();
            return;
        }

        let html = '';
        let total = 0;
        let count = 0;

        cart.forEach((item, index) => {
            // Mặc định là được chọn nếu chưa có thuộc tính selected
            if (item.selected === undefined) item.selected = true;
            
            if (item.selected) {
                total += item.price * item.quantity;
            }
            count += item.quantity;

            html += `
                <div class="d-flex align-items-center mb-3 p-1 border-bottom border-secondary border-opacity-25 animate__animated animate__fadeInRight ${!item.selected ? 'opacity-50' : ''}">
                    <div class="form-check me-2">
                        <input class="form-check-input" type="checkbox" ${item.selected ? 'checked' : ''} onchange="toggleSelectItem(${index})">
                    </div>
                    <img src="${item.img}" width="60" class="img-thumbnail bg-dark border-secondary me-3">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <h6 style="font-size: 0.8rem;" class="mb-1">${item.name}</h6>
                            <button class="btn btn-link text-danger p-0 border-0" onclick="removeFromCart(${index})"><i class="fa-solid fa-trash-can" style="font-size: 0.7rem;"></i></button>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-gold small" style="font-size: 0.75rem;">${formatMoney(item.price)}</span>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-secondary border-0 text-white p-0 px-2" onclick="changeQty(${index}, -1)">-</button>
                                <span class="btn btn-outline-secondary border-0 text-white disabled p-0 px-2" style="font-size: 0.75rem;">${item.quantity}</span>
                                <button class="btn btn-outline-secondary border-0 text-white p-0 px-2" onclick="changeQty(${index}, 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        cartItemsList.innerHTML = html;
        if (cartTotal) cartTotal.textContent = formatMoney(total);
        if (cartBadge) cartBadge.textContent = count;

        // Lưu vào localStorage để trang thanh toán (checkout) có thể lấy dữ liệu
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Cập nhật trạng thái nút thanh toán
        updateCheckoutButtonState();
    }

    // Load giỏ hàng từ localStorage khi khởi tạo
    try {
        const savedCart = localStorage.getItem('cart');
        if (savedCart) {
            cart = JSON.parse(savedCart);
            updateCartUI();
        }
    } catch(e) {}

    // Sự kiện nút Thêm vào giỏ
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price);
            const stock = parseInt(this.dataset.stock) || 0;
            const img = this.dataset.img || 'https://via.placeholder.com/300x400?text=No+Image';

            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                if (existingItem.quantity < stock) {
                    existingItem.quantity++;
                    if (toast) toast.show();
                } else {
                    alert(`Sản phẩm ${name} chỉ còn ${stock} cái trong kho.`);
                }
            } else {
                cart.push({ id, name, price, img, quantity: 1, stock: stock, selected: true });
                if (toast) toast.show();
            }

            updateCartUI();
        });
    });

    // Hàm chọn/bỏ chọn sản phẩm
    window.toggleSelectItem = function(index) {
        cart[index].selected = !cart[index].selected;
        updateCartUI();
    };

    // Hàm đổi số lượng (Global để inline click gọi được) trong giỏ hàng
    window.changeQty = function(index, delta) {
        const item = cart[index];
        if (delta === -1 && item.quantity <= 1) return;
        
        if (delta === 1 && item.quantity >= item.stock) {
            alert(`Sản phẩm này chỉ còn ${item.stock} cái trong kho.`);
            return;
        }

        item.quantity += delta;
        updateCartUI();
    };

    window.removeFromCart = function(index) {
        if(confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
            cart.splice(index, 1);
            updateCartUI();
        }
    };

    window.clearCart = function() {
        cart = [];
        updateCartUI();
    };

    // Hàm đổi số lượng trang chi tiết sản phẩm
    window.increaseQty = function() {
        let input = document.getElementById('buyQuantity');
        if (!input) return;
        let max = parseInt(input.getAttribute('max')) || 0;
        let val = parseInt(input.value);
        if (val < max) {
            input.value = val + 1;
        }
    };

    window.decreaseQty = function() {
        let input = document.getElementById('buyQuantity');
        if (!input) return;
        let val = parseInt(input.value);
        if (val > 1) {
            input.value = val - 1;
        }
    };

    // Sự kiện nút Thêm vào giỏ từ trang chi tiết
    const btnAddDetail = document.querySelector('.add-to-cart-detail');
    if (btnAddDetail) {
        btnAddDetail.addEventListener('click', function(e) {
            e.preventDefault();
            
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = parseFloat(this.getAttribute('data-price'));
            const stock = parseInt(this.getAttribute('data-stock')) || 0;
            const img = this.getAttribute('data-img') || 'https://via.placeholder.com/300x400?text=No+Image';
            
            const inputEl = document.getElementById('buyQuantity'); // ô nhập liệu cho số lượng mua bên chi tiết
            const qty = inputEl ? parseInt(inputEl.value) : 1;

            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                const totalQty = existingItem.quantity + qty;
                if (totalQty <= stock) {
                    existingItem.quantity = totalQty;
                    if (toast) toast.show();
                } else {
                    alert(`Sản phẩm ${name} chỉ còn ${stock} cái. Bạn đã có ${existingItem.quantity} cái trong giỏ.`);
                    existingItem.quantity = stock; // Tự động cập nhật lên tối đa
                }
            } else {
                if (qty <= stock) {
                    cart.push({ id, name, price, img, quantity: qty, stock: stock, selected: true });
                    if (toast) toast.show();
                } else {
                    alert(`Sản phẩm ${name} chỉ còn ${stock} cái.`);
                    cart.push({ id, name, price, img, quantity: stock, stock: stock, selected: true });
                }
            }

            updateCartUI();
        });
    }

    // Scroll Effect cho Navbar cái cuộn trang màu vàng
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (nav) {
            if (window.scrollY > 50) nav.classList.add('scrolled');
            else nav.classList.remove('scrolled');
        }
    });

    // Hàm cập nhật trạng thái nút thanh toán
    function updateCheckoutButtonState() {
        const agreeTerms = document.getElementById('agreeTerms');
        const checkoutBtn = document.getElementById('checkoutBtn');
        if (!checkoutBtn) return;

        // Kiểm tra xem có sản phẩm nào được chọn không
        const hasSelected = cart.some(item => item.selected !== false);
        const isAgreed = agreeTerms ? agreeTerms.checked : false;

        if (hasSelected && isAgreed) {
            checkoutBtn.classList.remove('disabled');
        } else {
            checkoutBtn.classList.add('disabled');
        }
    }

    // Checkbox điều khoản
    const agreeTerms = document.getElementById('agreeTerms');
    if (agreeTerms) {
        agreeTerms.addEventListener('change', updateCheckoutButtonState);
    }
});
