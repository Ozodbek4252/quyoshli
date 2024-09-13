@extends('dashboard.layouts.app')
@section('title', trans('admin.settings.title') . ' - ')
@section('links')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">
                        @lang('admin.settings.title')
                    </h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    @lang('admin.home')
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                @lang('admin.settings.title')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('admin.settings.title')</h4>
                </div>
                <div class="card-content">
                    <form class="form" action="{{ route('dashboard.settings.update', $setting->id) }}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-body">
                                <p>@lang('admin.all_fields_with')</p>
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="titleuz" required
                                                        class="form-control @error('title.ru') is-invalid @enderror"
                                                        value="{{ old('title.ru', $setting->title['ru']) }}"
                                                        name="title[ru]" placeholder="@lang('admin.settings.name')">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-italic"></i>
                                                    </div>
                                                    <label for="titleuz">@lang('admin.settings.name') RU *</label>

                                                    @error('title.ru')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="titleru" required
                                                        class="form-control @error('title.uz') is-invalid @enderror"
                                                        value="{{ old('title.uz', $setting->title['uz']) }}"
                                                        name="title[uz]" placeholder="@lang('admin.settings.name')">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-italic"></i>
                                                    </div>
                                                    <label for="titleru">@lang('admin.settings.name') UZ *</label>

                                                    @error('title.uz')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="phone" required
                                                class="form-control @error('phone.default') is-invalid @enderror"
                                                value="{{ old('phone.default', $setting->phone['default']) }}"
                                                name="phone[default]" placeholder="@lang('admin.settings.phone')">
                                            <div class="form-control-position">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <label for="phone">@lang('admin.settings.phone') *</label>

                                            @error('phone.default')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="phoneother" required
                                                class="form-control @error('phone.other') is-invalid @enderror"
                                                value="{{ old('phone.other', $setting->phone['other']) }}"
                                                name="phone[other]" placeholder="@lang('admin.settings.phone_other')">
                                            <div class="form-control-position">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <label for="phoneother">@lang('admin.settings.phone_other') *</label>

                                            @error('phone.other')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="email" required id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $setting->email) }}" name="email"
                                                placeholder="@lang('admin.settings.email')">
                                            <div class="form-control-position">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <label for="email">@lang('admin.settings.email') *</label>

                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" required name="address[ru]" id="label-textarea-ru" rows="3"
                                                        placeholder="@lang('admin.settings.address')">{{ old('address.ru', $setting->address['ru']) }}</textarea>
                                                    <label for="label-textarea-ru">@lang('admin.settings.address') RU *</label>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" name="address[uz]" required id="label-textarea" rows="3"
                                                        placeholder="@lang('admin.settings.address')">{{ old('address.uz', $setting->address['uz']) }}</textarea>
                                                    <label for="label-textarea">@lang('admin.settings.address') UZ *</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="landmark" required
                                                        class="form-control @error('landmark.ru') is-invalid @enderror"
                                                        value="{{ old('landmark.ru', $setting->landmark['ru']) }}"
                                                        name="landmark[ru]" placeholder="@lang('admin.settings.landmark')">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                    <label for="landmark">@lang('admin.settings.landmark') RU *</label>

                                                    @error('landmark.ru')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="landmarkru" required
                                                        class="form-control @error('landmark.uz') is-invalid @enderror"
                                                        value="{{ old('landmark.uz', $setting->landmark['uz']) }}"
                                                        name="landmark[uz]" placeholder="@lang('admin.settings.landmark')">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                    <label for="landmarkru">@lang('admin.settings.landmark') UZ *</label>

                                                    @error('landmark.uz')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="telegram" required
                                                class="form-control @error('socials.telegram') is-invalid @enderror"
                                                value="{{ old('socials.telegram', $setting->socials['telegram']) }}"
                                                name="socials[telegram]" placeholder="@lang('admin.settings.telegram')">
                                            <div class="form-control-position">
                                                <i class="fa fa-telegram"></i>
                                            </div>
                                            <label for="telegram">@lang('admin.settings.telegram') *</label>

                                            @error('socials.telegram')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="facebook" required
                                                class="form-control @error('socials.facebook') is-invalid @enderror"
                                                value="{{ old('socials.facebook', $setting->socials['facebook']) }}"
                                                name="socials[facebook]" placeholder="@lang('admin.settings.facebook')">
                                            <div class="form-control-position">
                                                <i class="fa fa-facebook"></i>
                                            </div>
                                            <label for="facebook">@lang('admin.settings.facebook') *</label>

                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="instagram" required
                                                class="form-control @error('socials.instagram') is-invalid @enderror"
                                                value="{{ old('socials.instagram', $setting->socials['instagram']) }}"
                                                name="socials[instagram]" placeholder="@lang('admin.settings.instagram')">
                                            <div class="form-control-position">
                                                <i class="fa fa-instagram"></i>
                                            </div>
                                            <label for="instagram">@lang('admin.settings.instagram') *</label>

                                            @error('socials.instagram')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="youtube" required
                                                class="form-control @error('socials.youtube') is-invalid @enderror"
                                                value="{{ old('socials.youtube', !empty($setting->socials['youtube']) ? $setting->socials['youtube'] : '') }}"
                                                name="socials[youtube]" placeholder="Youtube">
                                            <div class="form-control-position">
                                                <i class="fa fa-youtube"></i>
                                            </div>
                                            <label for="youtube">@lang('admin.settings.youtube') *</label>

                                            @error('socials.youtube')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="okru" required
                                                class="form-control @error('socials.okru') is-invalid @enderror"
                                                value="{{ old('socials.okru', !empty($setting->socials['okru']) ? $setting->socials['okru'] : '') }}"
                                                name="socials[okru]" placeholder="OK.RU">
                                            <div class="form-control-position">
                                                <i class="fa fa-odnoklassniki"></i>
                                            </div>
                                            <label for="okru">OK.RU *</label>

                                            @error('socials.okru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" required name="keywords[ru]" id="label-keywords-ru" rows="3"
                                                        placeholder="@lang('admin.settings.address')">{{ old('keywords.ru', $setting->keywords['ru']) }}</textarea>
                                                    <label for="label-keywords-ru">@lang('admin.settings.keywords') RU *</label>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" required name="keywords[uz]" id="label-keywords" rows="3"
                                                        placeholder="@lang('admin.settings.keywords')">{{ old('keywords.uz', $setting->keywords['uz']) }}</textarea>
                                                    <label for="label-keywords">@lang('admin.settings.keywords') UZ *</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" required name="description[ru]" id="label-textarea-ru" rows="3"
                                                        placeholder="@lang('admin.settings.description')">{{ old('description.ru', $setting->description['ru']) }}</textarea>
                                                    <label for="label-description-ru">@lang('admin.settings.description') RU *</label>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 float-left">
                                                <fieldset class="form-label-group">
                                                    <textarea class="form-control" required name="description[uz]" id="label-textarea" rows="3"
                                                        placeholder="@lang('admin.settings.description')">{{ old('description.uz', $setting->description['uz']) }}</textarea>
                                                    <label for="label-description">@lang('admin.settings.description') UZ *</label>
                                                </fieldset>
                                            </div>

                                            <div class="col-6">
                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="on_credit"
                                                            @if ($setting->on_credit == 1) checked @endif
                                                            value="1">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                        <span class="">в кредит</span>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-6">
                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="buy_one"
                                                            @if ($setting->buy_one == 1) checked @endif
                                                            value="1">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                        <span class="">Купить в один клик</span>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-12 mt-2">
                                                <h3>Управления блоками</h3>

                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="permissions[news]"
                                                            @if ($setting->permissions['news'] == true) checked @endif
                                                            value="1">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                        <span class="">Блок новости</span>
                                                    </div>
                                                </fieldset>

                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="permissions[middle_banner]"
                                                            @if ($setting->permissions['middle_banner'] == true) checked @endif
                                                            value="1">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                        <span class="">Баннеры середине</span>
                                                    </div>
                                                </fieldset>

                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="permissions[special_block]"
                                                            @if ($setting->permissions['special_block'] == true) checked @endif
                                                            value="1">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                        <span class="">Специальные предложения</span>
                                                    </div>
                                                </fieldset>

                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="permissions[popular_categories]"
                                                            @if ($setting->permissions['popular_categories'] == true) checked @endif
                                                            value="1">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                        <span class="">Популярная категория</span>
                                                    </div>
                                                </fieldset>

                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="permissions[brands]"
                                                            @if ($setting->permissions['brands'] == true) checked @endif
                                                            value="1">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                        <span class="">Бренды</span>
                                                    </div>
                                                </fieldset>

                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="permissions[lider_products]"
                                                            @if ($setting->permissions['lider_products'] == true) checked @endif
                                                            value="1">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                        <span class="">Лидеры продаж</span>
                                                    </div>
                                                </fieldset>

                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="permissions[popular_products]"
                                                            @if ($setting->permissions['popular_products'] == true) checked @endif
                                                            value="1">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                        <span class="">Популярный продукты</span>
                                                    </div>
                                                </fieldset>

                                                <fieldset>
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="permissions[new_products]"
                                                            @if ($setting->permissions['new_products'] == true) checked @endif
                                                            value="1">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>

                                                        <span class="">Новинки</span>
                                                    </div>
                                                </fieldset>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="links1" required
                                                class="form-control @error('links.one') is-invalid @enderror"
                                                value="{{ old('links.1', !empty($setting->links['one']) ? $setting->links['one'] : '') }}"
                                                name="links[one]" placeholder="Ссылка на: Рассрочка онлайн за 1 минуту">
                                            <div class="form-control-position">
                                                <i class="fa fa-link"></i>
                                            </div>
                                            <label for="links1">Ссылка на: Рассрочка онлайн за 1 минуту *</label>

                                            @error('links.one')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="links2" required
                                                class="form-control @error('links.two') is-invalid @enderror"
                                                value="{{ old('links.two', !empty($setting->links['two']) ? $setting->links['two'] : '') }}"
                                                name="links[two]" placeholder="Ссылка на: Самовывоз через 15 минут">
                                            <div class="form-control-position">
                                                <i class="fa fa-link"></i>
                                            </div>
                                            <label for="links2">Ссылка на: Самовывоз через 15 минут *</label>

                                            @error('links.two')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="links3" required
                                                class="form-control @error('links.three') is-invalid @enderror"
                                                value="{{ old('links.three', !empty($setting->links['three']) ? $setting->links['three'] : '') }}"
                                                name="links[three]" placeholder="Ссылка на: Гарантия низкой цены">
                                            <div class="form-control-position">
                                                <i class="fa fa-link"></i>
                                            </div>
                                            <label for="links3">Ссылка на: Гарантия низкой цены *</label>

                                            @error('links.three')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="links4" required
                                                class="form-control @error('links.4') is-invalid @enderror"
                                                value="{{ old('links.four', !empty($setting->links['four']) ? $setting->links['four'] : '') }}"
                                                name="links[four]" placeholder="Ссылка на: Бонусная программа Quyoshli">
                                            <div class="form-control-position">
                                                <i class="fa fa-link"></i>
                                            </div>
                                            <label for="links4">Ссылка на: Бонусная программа Alistore *</label>

                                            @error('links.four')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-label-group position-relative has-icon-left">
                                            <input type="text" id="links5" required
                                                class="form-control @error('links.5') is-invalid @enderror"
                                                value="{{ old('links.five', !empty($setting->links['five']) ? $setting->links['five'] : '') }}"
                                                name="links[five]" placeholder="Ссылка на: Быстрая и бережная доставка">
                                            <div class="form-control-position">
                                                <i class="fa fa-link"></i>
                                            </div>
                                            <label for="links5">Ссылка на: Быстрая и бережная доставка *</label>

                                            @error('links.five')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>



                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="col-12 mb-0">
                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit"
                                            class="btn btn-primary mr-1 mb-1 waves-effect waves-light btn-icon">
                                            <i class="feather icon-save"></i> @lang('admin.save')
                                        </button>
                                    </div>

                                    <div class="col-9">
                                        <a href="{{ route('dashboard') }}"
                                            class="btn btn-danger mr-1 mb-1 waves-effect waves-light btn-icon pull-right">
                                            <i class="feather icon-x-circle"></i> @lang('admin.cancel')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
