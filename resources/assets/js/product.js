$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("body").on("click", ".btn-add-product", function(e) {
    e.preventDefault();

    $('#modalAddProduct').modal('show');
    $('#form-add-product').attr('action', '/product/post');
});

$("#form-add-product").submit(function(e) {
    e.preventDefault();
    
    var data = $(this).serialize();
    var url = $(this).attr('action');

    $.ajax({
        type: "post",
        url: url,
        data: data,
        dataType: "json",
        success: function(response) {
            $('input').removeClass('is-invalid');
            if (response.status == "200") {
                swal({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    button: "Ok",
                });

                $('#modalAddProduct').modal('hide');
                document.getElementById("form-add-product").reset();
                var currPage = $('.current-page-input').val();
                getProduct(currPage);
            } else {
                if (response.data.error.hasOwnProperty('product')) {
                    $('.error-name-product').text(response.data.error.product.join(', '));
                    $('.name-product').addClass('is-invalid');
                }
                if (response.data.error.hasOwnProperty('price')) {
                    $('.error-price-product').text(response.data.error.price.join(', '));
                    $('.price-product').addClass('is-invalid');
                }
            }
        }
    });
});

$("body").on("click", ".switchStatusProduct", function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var name = $(this).data('name');
    var active = $(this).attr('checked');

    var status, message, title;
    if (active == undefined) {
        status = 1;
        message = "Make sure stock is more than 10 grams";
        title = "Are you sure to activate " + name + "?";
    } else {
        status = 2;
        message = "Make sure this item doesnt have relation to sales";
        title = "Are you sure to inactivated " + name + "?";
    }

    swal({
        title: title,
        text: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "/product/change",
                    data: {
                        id: id,
                        status: status
                    },
                    dataType: "json",
                    success: function(response) {
                        var currPage = $('.current-page-input').val();
                        getProduct(currPage);
                        if (response.status == '200') {
                            swal({
                                title: "Success",
                                text: response.message,
                                icon: "success",
                                button: "Ok",
                            });
                            
                        } else {
                            swal({
                                title: "Error",
                                text: response.message,
                                icon: "warning",
                                button: "Ok",
                            });
                        }
                    }
                })
            }
        });
});

$("body").on("click", ".btn-edit-product", function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var name = $(this).data('name');

    $.ajax({
        type: "POST",
        url: "/product/edit",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {
            $('.name-product').val(response.data.product);
            $('.price-product').val(response.data.price);
            $('.stock-product').val(response.data.stock);
            if (response.data.status == "no") {
                $('.price-product').attr('disabled', true);
                $('.stock-product').attr('disabled', true);
            } else {
                $('.price-product').attr('disabled', false);
                $('.stock-product').attr('disabled', false);
            }

            $('#modalAddProduct').modal('show');
            $('#form-add-product').attr('action', '/product/postEditProduct');
            $('.id-product').val(id);
            $('.helper-product').val(name);
        }
    });
});

$("body").on("click", ".btn-delete-product", function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var name = $(this).data('name');

    swal({
        title: "Are you sure to delete " + name + "?",
        text: "Delete will temporary remove user for 1 weeks. you can activate again later",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "/product/delete",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function (response) {
                        var currPage = $('.current-page-input').val();
                        getProduct(currPage);
                        if (response.status == '200') {
                            swal({
                                title: "Success",
                                text: response.message,
                                icon: "success",
                                button: "Ok",
                            });

                        } else {
                            swal({
                                title: "Error",
                                text: response.message,
                                icon: "warning",
                                button: "Ok",
                            });
                        }
                    }
                })
            }
        });
})

$(document).ready(function() {
    var modalProduct = document.getElementById('modalAddProduct')
    modalProduct.addEventListener('hidden.bs.modal', function (event) {
        document.getElementById('form-add-product').reset();
        $('input').removeClass('is-invalid');

        $('.price-product').attr('disabled', false);
        $('.stock-product').attr('disabled', false);
    })

    getProduct(0);
})

function getProduct(page) {
    if (page == 1) {
        page = 0;
    }

    $.ajax({
        type: "POST",
        url: "/product/get",
        data: {
            page: page
        },
        dataType: "json",
        success: function(response) {
            $('.target-table-product').html(response.table);
            
            if (response.pagination.length > 0) {
                $('.pagination-product').html(response.pagination);
            }
            $('.current-page-input').val(page);
        }
    })
}