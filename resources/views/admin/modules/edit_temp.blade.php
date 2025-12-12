@extends('layouts.app')

@section('title', 'Edit Module')

@section('content')
<section style="background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%); min-height: 100vh; padding: 80px 0;">
    <div class="container">
        <div class="mb-4">
            <h2 class="text-white"><i class="fas fa-edit"></i> Edit Module</h2>
            <a href="{{ route('admin.modules.index') }}" class="btn btn-warning mt-2">
                <i class="fas fa-arrow-left"></i> Back to Modules
            </a>
        </div>

        <div class="card bg-dark text-white border-secondary">
            <div class="card-body">
                <form action="{{ route('admin.modules.update', $module->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name *</label>
                            <input type="text" name="name" class="form-control bg-dark text-white border-secondary @error('name') is-invalid @enderror" value="{{ old('name', $module->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type *</label>
                            <select name="type" class="form-select bg-dark text-white border-secondary @error('type') is-invalid @enderror" required>
                                <option value="">Select Type</option>
                                <option value="module" {{ old('type', $module->type) == 'module' ? 'selected' : '' }}>Module</option>
                                <option value="workshop" {{ old('type', $module->type) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="webinar" {{ old('type', $module->type) == 'webinar' ? 'selected' : '' }}>Webinar</option>
                                <option value="competition" {{ old('type', $module->type) == 'competition' ? 'selected' : '' }}>Competition</option>
                            </select>
                            @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fee *</label>
                            <input type="number" name="fee" step="0.01" class="form-control bg-dark text-white border-secondary @error('fee') is-invalid @enderror" value="{{ old('fee', $module->fee) }}" required>
                            @error('fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Early Bird Fee</label>
                            <input type="number" name="earlybird_fee" step="0.01" class="form-control bg-dark text-white border-secondary @error('earlybird_fee') is-invalid @enderror" value="{{ old('earlybird_fee', $module->earlybird_fee) }}">
                            @error('earlybird_fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Team Min Size</label>
                            <input type="number" name="team_min" class="form-control bg-dark text-white border-secondary @error('team_min') is-invalid @enderror" value="{{ old('team_min', $module->team_min) }}">
                            @error('team_min')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Team Max Size</label>
                            <input type="number" name="team_max" class="form-control bg-dark text-white border-secondary @error('team_max') is-invalid @enderror" value="{{ old('team_max', $module->team_max) }}">
                            @error('team_max')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duration</label>
                            <input type="text" name="duration" class="form-control bg-dark text-white border-secondary @error('duration') is-invalid @enderror" value="{{ old('duration', $module->duration) }}" placeholder="e.g., 3 hours">
                            @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control bg-dark text-white border-secondary @error('date') is-invalid @enderror" value="{{ old('date', $module->date) }}">
                            @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="4" class="form-control bg-dark text-white border-secondary @error('description') is-invalid @enderror">{{ old('description', $module->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" id="imageInput" class="form-control bg-dark text-white border-secondary @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-white-50">Allowed: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                        
                        @if($module->image)
                            <div class="mt-2">
                                <label class="text-white d-block mb-2">Current Image:</label>
                                <img src="{{ asset($module->image) }}" alt="Current" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                            </div>
                        @endif
                        
                        <!-- Image Preview for new upload -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <label class="text-white d-block mb-2">New Image Preview:</label>
                            <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
                            <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="clearImagePreview()">
                                <i class="fas fa-times"></i> Remove
                            </button>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Update Module
                        </button>
                        <a href="{{ route('admin.modules.index') }}" class="btn btn-outline-light">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    // Image preview functionality
    function clearImagePreview() {
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        imageInput.value = '';
        imagePreview.style.display = 'none';
        previewImg.src = '';
    }

    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (file) {
            // Validate file type
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Invalid file type. Please upload JPEG, PNG, JPG, or GIF image.');
                clearImagePreview();
                return;
            }
            
            // Validate file size (2MB = 2048KB = 2097152 bytes)
            if (file.size > 2097152) {
                alert('File size exceeds 2MB. Please upload a smaller image.');
                clearImagePreview();
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            clearImagePreview();
        }
    });
</script>
