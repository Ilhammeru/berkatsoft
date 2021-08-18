<div class="card">
    <div class="card-body">
        @if(Session::get('role') == 'admin')
        <div class="text-end me-4 mb-2">
            <button class="btn btn-sm btn-primary btn-add-user">
                <i class="fas fa-plus"></i>
                <span>Add User</span>
            </button>
        </div>
        @endif
        <div class="px-4">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-info">
                        <tr>
                            <th style="width: 80px;">#</th>
                            <th style="min-width: 100px;">Username</th>
                            <th style="min-width: 100px;">Email</th>
                            <th style="width: 70px;">Status</th>
                            <th class="text-center" style="min-width: 50px; max-width: 50px;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="target-table-customer"></tbody>
                </table>
            </div>
    
            {{-- pagination --}}
            <div class="pagination-user"></div>
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" id="modalAddUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <form id="form-add-user">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control username-user" name="username">
                                <input type="hidden" class="id-user" name="id">
                                <div class="invalid-feedback error-username-user"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control email-user" name="email">
                                <div class="invalid-feedback error-email-user"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="number" class="form-control phone-user" name="phone">
                                <div class="invalid-feedback error-phone-user"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control address-user" name="address">
                                <div class="invalid-feedback error-address-user"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="">Role</label>
                                <select name="role" class="form-control role-user" id="">
                                    <option value="1">Customer</option>
                                    <option value="2">Admin</option>
                                </select>
                                <div class="invalid-feedback error-role-user"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group form-group-password">
                                <label for="">Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control password-user" name="password" aria-describedby="basic-addon2">
                                    <span style="cursor: pointer;" class="input-group-text generate-password-user" id="basic-addon2">Generate</span>
                                    <div class="invalid-feedback error-password-user"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-50 btn-save-user" style="border-radius: 15px;">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
<script class="js-customer" src="{{ asset('assets/js/customer.js') }}"></script>
@endpush