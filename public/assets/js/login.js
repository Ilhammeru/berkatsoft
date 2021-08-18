/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/assets/js/login.js ***!
  \**************************************/
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$('body').on('click', '.span-register', function (e) {
  e.preventDefault();
  $('.login').addClass('d-none');
  $('.register').removeClass('d-none');
});
$('body').on('click', '.span-login', function (e) {
  e.preventDefault();
  $('.register').addClass('d-none');
  $('.login').removeClass('d-none');
});
$("#form-register").submit(function (e) {
  e.preventDefault();
  var data = $(this).serialize();
  $('input').removeClass('is-invalid');
  $.ajax({
    type: "POST",
    url: "/auth/register",
    data: data,
    dataType: "json",
    success: function success(response) {
      if (response.status != "200") {
        if (response.data.error.hasOwnProperty('username')) {
          $('.error-username-register').text(response.data.error.username.join(", "));
          $('.username-register').addClass('is-invalid');
        }

        if (response.data.error.hasOwnProperty('password')) {
          $('.error-password-register').text(response.data.error.password.join(", "));
          $('.password-register').addClass('is-invalid');
        }

        if (response.data.error.hasOwnProperty('email')) {
          $('.error-email-register').text(response.data.error.email.join(", "));
          $('.email-register').addClass('is-invalid');
        }
      } else {
        swal({
          title: "Success",
          text: response.data.message,
          icon: "success"
        });
        $('.login').removeClass('d-none');
        $('.register').addClass('d-none');
        document.getElementById('form-register').reset();
      }
    }
  });
});
$("#form-login").submit(function (e) {
  e.preventDefault();
  var data = $(this).serialize();
  $('input').removeClass('is-invalid');
  $.ajax({
    type: "POST",
    url: "/auth/login",
    data: data,
    dataType: "json",
    success: function success(response) {
      if (response.status != "200") {
        if (response.data.error.hasOwnProperty('username')) {
          $('.error-username-login').text(response.data.error.username.join(", "));
          $('.username-login').addClass('is-invalid');
        }

        if (response.data.error.hasOwnProperty('password')) {
          $('.error-password-login').text(response.data.error.password.join(", "));
          $('.password-login').addClass('is-invalid');
        }
      } else {
        swal({
          title: "Success",
          text: response.data.message,
          icon: "success"
        });
        var url = response.data.url;
        window.location = url;
        document.getElementById('form-login').reset();
      }
    }
  });
});
/******/ })()
;