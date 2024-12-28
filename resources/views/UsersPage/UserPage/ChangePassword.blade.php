@include('UsersPage.layouts.header')

<div class="p-5 py-5 rounded">
    <form method="POST" action="{{ route('password.update') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary fw-bold">Change Password</h3>
        </div>

        <div class="row g-3">
            <!-- Old Password Field -->
            <div class="col-md-12">
                <label class="form-label text-secondary">Old Password</label>
                <input type="password" name="old_password" class="form-control shadow-sm" placeholder="Enter your old password">
                @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- New Password Field -->
            <div class="col-md-12">
                <label class="form-label text-secondary">New Password</label>
                <input type="password" name="password" class="form-control shadow-sm" placeholder="Enter your new password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm New Password Field -->
            <div class="col-md-12">
                <label class="form-label text-secondary">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control shadow-sm" placeholder="Confirm your new password">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-5 text-center">
            <button class="btn btn-primary profile-button px-5 py-2 rounded-pill shadow-lg" type="submit">Save Password</button>
        </div>
    </form>


</div>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session("success") }}',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ route("UserProfile") }}';
        }
    });
</script>
@endif

@include('UsersPage.layouts.footer')
