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
                                <h4 class="card-title">Positions List</h4>
                                <a href="{{ route('positions.create') }}" class="btn btn-primary">Add New Position</a>
                                <div class="float-right" style="position: absolute; top: 10px; right: 10px;">
                                    <form action="{{ route('positions.index') }}" method="GET" class="mb-3">
                                        <div class="input-group border border-primary rounded ">
                                            <input type="text" name="search" class="form-control" placeholder="Search Here . . . " value="{{ request()->get('search') }}" oninput="this.form.submit()">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Position Type</th>
                                            <th>Actions</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($positions as $position)
                                        <tr>
                                            <td>{{ $position->position_type }}</td>
                                            <td>
                                                <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('positions.destroy', $position->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6">No Positions found.</td>
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
