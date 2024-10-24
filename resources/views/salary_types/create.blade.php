<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="salary_types"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbars.navs.auth titlePage='Create Salary Type'></x-navbars.navs.auth>
        <!-- <div class="container-fluid px-2 px-md-4"> -->
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <!-- <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('assets') }}/img/bruce-mars.jpg" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div> -->
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ auth()->user()->name }}
                            </h5>
                            <!-- <p class="mb-0 font-weight-normal text-sm">
                                CEO / Co-Founder
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Salary Type Information</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('salary_types.store') }}" method="POST" class="text-start">
                            @csrf
                            <div class="input-group input-group-outline mt-3 @error('salary_type') is-invalid @enderror">
                                <label class="form-label">Salary Type</label>
                                <input type="text" class="form-control" name="salary_type" value="{{ old('salary_type') }}">
                            </div>
                            @error('salary_type')
                            <p class='text-danger inputerror'>{{ $message }}</p>
                            @enderror

                            <button type="submit" class="btn bg-gradient-dark mt-3">Create Salary Type</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <x-footers.auth></x-footers.auth> -->
    </div>
    <!-- <x-plugins></x-plugins> -->
</x-layout>
