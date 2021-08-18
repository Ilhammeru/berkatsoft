<div class="card">
    <div class="card-body">
        <div class="text-end me-4 mb-2">
            <button class="btn btn-sm btn-primary btn-add-sales">
                <i class="fas fa-plus"></i>
                <span>Add Sales</span>
            </button>
        </div>
        <div class="px-4">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th style="width: 80px;">#</th>
                            <th style="min-width: 100px; width: 250px;">Name Customer</th>
                            <th style="width: 400px;">Detail Product</th>
                            <th style="width: 200px;">Total Price</th>
                            <th style="width: 200px;">status</th>
                        </tr>
                    </thead>
                    <tbody class="target-table-sales"></tbody>
                </table>
            </div>
    
            {{-- pagination --}}
            <div class="pagination-sales"></div>
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"" id="modalAddSales" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3">
                <form id="form-add-sales">
                    <div class="form-group">
                        <label for="">Name</label>
                        <select name="name" class="form-control name-sales" id="">
                            
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Product</label>
                        <div class="row">
                            <div class="col-4">
                                <select name="product[]" class="form-control product-sales" id="product-sales-0" onchange="getPrice()">
                                </select>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control price-sales" id="price-sales-0" name="price[]" readonly>
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <input type="number" placeholder="Qty" class="form-control qty-sales" readonly id="qty-sales-0" name="qty[]" onchange="checkQty()">
                                    <span class="input-group-text" id="basic-addon2">gr</span>
                                    <div class="invalid-feedback error-qty-sales" id="error-qty-sales-0"></div>
                                </div>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-sm btn-success btn-add-row-sales">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="target-row-sales"></div>
                        <div class="form-group mt-4">
                            <div class="text-center">
                                <button style="border-radius: 15px;" class="btn w-50 btn-primary btn-sm btn-save-sales" disabled>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function getPrice() {
        var input = document.getElementsByName('product[]');
        var k = [];
        for (var i = 0; i < input.length; i++) {
            var a = input[i];
            if (a.value != "") {
                var split = a.value.split('-');
                $('#price-sales-' + i).val(split[1]);
                $('#qty-sales-' + i).prop('readonly', false);
                $('.btn-save-sales').prop('disabled', false);
            } else {
                console.log('oke');
            }
        }
    }

    function checkQty() {
        var input = document.getElementsByName('product[]');
        var qty = document.getElementsByName('qty[]');
        var k = [];
        for (var i = 0; i < input.length; i++) {
            var a = input[i];
            var split = a.value.split('-');
            if (parseInt(qty[i].value) > parseInt(split[2])) {
                $('#qty-sales-' + i).addClass('is-invalid');
                $('#error-qty-sales-' + i).text('This item just have ' + split[2] + ' grams');
                $('#qty-sales-' + i).val('');
            } else {
                $('#qty-sales-' + i).removeClass('is-invalid');
            }
        }
    }
</script>

<script class="js-sales" src="{{ asset('assets/js/sales.js') }}"></script>