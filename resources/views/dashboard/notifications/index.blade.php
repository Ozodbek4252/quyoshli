@extends('dashboard.layouts.app')
@section('title', trans('admin.notifications.title'). ' - ')
@section('speedbar')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">@lang('admin.notifications.title')</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="{{ route('dashboard') }}">@lang('admin.home')</a>
                            </li>
                            <li class="breadcrumb-item active">
                                @lang('admin.notifications.title')
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


            <div class="card">
                <div class="card-content">
                    <form action="{{ route('dashboard.notifications.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <input type="text" name="title" class="form-control" placeholder="@lang('admin.brands.name')">

                            <input type="text" name="body" class="form-control mt-2" placeholder="@lang('admin.blog.body')">

                            <select class="form-control mt-2" name="lang">
                                <option value="ru" selected>RU</option>
                                <option value="uz">UZ</option>
                            </select>

                        </div>



                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-icon">
                                <i class="feather icon-send"></i> @lang('admin.send')
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-12">

            <div class="card">

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col" width="50">ID</th>
                                <th scope="col">@lang('admin.brands.name')</th>
                                <th scope="col">@lang('admin.blog.body')</th>
                                <th scope="col">@lang('admin.blog.lang')</th>
                                <th scope="col" class="text-right">@lang('admin.billing.date')</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($notifications) == 0)
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            @lang('admin.no_data')
                                        </td>
                                    </tr>
                                @endif

                                @foreach($notifications as $notification)
                                    <tr>
                                        <td>
                                            {{ $notification->id }}
                                        </td>

                                        <td>
                                            {{ $notification->title }}
                                        </td>

                                        <td>
                                            {{ $notification->body }}
                                        </td>

                                        <td>
                                            {{ $notification->language }}
                                        </td>

                                        <td class="text-right">
                                            {{ $notification->created_at->format('d.m.Y - H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{ $notifications->links() }}
        </div>
    </div>
@endsection
