@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <a href="{{ route('galleries.create') }}" class="btn btn-primary float-right" >Create</a>
                    </div>
                </div>
                <div class="card-header">{{ __('Gallery') }}</div>

                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#images">{{ __('Media') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#news">{{ __('News') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#event">{{ __('Event') }}</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="images">
                            <div class="row mt-4">
                                @foreach($media->where('source', 'media') as $gallery)
                                
                                <div class="col-sm-4 mb-4">
                                    <div class="card">
                                        <form action="{{ route('galleries.destroy', $gallery['id']) }}" method="POST" style="display: inline-block; margin-top: 8px;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this file?')) { $(this).closest('form').submit(); } else { return false; }" style="float: right; margin-right: 17px">
                                                <i class="fa fa-trash"></i> 
                                            </a>
                                        </form>
                                        <img src="{{ $gallery['name']}}" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text"><strong>{{ __('Album Name') }}:</strong> {{ $gallery['album_name'] ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="news">
                            <div class="row mt-4">
                                @foreach($media->where('source', 'news') as $gallery)
                                <div class="col-sm-4 mb-4">
                                    <div class="card">
                                        <form action="{{ route('galleries.destroy', $gallery['id']) }}" method="POST" style="display: inline-block; margin-top: 8px;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this file?')) { $(this).closest('form').submit(); } else { return false; }" style="float: right; margin-right: 17px">
                                                <i class="fa fa-trash"></i> 
                                            </a>
                                        </form>
                                        <img src="{{ $gallery['name']}}" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text"><strong>{{ __('Album Name') }}:</strong> {{ $gallery['album_name'] ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-4 mb-4">
                                    <div class="card">
                                        <form action="{{ route('galleries.destroy', $gallery['id']) }}" method="POST" style="display: inline-block; margin-top: 8px;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this file?')) { $(this).closest('form').submit(); } else { return false; }" style="float: right; margin-right: 17px">
                                                <i class="fa fa-trash"></i> 
                                            </a>
                                        </form>
                                        <video width="100%" height="240" controls>
                                            <source src="{{ $gallery['name']}}" type="video/{{ $gallery['type'] }}">
                                            <div class="card-body">    
                                                <p class="card-text"><strong>{{ __('Event Name') }}:</strong> {{ $gallery['event_name'] ?? '-' }}</p>
                                            </div>
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div> -->
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="event">
                            <div class="row mt-4">
                                @foreach($media->where('source', 'event') as $gallery)
                                <div class="col-sm-4 mb-4">
                                    <div class="card">
                                        <form action="{{ route('galleries.destroy', $gallery['id']) }}" method="POST" style="display: inline-block; margin-top: 8px;">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this file?')) { $(this).closest('form').submit(); } else { return false; }" style="float: right; margin-right: 17px">
                                                <i class="fa fa-trash"></i> 
                                            </a>
                                        </form>
                                        <img src="{{ $gallery['name']}}" class="card-img-top">
                                        <div class="card-body">
                                            <p class="card-text"><strong>{{ __('Album Name') }}:</strong> {{ $gallery['album_name'] ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
