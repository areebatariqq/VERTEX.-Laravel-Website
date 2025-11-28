@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%); min-height: calc(100vh - 150px);">
    <div class="container">
        <div class="mb-4">
            <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.6);">Dashboard · Admin</p>
            <h1 class="text-white mb-0">Overview</h1>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow" style="background: rgba(74, 144, 226, 0.1); border-left: 4px solid #4a90e2 !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-white-50 small mb-1">Total Modules</p>
                                <h2 class="text-white mb-0">{{ $modulesCount ?? 0 }}</h2>
                            </div>
                            <i class="fas fa-layer-group fa-3x" style="color: #4a90e2; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow" style="background: rgba(76, 175, 80, 0.1); border-left: 4px solid #4caf50 !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-white-50 small mb-1">Registered Users</p>
                                <h2 class="text-white mb-0">{{ $usersCount ?? 0 }}</h2>
                            </div>
                            <i class="fas fa-users fa-3x" style="color: #4caf50; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Modules -->
        <div class="card border-0 shadow" style="background: #1a1a1a;">
            <div class="card-body p-0">
                <div class="p-4 border-bottom" style="border-color: #333 !important;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-white mb-0">Recent Modules</h4>
                        <a href="{{ route('admin.modules.index') }}" class="btn btn-warning text-dark fw-semibold">
                            <i class="fas fa-list"></i> View All Modules
                        </a>
                    </div>
                </div>

                @if(count($recentModules ?? []) > 0)
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Fee</th>
                                <th>Duration</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentModules as $module)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $module->name ?? 'N/A' }}</div>
                                    <small class="text-white-50">{{ \Illuminate\Support\Str::limit($module->description ?? '', 60) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $module->type == 'workshop' ? 'primary' : ($module->type == 'competition' ? 'success' : 'info') }}">
                                        {{ ucfirst($module->type ?? 'N/A') }}
                                    </span>
                                </td>
                                <td>${{ number_format($module->fee ?? 0, 2) }}</td>
                                <td>{{ $module->duration ?? 'N/A' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.modules.edit', $module->id) }}" class="btn btn-sm btn-outline-light">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="p-5 text-center text-white-50">
                    <i class="fas fa-inbox fa-4x mb-3" style="opacity: 0.3;"></i>
                    <p class="mb-3">No modules found yet.</p>
                    <a href="{{ route('admin.modules.create') }}" class="btn btn-warning text-dark fw-semibold">
                        <i class="fas fa-plus"></i> Create Your First Module
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection