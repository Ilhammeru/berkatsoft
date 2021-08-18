<div class="row row-new-sales">
    <div class="col-4">
        <select name="product[]" class="form-control product-sales" id="product-sales-{{ $param + 1 }}" onchange="getPrice()">
            <option value="">[-- Choose --]</option>
            @foreach($data as $d)
                <option value="{{ $d->id . "-" . $d->price . "-" . $d->stock . "-" . $d->product }}">{{ $d->product }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <input type="text" class="form-control price-sales" id="price-sales-{{ $param + 1 }}" name="price[]" readonly>
    </div>
    <div class="col-4">
        <div class="input-group mb-3">
            <input type="number" placeholder="Qty" class="form-control qty-sales" id="qty-sales-{{ $param + 1 }}" readonly name="qty[]" onchange="checkQty()">
            <span class="input-group-text" id="basic-addon2">gr</span>
            <div class="invalid-feedback error-qty-sales" id="error-qty-sales-{{ $param + 1 }}"></div>
        </div>
    </div>
    <div class="col-1">
        <button class="btn btn-sm btn-danger btn-delete-row">
            <i class="fas fa-minus"></i>
        </button>
    </div>
</div>
