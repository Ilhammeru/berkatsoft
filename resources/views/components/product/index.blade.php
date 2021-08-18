<div class="card">
    <div class="card-body">
        @if(Session::get('role') == 'admin')
        <div class="text-end me-4 mb-2">
            <button class="btn btn-sm btn-primary btn-add-product">
                <i class="fas fa-plus"></i>
                <span>Add Product</span>
            </button>
        </div>
        @endif
        <div class="px-4">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th style="width: 80px;">#</th>
                            <th style="min-width: 100px; width: 400px;">Name</th>
                            <th style="width: 300px;">Price</th>
                            <th style="width: 200px;">Stock</th>
                            <th style="width: 200px;">status</th>
                            <th class="text-center" style="min-width: 50px; width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="target-table-product"></tbody>
                </table>
            </div>
    
            {{-- pagination --}}
            <div class="pagination-product"></div>
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"" id="modalAddProduct" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <form id="form-add-product">
                    <div class="row">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control name-product" name="product">
                            <input type="text" class="d-none id-product" name="id">
                            <input type="text" class="d-none helper-product" name="helper_product">
                            <div class="invalid-feedback error-name-product"></div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control price-product" name="price">
                                <div class="invalid-feedback error-price-product"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="">Stock</label>
                                <div class="input-group">
                                    <input type="number" class="form-control stock-product" name="stock">
                                    <span class="input-group-text" id="basic-addon2">Gr</span>
                                    <div class="invalid-feedback error-stock-product"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-50 btn-save-product" style="border-radius: 15px;">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script class="js-product"></script>