<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="salary_types"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Edit Salary Type'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <!-- <div class="container-fluid px-2 px-md-4"> -->
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <!-- Placeholder for future profile image -->
                    </div>
                    <!-- <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ auth()->user()->name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                CEO / Co-Founder
                            </p>
                        </div>
                    </div>
                </div> -->
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Edit Salary Type</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form method="POST" action="{{ route('salary_types.update', $salary_Type->id) }}" class="text-start">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Salary Type</label>
                                <input type="text" name="salary_type" class="form-control border border-2 p-2" value="{{ old('salary_type', $salary_Type->salary_type) }}">
                                @error('salary_type')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn bg-gradient-dark mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
