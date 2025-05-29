@extends('backend.layouts.master')
@section('main-content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Seller Management</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sellers List</h6>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Total Products</th>
                                    <th>Pending Products</th>
                                    <th>Total Sales</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sellers as $seller)
                                <tr>
                                    <td>{{ $seller->name }}</td>
                                    <td>{{ $seller->email }}</td>
                                    <td>{{ $seller->phone ?? 'N/A' }}</td>
                                    <td>{{ $seller->products_count }}</td>
                                    <td>{{ $seller->pending_products_count }}</td>
                                    <td>${{ number_format($seller->total_sales, 2) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $seller->status == 'active' ? 'success' : 'danger' }}">
                                            {{ $seller->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.sellers.show', $seller->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                        <form action="{{ route('admin.sellers.toggle-status', $seller->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-{{ $seller->status == 'active' ? 'warning' : 'success' }} btn-sm">
                                                <i class="fas fa-{{ $seller->status == 'active' ? 'ban' : 'check' }}"></i>
                                                {{ $seller->status == 'active' ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No sellers found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $sellers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 