@extends('dashboard.layouts.app')
@section('title', trans('admin.posts.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.posts.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.posts.title') {{ $lang }}
                            </li>
                            {{--                            <li class="breadcrumb-item active">Fixed Layout--}}
                            {{--                            </li>--}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row" id="table-head">
        <div class="col-md-12 mb-1">
            @can('create', 'posts')
                <a href="{{ route('dashboard.post.store', $lang) }}" class="btn btn-icon btn-success float-right">
                    <i class="feather icon-plus"></i> @lang('admin.add')
                </a>
            @endcan
        </div>
        <div class="col-12">

            <div class="card">

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" width="50">ID</th>
                                <th scope="col" width="50">@lang('admin.posts.image')</th>
                                <th scope="col">@lang('admin.posts.name')</th>
                                <th scope="col">@lang('admin.posts.views')</th>
                                <th scope="col">@lang('admin.posts.type.title')</th>
                                <th scope="col" class="text-right">@lang('admin.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($posts) == 0)
                                <tr>
                                    <td class="text-center" colspan="4">
                                        @lang('admin.no_data')
                                    </td>
                                </tr>
                            @endif
                            @foreach($posts as $post)
                                <tr class="bg {{ $post->topped ? 'bg-light' : '' }}">
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>
                                        <img src="/{{ $post->getImage() }}" width="100%" alt="">
                                    </td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->views }}</td>
                                    <td>@lang("admin.posts.type.{$post->type}")</td>
                                    <td class="text-right">
                                        @can('update', 'posts')
                                            <a href="{{ route('dashboard.post.update', [$lang, $post->id]) }}" class="btn btn-sm btn-success btn-icon" data-toggle="tooltip" data-original-title="@lang('admin.edit')">
                                                <i class="feather icon-edit"></i>
                                            </a>
                                        @endcan

                                        @can('delete', 'posts')
                                            <a href="{{ route('dashboard.post.delete', $post->id) }}" class="btn btn-sm btn-danger btn-icon" data-toggle="tooltip" data-original-title="@lang('admin.delete')">
                                                <i class="feather icon-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{ $posts->links() }}
        </div>
    </div>
@endsection
