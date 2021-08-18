/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************!*\
  !*** ./resources/assets/js/pagination.js ***!
  \*******************************************/
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$("body").on("click", "a.page-link.link-pagination-custom", function (e) {
  e.preventDefault();
  var page = $(this).data('page');
  var table = $(this).data('table');
  var target = $(this).data('target');
  var condition = $(this).data('condition');
  var select = $(this).data("select");
  var component = $(this).data("component");
  var view = $(this).data("view");
  var join = $(this).data('join');

  if (page == 1) {
    page = 0;
  }

  $.ajax({
    type: "POST",
    url: "/master/pagination",
    data: {
      page: page,
      table: table,
      condition: condition,
      select: select,
      target: target,
      component: component,
      paginationView: view,
      join: join
    },
    dataType: "json",
    success: function success(response) {
      $('.' + target).html(response.data);
      $('.' + view).html(response.pagination);
      $(".current-page-input").val(response.currPage);
    }
  });
});
/******/ })()
;