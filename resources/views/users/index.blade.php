<x-layout bodyClass="bg-gray-200">
    
    <x-navbars.sidebar activePage="users"></x-navbars.sidebar>
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
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Users List</h4>
                                <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
                                <div class="float-right" style="position: absolute; top: 10px; right: 10px;">
                                    <form action="{{ route('users.index') }}" method="GET" class="mb-3">
                                        <div class="input-group border border-primary rounded ">
                                            <input type="text" name="search" class="form-control" placeholder="Seach Here . . . " value="{{ request()->get('search') }}" oninput="this.form.submit()">
                                           
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Aadhar No</th>
                                                <th>PAN No</th>
                                                <th>Position</th>
                                                <th>Role</th>
                                                <th>Payment Mode</th>
                                                <th>Date</th>
                                                <th>Account No</th>
                                                <th>Bank Branch</th>
                                                <th>Bank IFSC</th>
                                                <th>Account Holder Name</th>
                                                <th>Actions</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->aadhar_no }}</td>
                                                <td>{{ $user->pan_no }}</td>
                                                <td>{{ $user->position?->position_type }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->payment_mode }}</td>
                                                <td>{{ $user->date }}</td>
                                                <td>{{ $user->account_no }}</td>
                                                <td>{{ $user->bank_branch }}</td>
                                                <td>{{ $user->bank_ifsc }}</td>
                                                <td>{{ $user->account_holder_name }}</td>
                                                <td>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                        <tr>
                                            <td colspan="16">No users found.</td>
                                        </tr>
                                    @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-layout>
