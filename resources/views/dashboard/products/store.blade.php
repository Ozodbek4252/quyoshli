@extends('dashboard.layouts.app')
@section('title', trans('admin.add') . ' - ')
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
                                <a href="{{ route('dashboard.products') }}">@lang('admin.products.title')</a>
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

@section('content')
    <div id="app">
        <product-add :brands="{{ json_encode($brands) }}" :categories="{{ json_encode($categories) }}"
            :colors="{{ json_encode($colors) }}" :back-url="{{ json_encode($_SERVER['HTTP_REFERER']) }}"></product-add>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    {{--  @vite('resources/js/app.js')</script>  --}}
    @vite('resources/js/app.js')


    <script>
        $(document).ready(function() {
            $("#image_cat").hide();
            $("#remove_img").hide();
            $("#add_img").show();

            $("#add_img").click(function() {
                $("#image_cat").show();
                $("#remove_img").show();
                $("#add_img").hide();
            });
            $("#remove_img").click(function() {
                $("#image_cat").hide();
                $("#remove_img").hide();
                $("#add_img").show();
            });
        });
    </script>

    <script type="text/javascript">
        function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("uploadPreview").src = oFREvent.target.result;
            };
        };
    </script>

    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vue-file-agent@latest/dist/vue-file-agent.css" />
@endpush
