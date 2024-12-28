@include('UsersPage.layouts.header')

<div class="p-5 py-5 rounded ">
    <!-- <div class="d-flex flex-column align-items-center text-center "><img class="rounded-circle" width="150px" src="{{ asset('storage/image/batman1.png') }}" alt="Profile Image"> -->
    <!-- <span class="font-weight-bold">{{ Auth::user()->name }}</span><span class="text-black-50">{{ Auth::user()->email }}</span><span> </span> -->
    <!-- </div> -->
    <form method="POST" action="{{ route('profile.update') }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary fw-bold">Edit User Profile  / <a class="text-primary fw-bold" href="{{route('ChangePassword')}}">Change Password</a></h3>
        </div>
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label text-secondary">Name</label>
                <input type="text" name="name" class="form-control shadow-sm" placeholder="Enter your name" value="{{ Auth::user()->name }}">
            </div>
            <div class="col-md-12">
                <label class="form-label text-secondary">Email</label>
                <input type="email" name="email" class="form-control shadow-sm" placeholder="Enter your email" value="{{ Auth::user()->email }}">
            </div>
            <div class="col-md-6">
                <label class="form-label text-secondary">Mobile Number</label>
                <input type="text" name="phone" class="form-control shadow-sm" placeholder="Enter your phone number" value="{{ Auth::user()->phone }}">
            </div>
            <div class="col-md-6">
                <label class="form-label text-secondary">Address</label>
                <input type="text" name="address" class="form-control shadow-sm" placeholder="Enter your address" value="{{ Auth::user()->address }}">
            </div>
            <div class="col-md-6">
                <label class="form-label text-secondary">Postcode</label>
                <input type="text" name="postcode" class="form-control shadow-sm" placeholder="Enter your postcode" value="{{ Auth::user()->postcode }}">
            </div>
            <div class="col-md-6">
                <label class="form-label text-secondary">State</label>
                <input type="text" name="state" class="form-control shadow-sm" placeholder="Enter your state" value="{{ Auth::user()->state }}">
            </div>
            <div class="col-md-6">
                <label class="form-label text-secondary">Country</label>
                <input type="text" class="form-control shadow-sm" placeholder="Country" value="Jordan" readonly disabled>
            </div>
            <div class="col-md-6">
                <label class="form-label text-secondary">City</label>
                <select class="form-control shadow-sm" name="city">
                    <option value="" disabled selected>{{ Auth::user()->city }}</option>
                    <option value="Amman">Amman</option>
                    <option value="Zarqa">Zarqa</option>
                    <option value="Irbid">Irbid</option>
                    <option value="Aqaba">Aqaba</option>
                    <option value="Madaba">Madaba</option>
                    <option value="Jerash">Jerash</option>
                    <option value="Ajloun">Ajloun</option>
                    <option value="Karak">Karak</option>
                    <option value="Tafilah">Tafilah</option>
                    <option value="Maan">Maan</option>
                    <option value="Balqa">Balqa</option>
                    <option value="Mafraq">Mafraq</option>
                </select>
            </div>
        </div>
        <div class="mt-5 text-center">
            <button class="btn btn-primary profile-button px-5 py-2 rounded-pill shadow-lg" type="submit">Save Profile</button>
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