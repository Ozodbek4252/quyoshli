@extends('dashboard.layouts.app')
@section('title', trans('admin.add'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.add')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item ">
                                <a href="{{ route('dashboard.posts', $lang) }}">@lang('admin.posts.title') {{ $lang }}</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.add')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('vendor/editor/dist/summernote.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/dashboard/app-assets/vendors/css/forms/select/select2.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <form class="form form-vertical" action="{{ route('dashboard.post.store', $lang) }}" enctype="multipart/form-data" method="post">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('admin.add')</h4>
                    </div>
                    <div class="card-content">
                        @csrf
                        <div class="card-body">
                            <div class="form-body">
                                <p>@lang('admin.all_fields_with')</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">@lang('admin.posts.name') *</label>
                                                    <input type="text" id="first-name-vertical" required class="form-control @error('name') is-invalid @enderror"
                                                           name="name" value="{{ old('name') }}" placeholder="@lang('admin.posts.name')">
                                                    @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label>@lang('admin.posts.content') *</label>
                                                <div class="controls">
                                                    <fieldset class="form-group position-relative">
                                                    <textarea class="form-control @error('content') is-invalid @enderror" required name="content"
                                                              placeholder="@lang('admin.posts.content')" id="description_ru">{{ old('content') }}</textarea>
                                                    </fieldset>
                                                    @error('content')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label>@lang('admin.posts.language') *</label>
                                                <fieldset class="form-group">
                                                    <select class="select2 form-control" required name="language">
                                                        <option disabled>@lang('admin.posts.language')</option>
                                                        <option value="{{ $lang }}" selected>{{ $lang }}</option>
                                                    </select>
                                                </fieldset>
                                            </div>

                                            <div class="col-12">
                                                <label>@lang('admin.posts.type.title') *</label>
                                                <fieldset class="form-group">
                                                    <select class="select2 form-control" name="type" required>
                                                        <option disabled selected>@lang('admin.posts.type.title')</option>
                                                        <option value="news">@lang('admin.posts.type.news')</option>
                                                        <option value="article">@lang('admin.posts.type.article')</option>
                                                        <option value="sales">@lang('admin.posts.type.sales')</option>
                                                        <option value="media">@lang('admin.posts.type.media')</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image">@lang('admin.posts.image') *</label>
                                            <input type="file" id="image" required class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" placeholder="@lang('admin.posts.image')">
                                            @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">SEO</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <fieldset class="form-label-group">
                                        <textarea class="form-control"  name="keywords" id="label-descriptions-ru" rows="3" placeholder="@lang('admin.settings.keywords')">{{ old('keywords') }}</textarea>
                                        <label for="label-descriptions-ru">@lang('admin.settings.keywords') *</label>
                                    </fieldset>
                                </div>

                                <div class="col-12">
                                    <fieldset class="form-label-group">
                                        <textarea class="form-control"  name="descriptions" id="label-keywords-ru" rows="3" placeholder="@lang('admin.settings.description')">{{ old('description') }}</textarea>
                                        <label for="label-keywords-ru">@lang('admin.settings.description') *</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <fieldset class="checkbox">
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" value="1" name="topped">
                                            <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>

                                            <span class="">
                                            @lang('admin.posts.top')
                                        </span>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-footer pb-0 pl-0 pt-1">
                            <div class="col-12 mb-0">
                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                                            <i class="feather icon-save"></i> @lang('admin.save')
                                        </button>
                                    </div>

                                    <div class="col-9">
                                        <a href="{{ route('dashboard.posts', $lang) }}" class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
                                            <i class="feather icon-x-circle"></i> @lang('admin.cancel')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')

    <script src="{{ asset('vendor/editor/dist/summernote.min.js') }}"></script>

    <script src="{{ asset('/vendor/dashboard/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('/vendor/dashboard/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('#description_ru').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function (files) {
                        var that = $(this);

                        sendFile(files[0], that);
                    }
                }
            });

            function sendFile(file, that) {
                console.log(that);
                // console.log(welEditable);
                console.log(1);



                let data = new FormData();
                data.append('file', file);

                $.ajax({
                    url: "{{ route('dashboard.posts.image_upload') }}",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (data) {
                        $(that).summernote('insertImage', location.origin+'/'+data.image, '')
                    },

                    error: function (data) {

                    }
                })

            }
        });

        // ClassicEditor
        //     .create( document.querySelector( '#editor' ) )
        //     .catch( error => {
        //         console.error( error );
        //     } );
    </script>
@endpush
