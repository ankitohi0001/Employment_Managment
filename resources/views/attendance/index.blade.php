<x-layout bodyClass="bg-gray-200">
    <x-navbars.sidebar activePage="attendances"></x-navbars.sidebar>
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
                                <h4 class="card-title">Attendance List</h4>
                                <a href="{{ route('attendances.create') }}" class="btn btn-primary">Add New  </a>
                                <div class="float-right" style="position: absolute; top: 10px; right: 10px;">
                                    <form action="{{ route('attendances.index') }}" method="GET" class="mb-3">
                                        <div class="input-group border border-primary rounded ">
                                            <input type="text" name="search" class="form-control" placeholder="Seach Here . . . " value="{{ request()->get('search') }}" oninput="this.form.submit()">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                            <th>Present</th>
                                            <th>Absent</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->attendances()->where('status', 0)->count() }}</td>
    <td>{{ $user->attendances()->where('status', 1)->count() }}</td>
    <td>
        @php
            // Get today's attendance record, if any
            $todayAttendance = $user->attendances()->whereDate('created_at', now())->first();
            $checkInAllowed = true;

            // Check if check-in was made today and if 12 hours have passed since the last check-in
            if ($todayAttendance && $todayAttendance->check_in_time) {
                $checkInTime = \Carbon\Carbon::parse($todayAttendance->check_in_time);
                if (now()->diffInHours($checkInTime) < 12) {
                    $checkInAllowed = false;  // Don't allow check-in if less than 12 hours
                }
            }
        @endphp
        <!-- Check-In Button -->
        @if ($checkInAllowed || !$todayAttendance)
            <form action="{{ route('attendances.checkin', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-primary">Check In</button>
            </form>
        @endif

        <!-- Check-Out Button -->
        @if ($todayAttendance && !$todayAttendance->check_out_time)
            <form action="{{ route('attendances.checkout', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success">Check Out</button>
            </form>
        @endif
        <a href="{{ route('attendances.view', $user->id) }}" class="btn btn-info">View</a>
        @if (!$todayAttendance || $todayAttendance->check_out_time)
            <a href="{{ route('attendances.absent', $user->id) }}" class="btn btn-danger">Absent</a>
        @endif
        <a href="{{ route('attendances.edit', $user->id) }}" class="btn btn-warning">Edit</a>
    </td>
</tr>
@empty
                                        <tr>
                                            <td colspan="6">No Attendances found.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-layout>
