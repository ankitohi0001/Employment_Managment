<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="attendance"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbars.navs.auth titlePage='Create Attendance'></x-navbars.navs.auth>
        <!-- <div class="container-fluid px-2 px-md-4"> -->
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ auth()->user()->name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                {{ auth()->user()->role }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Attendance Details</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form method="POST" action="{{ route('attendances.store') }}" class="text-start">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">User</label>
                                <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="status_present" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_present">Present</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="status_absent" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_absent">Absent</label>
                                    </div>
                                </div>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Check-in Time</label>
                                <input type="time" name="check_in_time" class="form-control border border-2 p-2" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Kolkata')->format('H:i:s') }}">
                                @error('check_in_time')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Check-out Time</label>
                                <input type="time" name="check_out_time" class="form-control border border-2 p-2" value="{{ old('check_out_time') }}">
                                @error('check_out_time')
                                <p class='text-danger inputerror'>{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn bg-gradient-dark">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <x-footers.auth></x-footers.auth> -->
    </div>
    <!-- <x-plugins></x-plugins> -->

</x-layout>
