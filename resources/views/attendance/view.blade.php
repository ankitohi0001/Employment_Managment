<x-layout bodyClass="bg-gray-200">
    <x-navbars.sidebar activePage="attendances"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <div class="container position-sticky z-index-sticky top-0">
           
        </div>
        <main class="main-content mt-0">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <!-- Display Total Records for Present and Absent -->
                        <div class="card mb-4">
                            <div class="card-body d-flex justify-content-around">
                                <div>
                                    <h5>Total Present: 
                                        <span class="badge bg-primary">{{ $attendances->where('status', 0)->count() }}</span>
                                    </h5>
                                </div>
                                <div>
                                    <h5>Total Absent: 
                                        <span class="badge bg-warning">{{ $attendances->where('status', 1)->count() }}</span>
                                    </h5>
                                </div>
                                <div>
                                    <h5>Total Working Days: 
                                        <span class="badge bg-info">{{ $attendances->count() }}</span>
                                    </h5>
                                </div>
                                <div>
                                    <h5>Total Working Hours: 
                                        <span class="badge bg-success">
                                            @php
                                                $totalHours = 0;
                                                foreach($attendances as $attendance) {
                                                    $checkInTime = \Carbon\Carbon::parse($attendance->check_in_time);
                                                    $checkOutTime = \Carbon\Carbon::parse($attendance->check_out_time);
                                                    $totalHours += $checkOutTime->diffInHours($checkInTime);
                                                }
                                            @endphp
                                            {{ $totalHours }} hours
                                        </span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        

                        <!-- Attendance List Table -->
                        <div class="card shadow-lg">
                            <div class="card-header bg-primary text-white">
                                <h4 class="card-title text-center">Attendance List for {{ $user->name }}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Date</th>
                                            <th>Day</th>
                                            <th>Present</th>
                                            <th>Absent</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attendances as $attendance)
                                        <tr>
                                            <td>{{ $attendance->created_at->format('F j, Y') }}</td>
                                            <td>{{ $attendance->created_at->format('l') }}</td>
                                            <td>
                                                @if($attendance->status == 0)
                                                    <span class="text-success">&#10004;</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($attendance->status == 1)
                                                    <span class="text-danger">&#10006;</span>
                                                @endif
                                            </td>
                                            <td>{{ $attendance->check_in_time ? \Carbon\Carbon::parse($attendance->check_in_time)->format('g:i A') : 'N/A' }}</td>
                                            <td>{{ $attendance->check_out_time ? \Carbon\Carbon::parse($attendance->check_out_time)->format('g:i A') : 'N/A' }}</td>
                                        </tr>
                                        @endforeach
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
