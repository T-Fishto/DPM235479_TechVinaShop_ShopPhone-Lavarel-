/**
 * Main JS for Heritage Watch
 */

document.addEventListener('DOMContentLoaded', function() {
    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // Quantity selector functions
    window.increaseQty = function() {
        const input = document.getElementById('buyQuantity');
        if (input) {
            const max = parseInt(input.getAttribute('max')) || 999;
            const val = parseInt(input.value);
            if (val < max) {
                input.value = val + 1;
            }
        }
    }

    window.decreaseQty = function() {
        const input = document.getElementById('buyQuantity');
        if (input && parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }

    // Toggle Password Visibility
    window.togglePassword = function(id) {
        const input = document.getElementById(id);
        const icon = document.querySelector(`[onclick="togglePassword('${id}')"] i`);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Real-time Search Suggestions
    const searchInput = document.getElementById('searchInput');
    const suggestionsBox = document.getElementById('searchSuggestions');
    let debounceTimer;

    if (searchInput && suggestionsBox) {
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();

            if (query.length < 2) {
                suggestionsBox.classList.add('d-none');
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`/api/tim-kiem/goi-y?tu-khoa=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            let html = '';
                            data.forEach(item => {
                                html += `
                                    <a href="${item.url}" class="suggestion-item">
                                        <img src="${item.hinhanh}" class="suggestion-img" onerror="this.src='https://placehold.co/100x100/1a1a1a/d4af37?text=Watch'">
                                        <div class="suggestion-info">
                                            <span class="suggestion-name">${item.tensanpham}</span>
                                            <span class="suggestion-price">${item.dongia}</span>
                                        </div>
                                    </a>
                                `;
                            });
                            suggestionsBox.innerHTML = html;
                            suggestionsBox.classList.remove('d-none');
                        } else {
                            suggestionsBox.classList.add('d-none');
                        }
                    })
                    .catch(error => console.error('Error fetching suggestions:', error));
            }, 300);
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                suggestionsBox.classList.add('d-none');
            }
        });
    }
});
