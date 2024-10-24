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
                            <div class="float-right" style="position: absolute; top: 10px; right: 10px;">
                                    <form action="{{ route('totalsalary') }}" method="GET" class="mb-3">
                                        <div class="input-group border border-primary rounded ">
                                            <input type="text" name="search" class="form-control" placeholder="Seach Here . . . " value="{{ request()->get('search') }}" oninput="this.form.submit()">
                                           
                                        </div>
                                    </form>
                                </div>
                                <h4 class="card-title">Total Salaries</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Total Absents</th>
                                        <th>Total Salary</th>
                                        <th>Single Day Salary</th>
                                        <th>This Month Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->totalabsents }}</td>
                                        <td>{{ $user->totalSalary }}</td>
                                        <td>{{ $user->singleDaySalary }}</td>
                                        <td>{{ $user->thismonthsalary }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No users found.</td>
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
