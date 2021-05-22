const base_url = 'https://app.shopify.dev/'
//Check Wishlist
const customer_id = getCustomerID();

function checkWishlist(customer_id, product_id) {
    $.ajax({
            url: base_url + 'api/wishlist/check',
            beforeSend: function (xhr) {

            },
            data: {
                customer_id: customer_id,
                product_id: product_id
            }
        })
        .done(function (data) {
            alert('DONE')
        });

}

//Add to  Wishlist
function addToWishlist(customer_id, product_id , obj) {
    $_this = $(obj);
    $.ajax({
            url: base_url + 'api/wishlist/add',
            beforeSend: function (xhr) {

            },
            method: "POST",
            data: {
                customer_id: customer_id,
                product_id: product_id
            }
        })
        .done(function (data) {
            $_this.addClass('btn-wishlist-active')
        });

}
//Get Customer id
function getCustomerID() {
    var customer_id = '';
    if (checkCookie('customer_id')) {
        customer_id = getCookie('customer_id');
    } else {
        createCustomerID();
        customer_id = getCookie('customer_id');
    }
    return customer_id;
}
//Generate Customer ID
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie(cname) {
    var c = getCookie(cname);
    var res = false;
    if (c != "") {
        res = true;
    }
    return res;
}

function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = Math.random() * 16 | 0,
            v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

function createCustomerID() {
    var unique_id = uuidv4();
    setCookie('customer_id', unique_id, 24);
}
if (!checkCookie('customer_id')) {
    createCustomerID();
}



// Event Listner
$(document).on('click', '.btn-wishlist', function () {
    var product_id = $(this).data('product-id');
    addToWishlist(customer_id, product_id, this)
});
$(function () {
    var pids = [];
    $('.btn-wishlist').each(function () {
        pids.push($(this).data('product-id'));
    });
    $.ajax({
            url: base_url + 'api/wishlist/bulk-check',
            beforeSend: function (xhr) {

            },
            method: 'POST',
            data: {
                customer_id: customer_id,
                product_ids: pids
            }
        })
        .done(function (res) {
            var data = JSON.parse(res);
            var active = data['active'];
            console.log(active)
            $('.btn-wishlist').each(function () {
                var product_id = $(this).data('product-id');
                console.log(typeof product_id)
                if (active.includes(product_id.toString())) {
                    $(this).addClass('btn-wishlist-active')
                }
            });

        });
});
