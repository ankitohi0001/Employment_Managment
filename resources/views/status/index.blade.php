
<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='?'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Employment Status"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h6 class="text-capitalize">Today's Present Records</h6>
                        </div>
                        <div class="card-body">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($attendances as $record)
                                        <tr>
                                            <td>{{ $record->user->name ?? 'No name available' }}</td>
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
