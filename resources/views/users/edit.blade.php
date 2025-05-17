@extends('layouts.master')
@section('title', 'Edit User Profile')
@section('content')
<div class="row mt-2">
    <div class="col col-10">
        <h1>Edit User Profile</h1>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card mt-2">
    <div class="card-body">
        <form action="{{ route('users_save', $user->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-1"></i> Name
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user->name) }}" 
                               required
                               minlength="3"
                               maxlength="255"
                               placeholder="Enter user's name">
                        @error('name')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $errors->first('name') }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-1"></i> Email
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}" 
                               required
                               placeholder="Enter user's email">
                        @error('email')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">
                            <i class="fas fa-map-marker-alt me-1"></i> Address
                        </label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" 
                                  name="address" 
                                  rows="3">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                        @enderror
                    </div>

                    @can('admin_users')
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-user-tag me-1"></i> Roles
                        </label>
                        <div class="role-selection">
                            @foreach($roles as $role)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="roles[]" 
                                           value="{{ $role->name }}" 
                                           id="role_{{ $role->name }}"
                                           {{ in_array($role->name, old('roles', $user->roles->pluck('name')->toArray())) ? 'checked' : '' }}>
                                    <label class="form-check-label d-flex align-items-center" for="role_{{ $role->name }}">
                                        <span class="badge bg-{{ $role->name === 'admin' ? 'danger' : 'primary' }} me-2">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                        <small class="text-muted">{{ $role->description ?? 'No description available' }}</small>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('roles')
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $errors->first('roles') }}
                            </div>
                        @enderror
                    </div>
                    @endcan
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Save Changes
                </button>
                <a href="{{ route('profile', $user->id) }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    .form-select[multiple] {
        height: auto;
        min-height: 100px;
    }
    
    .alert {
        margin-bottom: 0;
    }

    .form-label {
        font-weight: 500;
    }

    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .btn {
        padding: 0.5rem 1rem;
        font-weight: 500;
    }

    .invalid-feedback {
        font-size: 0.875em;
    }

    .role-selection {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .form-check-input:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .form-check-label {
        cursor: pointer;
        width: 100%;
    }

    .badge {
        font-size: 0.875em;
        padding: 0.5em 0.8em;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('.needs-validation');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const closeButton = alert.querySelector('.btn-close');
            if (closeButton) {
                closeButton.click();
            }
        }, 5000);
    });

    // Role selection enhancement
    const roleCheckboxes = document.querySelectorAll('.role-selection input[type="checkbox"]');
    roleCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.classList.add('text-primary');
            } else {
                label.classList.remove('text-primary');
            }
        });
    });
});
</script>
@endpush
@endsection
