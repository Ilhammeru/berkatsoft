$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var currPage = $('.page-item.active').data('page');

if (currPage != undefined) {
    if (currPage == 0) {
        currPage = 1;
    }
} else {
    currPage = 0;
}

$("body").on("click", ".tr-user", function(e) {
    e.preventDefault();
    var id = $(this).data('id');
});

$("body").on("click", ".btn-add-user", function(e) {
    e.preventDefault();

    // custom url
    $('#form-add-user').attr('action', "/customer/post");
    $('#modalAddUser').modal('show');
});

$("body").on("click", ".generate-password-user", function(e) {
    e.preventDefault();

    var password = generatePassword(10);
    $('.password-user').val(password);
});

$("#form-add-user").submit(function(e) {
    e.preventDefault();

    var data = $(this).serialize();
    var url = $(this).attr('action');
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        success: function(response) {
            console.log(response);
            if (response.status == "200") {
                swal({
                    title: "Success",
                    text: response.data.message,
                    icon: "success",
                    button: "Ok"
                });

                getCustomer(currPage);
                $('#modalAddUser').modal('hide');
            } else {
                if (response.data.error.hasOwnProperty('username')) {
                    $('.error-username-user').text(response.data.error.username.join(", "));
                    $('.username-user').addClass('is-invalid');
                }
                if (response.data.error.hasOwnProperty('password')) {
                    $('.error-password-user').text(response.data.error.password.join(", "));
                    $('.password-user').addClass('is-invalid');
                }
                if (response.data.error.hasOwnProperty('email')) {
                    $('.error-email-user').text(response.data.error.email.join(", "));
                    $('.email-user').addClass('is-invalid');
                }
            }
        }
    })
});

$("body").on("click", ".switchStatusUser", function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var name = $(this).data('name');
    var active = $(this).attr('checked');
    var status, title, message;

    if (active == undefined) {
        status = "1";
        title = "Are you sure to activate " + name + "?";
        message = "User will free to surf this website";
    } else {
        status = "2";
        title = "Are you sure to nonactivate " + name + "?";
        message = "User cannot be access this website anymore";
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
                    url: "/customer/change",
                    data: {
                        id: id,
                        status: status
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "200") {
                            swal({
                                title: "Success",
                                text: response.data.message,
                                icon: "success",
                                button: "Ok"
                            });
                            getCustomer(currPage);
                        } else {
                            swal({
                                title: "Error",
                                text: response.data.message,
                                icon: "warning",
                                button: "Ok"
                            });
                        }
                    }
                })
            }
        });
});

$("body").on("click", ".btn-edit-user", function(e) {
    e.preventDefault();

    var id = $(this).data('id');

    $.ajax({
        type: "POST",
        url: "/customer/edit",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {
            if (response.status == '200') {
                var option = "";
                if (response.data.role == "2") {
                    option += '<option value="'+ response.data.role +'">Admin</option><option value="1">Customer</option>';
                } else {
                    option += '<option value="'+ response.data.role +'">Customer</option><option value="2">Admin</option>';
                }
                $('.username-user').val(response.data.username);
                $('.email-user').val(response.data.email);
                $('.phone-user').val(response.data.phone);
                $('.address-user').val(response.data.address);
                $('.role-user').html(option);
                $('.form-group-password').hide();
                $('.id-user').val(id);
                $('#modalAddUser').modal('show');

                // change url 
                $('#form-add-user').attr('action', "/customer/post-edit");
            }
        }
    });
});

$("body").on("click", ".btn-delete-user", function(e) {
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
                    url: "/customer/delete",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        getCustomer(currPage);
                        if (response.status == "200") {

                            swal({
                                title: "Success",
                                text: response.data.message,
                                icon: "success",
                                button: "Ok"
                            });
                        } else {
                            swal({
                                title: "Error",
                                text: response.data.message,
                                icon: "warning",
                                button: "Ok"
                            });
                        }
                    }
                })
            } else {
                swal("Your imaginary file is safe!");
            }
        });
})

$(document).ready(function() {
    getCustomer(0);

    var modalUser = document.getElementById('modalAddUser')
    modalUser.addEventListener('hidden.bs.modal', function (event) {
        document.getElementById('form-add-user').reset();

        var option = '<option value="1">Customer</option><option value="2">Admin</option>';
        $('.role-user').html(option);
        $('.form-group-password').show();
        $('input').removeClass('is-invalid');
    })
})

function getCustomer(page = 0) {
    $.ajax({
        type: "post",
        url: "/customer/",
        data: {
            page: page
        },
        dataType: "json",
        success: function(response) {
            console.log(response);
            $('.target-table-customer').html(response.table);
            if (response.pagination.length > 0) {
                $('.pagination-user').html(response.pagination);
            }
        }     
    })
}

function generatePassword(length) {
    var word = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var len = word.length;
    var password = '';
    for (var i = 0; i < length; i++) {
        password += word.charAt(Math.floor(Math.random() *
            len));
    }
    return password + len;
}