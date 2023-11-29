// back to top
$(document).ready(function () {
    var btn = $("#back-top-btn");

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    $(window).on('scroll', function () {
        if ($(window).scrollTop() > 300) {
            btn.fadeIn(1000);
        } else {
            btn.fadeOut(1000);
        }
    });

    $('.product-card').each(function (i, element) {
        $(element).on("click", function (event) {
            event.stopPropagation();
            const productID = $(this).data("productId");
            window.location.href = '/detail/' + productID;
        });
    });

    $('.product-card__text-current-price, .detail__info-price, .detail__info-unit-price, .price').each(function (i, element) {
        const price = parseInt($(element).text());
        $(element).text(new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
            maximumSignificantDigits: 3,
        }).format(price));
    });
});


function checkKey(e) {
    enterKey = 13;
    if (e.which == enterKey)
        document.forms['frm-search'].submit();
}


function addCart(code) {

    var idItem = parseInt(code);
    var nameItem = products[idItem].name[lang];
    if (typeof localStorage[code] === 'undefined') {
        window.localStorage.setItem(code, 1);
    } else {
        var current = parseInt(window.localStorage.getItem(code));
        window.localStorage.setItem(code, current + 1);
    }
    alert(lang == 'vi-VN' ? "Đã cập nhật sản phẩm '" + nameItem + "' vào giỏ hàng. Số lượng sản phẩm '" + nameItem + "' đã đặt là " + parseInt(window.localStorage.getItem(code)) + "." : "Updated '" + nameItem + "' to the cart. The quantity of '" + nameItem + "' ordered is " + parseInt(window.localStorage.getItem(code)) + " item.");
}
function showCart() {
    var formatter = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
    var container = document.getElementById("cart-detail").getElementsByTagName('tbody')[0];
    container.innerHTML = '';
    var totalOrder = 0;
    for (let i = 0; i < window.localStorage.length; i++) {
        var keyLocalStorage = parseInt(window.localStorage.key(i));
        if (products[keyLocalStorage] === undefined) {
            continue;
        }
        var sum = 0;
        var tr = document.createElement("tr");
        var photoCell = document.createElement("td");
        var nameCell = document.createElement("td");
        var priceCell = document.createElement("td");
        var numberCell = document.createElement("td");
        var sumCell = document.createElement("td");
        var removeCell = document.createElement("td");
        var removeLink = document.createElement("a");
        var item = products[keyLocalStorage];
        var itemQuantity = window.localStorage.getItem(window.localStorage.key(i));

        photoCell.innerHTML = `<img src="${item.image}" style="width: 100px;">`;
        nameCell.innerHTML = `<span>${item.name[lang]}</span>`;
        priceCell.innerHTML = formatter.format(item.currentPrice);
        numberCell.innerHTML = itemQuantity;
        sum = itemQuantity * item.currentPrice;
        sumCell.innerHTML = formatter.format(sum);

        removeLink.innerHTML = `<i class="fa-solid fa-xmark remove-icon"></i>`;
        removeLink.setAttribute('href', "#");
        removeLink.setAttribute('data-code', localStorage.key(i));
        removeLink.onclick = function () {
            removeCart(this.dataset.code);
        };
        removeCell.style.textAlign = 'center';
        removeCell.appendChild(removeLink);
        tr.appendChild(photoCell);
        tr.appendChild(nameCell);
        tr.appendChild(priceCell);
        tr.appendChild(numberCell);
        tr.appendChild(sumCell);
        tr.appendChild(removeCell);
        container.appendChild(tr);
        totalOrder += sum;
    }
    document.getElementById('total-bill').innerHTML = formatter.format(totalOrder);
}

function removeCart(code) {
    if (typeof window.localStorage[code] !== undefined) {
        window.localStorage.removeItem(code);
        document.getElementById("cart-detail").getElementsByTagName('tbody')[0].innerHTML = '';
        showCart();
    }
}





