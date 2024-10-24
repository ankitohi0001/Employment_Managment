
<x-layout bodyClass="bg-gray-200">
    <x-navbars.sidebar activePage="salary_types"></x-navbars.sidebar>
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
                                    <form action="{{ route('salary_types.index') }}" method="GET" class="mb-3">
                                        <div class="input-group border border-primary rounded ">
                                            <input type="text" name="search" class="form-control" placeholder="Seach Here . . . " value="{{ request()->get('search') }}" oninput="this.form.submit()">
                                           
                                        </div>
                                    </form>
                                </div>
                                <h4 class="card-title">Salary Types</h4>
                                <a href="{{ route('salary_types.create') }}" class="btn btn-primary">Add New Salary Type</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Salary Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($salary_types as $type)
                                        <tr>
                                            <td>{{ $type->id }}</td>
                                            <td>{{ $type->salary_type }}</td>
                                            <td>
                                                <a href="{{ route('salary_types.edit', $type->id) }}" class="btn btn-warning">Edit</a>
                                                <form action="{{ route('salary_types.destroy', $type->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4">No salary types found.</td>
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
