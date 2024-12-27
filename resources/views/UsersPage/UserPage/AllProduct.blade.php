@include('UsersPage.layouts.header')




<h1>{{ Auth::user()->name }}</h1>

<div class="d-flex mt-4">
    <a href="{{ url()->previous() }}" class="btn btn-primary me-2">Back</a>
</div>
@include('UsersPage.layouts.footer')