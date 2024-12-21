<head>
    <style>
        body {
            background: rgb(99, 39, 120)
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
</head>
@include('layout.header')

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{ asset('storage/image/batman1.png') }}" alt="Profile Image">
                <span class="font-weight-bold">{{ Auth::user()->name }}</span><span class="text-black-50">{{ Auth::user()->email }}</span><span> </span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value="{{ Auth::user()->name }}"></div>
                    <div class="col-md-12"><label class="labels">Email </label><input type="text" class="form-control" placeholder="enter email " value="{{ Auth::user()->email }}"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value="{{ Auth::user()->phone }}"></div>
                    <div class="col-md-6"><label class="labels">Address</label><input type="text" class="form-control" placeholder="enter address line 1" value="{{ Auth::user()->address }}"></div>
                    <div class="col-md-6"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="enter address line 2" value="{{ Auth::user()->postcode }}"></div>
                    <div class="col-md-6"><label class="labels">State</label><input type="text" class="form-control" placeholder="enter address line 2" value="{{ Auth::user()->state }}"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value="Jordan" readonly></div>
                    <div class="col-md-6">
                        <label class="labels">City</label>
                        <select class="form-control" name="city">
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
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
            </div>

        </div>

    </div>
</div>

@include('layout.footer')
