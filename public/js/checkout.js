function validateCheckOut(frm) {
    var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var telReg = /^0\d+$/;
    if (frm.fnameInput.value.length == 0) {
        alert(lang == 'vi-VN' ? "Vui lòng nhập tên !!!" : "Please enter first name !!!");
        frm.fnameInput.focus();
        return false;
    }

    if (frm.lnameInput.value.length == 0) {
        alert(lang == 'vi-VN' ? "Vui lòng nhập họ !!!" : "Please enter last name !!!");
        frm.lnameInput.focus();
        return false;
    }

    if (frm.addressInput.value.length == 0) {
        alert(lang == 'vi-VN' ? "Vui lòng nhập địa chỉ !!!" : "Please enter address !!!");
        frm.addressInput.focus();
        return false;
    }

    if (frm.addressInput.value.length == 0) {
        alert(lang == 'vi-VN' ? "Vui lòng nhập địa chỉ !!!" : "Please enter address !!!");
        frm.addressInput.focus();
        return false;
    }
    if (emailReg.test(frm.emailInput.value) == false) {
        alert(lang == 'vi-VN' ? "Vui lòng nhập email chính xác !!!" : "Please enter correct email !!!");
        frm.emailInput.focus();
        return false;
    }

    if (telReg.test(frm.telInput.value) == false || frm.telInput.value.length != 10) {
        alert(lang == 'vi-VN' ? "Vui lòng nhập số điện thoại đúng 10 chữ số và bắt đầu bằng số 0!!!" : "Please enter 10 digits for telephone number and start with 0 digit!!!");
        frm.telInput.focus();
        return false;
    }
    if (frm.cityInput.value == 'NONE') {
        alert(lang == 'vi-VN' ? "Vui lòng chọn Tỉnh/TP !!!" : "Please choose the city !!!");
        frm.cityInput.focus();
        return false;
    }
    alert(lang == 'vi-VN' ? "Xin chân thành cảm ơn quý khách đã mua hàng tại Mango Shop." : "Thank you very much for your purchase at Mango Shop.");
    return true;
};

function showBill() {
    var billContainer = document.getElementsByClassName('name-product-checkout')[0];
    var shippingFee = 30000;

    var sum = 0;
    var totalOrder = 0;
    var keyLocalStorage;
    for (let i = 0; i < window.localStorage.length; i++) {
        keyLocalStorage = parseInt(window.localStorage.key(i));
        if (products[keyLocalStorage] === undefined) {
            continue;
        }

        var itemContainer = document.createElement('div');
        itemContainer.classList.add('d-flex', 'justify-content-between', 'mt-4');
        var itemName = document.createElement('b');
        var itemCost = document.createElement('b');
        itemQuantity = window.localStorage.getItem(window.localStorage.key(i));
        sum = itemQuantity * products[keyLocalStorage].currentPrice;
        totalOrder += sum;
        console.log(products[keyLocalStorage].name[lang]);
        itemName.innerHTML = products[keyLocalStorage].name[lang] + ' x ' + itemQuantity;
        itemCost.innerHTML = formatter.format(sum);
        itemContainer.appendChild(itemName);
        itemContainer.appendChild(itemCost);
        billContainer.appendChild(itemContainer);
    }

    document.getElementById('subtotal-fee').innerHTML = formatter.format(totalOrder);
    document.getElementById('shipping-fee').innerHTML = formatter.format(shippingFee);
    document.getElementById('total-fee').innerHTML = formatter.format(shippingFee + totalOrder);
}