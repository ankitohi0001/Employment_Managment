<x-layout bodyClass="bg-gray-200">
    <x-navbars.sidebar activePage="positions"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    <!-- Navbar -->
                    <x-navbars.navs.guest signin='login' signup='register'></x-navbars.navs.guest>
                    <!-- End Navbar -->
                </div>
            </div>
        </div>
        <main class="main-content mt-0">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Position</h4>
                            </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('positions.update', $position->id) }}" class="text-start">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Position Type</label>
                                        <input type="text" name="position_type" class="form-control border border-2 p-2" value="{{ old('position_type', $position->position_type) }}">
                                        @error('position_type')
                                        <p class='text-danger inputerror'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-layout>
