<div>
    {{-- <div class="page-dashboard page-master d-none">
        <div class="row p-0">
            <div class="col-12 p-0">
                <div class="px-5">
                    <div class="card">
                        <div class="card-body">
                            <p>Ilham Meru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="page-customer page-master {{ (Session::get('role') == 'admin') ? "" : "d-none" }}">
        <div class="row p-0">
            <div class="col-12 p-0">
                <div class="px-5">
                    <x-customer.index></x-customer.index>
                </div>
            </div>
        </div>
    </div>
    <div class="page-product page-master d-none">
        <div class="row p-0">
            <div class="col-12 p-0">
                <div class="px-5">
                    <x-product.index></x-product.index>
                </div>
            </div>
        </div>
    </div>
    <div class="page-sales page-master {{ (Session::get('role') == 'admin') ? "d-none" : "" }}">
        <div class="row p-0">
            <div class="col-12 p-0">
                <div class="px-5">
                    <x-sales.index></x-sales.index>
                </div>
            </div>
        </div>
    </div>
</div>