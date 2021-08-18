/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/assets/js/sales.js ***!
  \**************************************/
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$("body").on("click", ".btn-add-sales", function (e) {
  e.preventDefault();
  $('#modalAddSales').modal('show'); // document.getElementById("form-add-sales").reset();

  $.ajax({
    type: "get",
    url: "/sales/getProduct",
    dataType: "json",
    success: function success(response) {
      console.log(response);

      if (response.status == "200") {
        var optionCustomer = "<option value=''>[-- Choose --]</option>";

        if (response.data.product.length > 0) {
          var optionProduct = "<option value=''>[-- Choose --]</option>";

          for (var i = 0; i < response.data.product.length; i++) {
            optionProduct += '<option value="' + response.data.product[i].id + '-' + response.data.product[i].price + '-' + response.data.product[i].stock + '-' + response.data.product[i].product + '">' + response.data.product[i].product + '</option>';
          }

          $('.product-sales').prop('disabled', false);
        } else {
          var optionProduct = "<option value=''>[-- No Product found --]</option>";
          $('.product-sales').prop('disabled', true);
        }

        if (response.data.customer.length > 0) {
          for (var i = 0; i < response.data.customer.length; i++) {
            optionCustomer += '<option value="' + response.data.customer[i].id + '">' + response.data.customer[i].username + '</option>';
          }
        }

        $('.product-sales').html(optionProduct);
        $('.name-sales').html(optionCustomer);
      }
    }
  });
});
$("body").on("click", ".btn-add-row-sales", function (e) {
  e.preventDefault();
  var param = $('.row-new-sales').length;
  $.ajax({
    type: "post",
    url: "/sales/add-row",
    data: {
      param: param
    },
    dataType: "json",
    success: function success(response) {
      console.log(response);
      $('.target-row-sales').append(response.data);
      var check = $('.row-new-sales').length;
      $('.row-new-sales').attr('id', 'row-new-sales-' + check);
      $('.btn-delete-row').attr('data-id', check);
    }
  });
});
$("body").on("click", ".btn-delete-row", function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  $('#row-new-sales-' + id).remove();
});
$("#form-add-sales").submit(function (e) {
  e.preventDefault();
  var data = $(this).serialize();
  $.ajax({
    type: "post",
    url: "/sales/post",
    data: data,
    dataType: "json",
    success: function success(response) {
      console.log(response);

      if (response.status == "200") {
        swal({
          title: "Success",
          text: response.message,
          icon: "success",
          button: "Ok"
        });
        $('#modalAddSales').modal('hide');
        document.getElementById('form-add-sales');
        getSales();
      }
    }
  });
});
$(document).ready(function () {
  var modalSaled = document.getElementById('modalAddSales');
  modalSaled.addEventListener('hidden.bs.modal', function (event) {
    // document.getElementById('form-add-sales').reset();
    $('input').removeClass('is-invalid');
    $('.target-row-sales').html('');
  });
  getSales(0);
});

function getSales() {
  var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
  $.ajax({
    type: "POST",
    url: "sales/get",
    data: {
      page: page
    },
    dataType: "json",
    success: function success(response) {
      console.log(response);
      $('.pagination-sales').html(response.pagination);
      $('.target-table-sales').html(response.table);
    }
  });
}
/******/ })()
;