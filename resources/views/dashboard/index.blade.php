<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <!-- Calendar for selecting date -->
           

            <div class="row">
                <!-- Total Members -->
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">group</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Members</p>
                                <h4 class="mb-0">{{ $totalemployees }}</h4>
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm mt-3">View All Members <i class="material-icons">arrow_forward</i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Present Employees -->
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">check_circle</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Present Employees</p>
                                <h4 class="mb-0">{{ $presentEmployees }}</h4>
                                <a href="{{ route('employees') }}?present=0" class="btn btn-primary btn-sm mt-3">View Present Employees <i class="material-icons">arrow_forward</i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Absent Employees -->
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">highlight_off</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Absent Employees</p>
                                <h4 class="mb-0">{{ $absentEmployees }}</h4>
                                <a href="{{ route('employees') }}?absent=1" class="btn btn-primary btn-sm mt-3">View Absent Employees <i class="material-icons">arrow_forward</i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Creation Date -->
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">date_range</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Employees</p>
                                <h4 class="mb-0">{{ $employes }}</h4>
                                <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm mt-3">View All Employees <i class="material-icons">arrow_forward</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h6 class="text-capitalize">Select Date to View Attendance</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dashboard') }}" method="GET">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="date" value="{{ request('date', date('Y-m-d')) }}">
                                    <button type="submit" class="btn btn-primary btn-sm btn-round">Show Attendance</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Records Table -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h6 class="text-capitalize">All Attendance Records</h6>
                        </div>
                        <div class="card-body">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($attendances as $record)
                                        <tr>
                                            <td>{{ $record->user->name ?? 'No name available' }}</td>
                                            <td>{{ $record->date ?? 'No date available' }}</td>
                                            <td>
                                                @if ($record->status == 0) 
                                                    <span class="text-success">&#10004;</span> 
                                                @elseif ($record->status == 1)
                                                    <span class="text-danger">&#10006;</span> 
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">No attendance records available.</td>
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
    

</x-layout>
