@extends('layouts.app')

@section('title', 'Manage Modules')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%); min-height: calc(100vh - 150px);">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.6);">Inventory · Admin</p>
                <h1 class="text-white mb-0">Modules</h1>
            </div>
            <a href="{{ route('admin.modules.create') }}" class="btn btn-warning text-dark fw-semibold">
                <i class="fas fa-plus"></i> Add Module
            </a>
        </div>

        <div class="card border-0 shadow" style="background: #1a1a1a;">
            <div class="card-body p-0">
                @if(isset($modules) && $modules->isEmpty())
                    <div class="p-5 text-center text-white-50">
                        <i class="fas fa-inbox fa-4x mb-3" style="opacity: 0.3;"></i>
                        <p class="mb-0">No modules found yet. Start by adding your first module.</p>
                    </div>
                @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Fee</th>
                                <th>Early Bird</th>
                                <th>Team Size</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modules ?? [] as $module)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $module->name }}</div>
                                    <small class="text-white-50">{{ \Illuminate\Support\Str::limit($module->description ?? '', 60) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $module->type == 'workshop' ? 'primary' : ($module->type == 'competition' ? 'success' : 'info') }}">
                                        {{ ucfirst($module->type) }}
                                    </span>
                                </td>
                                <td>${{ number_format($module->fee ?? 0, 2) }}</td>
                                <td>${{ number_format($module->earlybird_fee ?? 0, 2) }}</td>
                                <td>{{ $module->team_min ?? 0 }} - {{ $module->team_max ?? 0 }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.modules.edit', $module->id) }}" class="btn btn-sm btn-outline-light me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this module?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection