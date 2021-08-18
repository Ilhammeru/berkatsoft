const url = "http://127.0.0.1:8000/assets/js/";
const product = url + "product.js";
const sales = url + 'sales.js';
const customer = url + 'customer.js';

$("body").on("click", "a.nav-link.navs", function(e) {
    e.preventDefault();

    var page = $(this).data('target');

    $('.js-product').attr('src', '');
    $('.js-sales').attr('src', '');
    $('.js-customer').attr('src', '');

    if (page == "product") {
        $('.js-product').attr('src', product);
    } else if (page == 'sales') {
        $('.js-sales').attr('src', "");
        $('.js-sales').attr('src', sales);
    } else if (page == 'customer') {
        $('.js-customer').attr('src', customer);
    }

    $('.page-master').addClass('d-none');
    $('.navs').removeClass('active');

    $('.page-' + page).removeClass('d-none');
    $(this).addClass('active');
})