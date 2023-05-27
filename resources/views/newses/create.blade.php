@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add News</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('send.notification') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="users">Select Users</label>
                                <select name="users[]" id="users" class="form-control" multiple>
                                    <option value="all">All</option>
                                    @foreach($heads as $head)
                                        <option value="{{ $head->id }}">{{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }} (Head)</option>
                                    @endforeach
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }} (Member)</option>
                                    @endforeach
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">File</label>
                                 <input id="file" type="file" class="form-control" name="file[]" accept="image/*,video/*" multiple required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('newses.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyB50ZW8U8iGfBpJKq54Y442CtCO7n--h-U",

        authDomain: "maheskwari-community.firebaseapp.com",

        projectId: "maheskwari-community",

        storageBucket: "maheskwari-community.appspot.com",

        messagingSenderId: "84169887754",

        appId: "1:84169887754:web:df1f52f3cd68d9546f0ff3",

        measurementId: "G-MHZK709NQ5"

    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    function initFirebaseMessagingRegistration() {
        debugger;
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
</script>
@endsection
