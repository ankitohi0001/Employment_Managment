<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="users"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbars.navs.auth titlePage='Edit User'></x-navbars.navs.auth>
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('assets') }}/img/bruce-mars.jpg" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $user->name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                {{ $user->role }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Edit User Information</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ session('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif
                        <form method='POST' action='{{ route('users.update', $user->id) }}'>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control border border-2 p-2" value='{{ old('name', $user->name) }}'>
                                    @error('name')
                                    <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control border border-2 p-2" value='{{ old('email', $user->email) }}'>
                                    @error('email')
                                    <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control border border-2 p-2" value='{{ old('phone', $user->phone) }}'>
                                    @error('phone')
                                    <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Aadhar No <span class="text-danger">*</span></label>
                                    <input type="text" name="aadhar_no" class="form-control border border-2 p-2" value='{{ old('aadhar_no', $user->aadhar_no) }}'>
                                    @error('aadhar_no')
                                    <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Pan No</label>
                                    <input type="text" name="pan_no" class="form-control border border-2 p-2" value='{{ old('pan_no', $user->pan_no) }}'>
                                    @error('pan_no')
                                    <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="positions" class="form-label">Positions <span class="text-danger">*</span></label>
                                    <select name="position_id" id="positions" class="form-select">
                                        @foreach($positions as $position)
                                        <option value="{{ $position->id }}" {{ $user->position_id == $position->id ? 'selected' : '' }}>
                                            {{ strtoupper($position->position_type) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('position_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Role <span class="text-danger">*</span></label>
                                    <select name="role" class="form-select">
                                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    @error('role')
                                    <p class='text-danger inputerror'>{{ $message }}</p>
                                    @enderror
                                </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Joining Date <span class="text-danger">*</span></label>
                                <input type="date" name="date" class="form-control border border-2 p-2" value='{{ old('date', $user->date) }}'>
                                @error('date')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Account No <span class="text-danger">*</span></label>
                                <input type="text" name="account_no" class="form-control border border-2 p-2" value='{{ old('account_no', $user->account_no) }}'>
                                @error('account_no')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Bank Branch <span class="text-danger">*</span></label>
                                <input type="text" name="bank_branch" class="form-control border border-2 p-2" value='{{ old('bank_branch', $user->bank_branch) }}'>
                                @error('bank_branch')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Bank IFSC <span class="text-danger">*</span></label>
                                <input type="text" name="bank_ifsc" class="form-control border border-2 p-2" value='{{ old('bank_ifsc', $user->bank_ifsc) }}'>
                                @error('bank_ifsc')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Account Holder Name <span class="text-danger">*</span></label>
                                <input type="text" name="account_holder_name" class="form-control border border-2 p-2" value='{{ old('account_holder_name', $user->account_holder_name) }}'>
                                @error('account_holder_name')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6"> 
                                <label class="form-label">Payment Mode <span class="text-danger">*</span></label>
                                <select name="payment_mode" class="form-select">
                                    <option value="cash" {{ old('payment_mode', $user->payment_mode) == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="check" {{ old('payment_mode', $user->payment_mode) == 'check' ? 'selected' : '' }}>Check</option>
                                    <option value="upi" {{ old('payment_mode', $user->payment_mode) == 'upi' ? 'selected' : '' }}>UPI</option>
                                    <option value="bank_transfer" {{ old('payment_mode', $user->payment_mode) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                </select>
                                @error('payment_mode')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <label class="form-label">Salary Type</label>
                            <div class="mb-3 col-md-6">
                                @foreach($salary_types as $type)
                                    <label for="salary_type_{{ $type->id }}" class="form-label"> {{ strtoupper($type->salary_type) }}</label>
                                    <input type="text" name="salary_type_id[{{ $type->id }}]" id="salary_type_{{ $type->id }}" class="form-control border border-2 p-2" value="{{ old("salary_type_id_" . $type->id, $salary->where('salary_type_id', $type->id)->first()->amount ?? '') }}">
                                @endforeach
                            @error('salary_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            </div>
                        
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
