@extends('layouts.app')

@section('title', 'Add Module')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);">
    <div class="container">
        <div class="mb-4">
            <p class="text-uppercase small mb-1" style="color: rgba(255,255,255,0.6);">Inventory · Admin</p>
            <h1 class="text-white mb-0">Add New Module</h1>
        </div>

        <div class="card border-0 shadow" style="background: #1a1a1a;">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>We ran into {{ $errors->count() }} issue(s):</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.modules.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label text-white">Name *</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label text-white">Type *</label>
                            <select name="type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="module" {{ old('type') == 'module' ? 'selected' : '' }}>Module</option>
                                <option value="workshop" {{ old('type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="webinar" {{ old('type') == 'webinar' ? 'selected' : '' }}>Webinar</option>
                                <option value="competition" {{ old('type') == 'competition' ? 'selected' : '' }}>Competition</option>
                            </select>
                            @error('type')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">Fee (PKR) *</label>
                            <input type="number" name="fee" step="0.01" min="0" class="form-control" value="{{ old('fee') }}" required>
                            @error('fee')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label text-white">Early Bird Fee (PKR)</label>
                            <input type="number" name="earlybird_fee" step="0.01" min="0" class="form-control" value="{{ old('earlybird_fee') }}">
                            @error('earlybird_fee')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">Team Min Size</label>
                            <input type="number" name="team_min" min="1" class="form-control" value="{{ old('team_min', 1) }}">
                            @error('team_min')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label text-white">Team Max Size</label>
                            <input type="number" name="team_max" min="1" class="form-control" value="{{ old('team_max', 1) }}">
                            @error('team_max')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">Duration</label>
                            <input type="text" name="duration" class="form-control" value="{{ old('duration') }}" placeholder="e.g., 3 hours">
                            @error('duration')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label text-white">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                            @error('date')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label text-white">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                            @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label text-white">Image</label>
                            <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                            @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                            <small class="text-white-50">Allowed: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <label class="text-white d-block mb-2">Preview:</label>
                                <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                                <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="clearImagePreview()">
                                    <i class="fas fa-times"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-3">
                        <button type="submit" class="btn btn-warning text-dark fw-semibold">
                            <i class="fas fa-save"></i> Save Module
                        </button>
                        <a href="{{ route('admin.modules.index') }}" class="btn btn-outline-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
// Image preview functionality
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            alert('Please select a valid image file (JPEG, PNG, JPG, or GIF)');
            this.value = '';
            return;
        }

        // Validate file size (2MB = 2048KB)
        if (file.size > 2048 * 1024) {
            alert('Image size must be less than 2MB');
            this.value = '';
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

function clearImagePreview() {
    document.getElementById('imageInput').value = '';
    document.getElementById('previewImg').src = '';
    document.getElementById('imagePreview').style.display = 'none';
}
</script>
@endsection

@section('page-title', 'Create Module')

@section('content')
<div class="content-card">
    <div class="mb-4">
        <h2><i class="fas fa-plus-circle"></i> Create New Module</h2>
        <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary mt-2">
            <i class="fas fa-arrow-left"></i> Back to Modules
        </a>
    </div>

    <form action="{{ route('admin.modules.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Type *</label>
                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                    <option value="">Select Type</option>
                    <option value="workshop" {{ old('type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                    <option value="competition" {{ old('type') == 'competition' ? 'selected' : '' }}>Competition</option>
                    <option value="event" {{ old('type') == 'event' ? 'selected' : '' }}>Event</option>
                </select>
                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Fee *</label>
                <input type="number" name="fee" step="0.01" class="form-control @error('fee') is-invalid @enderror" value="{{ old('fee') }}" required>
                @error('fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Early Bird Fee</label>
                <input type="number" name="earlybird_fee" step="0.01" class="form-control @error('earlybird_fee') is-invalid @enderror" value="{{ old('earlybird_fee') }}">
                @error('earlybird_fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Team Min Size</label>
                <input type="number" name="team_min" class="form-control @error('team_min') is-invalid @enderror" value="{{ old('team_min', 1) }}">
                @error('team_min')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Team Max Size</label>
                <input type="number" name="team_max" class="form-control @error('team_max') is-invalid @enderror" value="{{ old('team_max', 1) }}">
                @error('team_max')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Duration</label>
                <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" placeholder="e.g., 3 hours">
                @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Module
            </button>
            <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection