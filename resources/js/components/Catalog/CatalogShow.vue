<template>
    <section :class="products.length === 0 ? 'section-categories no-product-section' : 'section-categories'">
        <div class="container">
            <h1 class="section-title">
                {{ getName(category.name) }}
            </h1>

            <div  class="my-form my-form__checkout my-form__countBy mb-3 d-block d-md-none">
                <div class="my-form__group d-flex flex-row justify-content-end">
                    <p class="mr-3">{{ $t('vue.catalog.view_by') }}</p>
                    <select @change="SendFilterParams" v-model="page_products" class="custom-select">
                        <option value="12">12</option>
                        <option value="24">24</option>
                        <option value="48">48</option>
                    </select>
                </div>
            </div>

            <!-- Catalog on Mobile -->
            <div class="catalog-on-mobile" v-if="mobile">
                <ul class="outer-ul" :class="menu">

                    <li class="catalog" v-if="categories.length > 0">
                        {{ $t('vue.catalog.catalog_title') }} <i class="fas fa-caret-down"></i>
                        <ul class="inner-ul">
                            <li v-for="(category, index) in categories" v-if="category.published" :key="index">
                                <a :href="category.link">
                                    {{ getName(category.name) }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="filtr" v-if="characteristics.length > 0">
                        {{ $t('vue.catalog.catalog_filter') }} <i class="fas fa-caret-down"></i>
                    </li>

                    <ul class="inner-ul filtr-inner-ul" v-if="characteristics.length > 0">

                        <form action="#" @submit.prevent="SendFilterParams">
                            <div class="categories">

                                <div class="card" v-if="characteristics.length > 0" v-for="(char, index) in characteristics" :key="index">
                                    <div class="card-header">
                                        <a class="card-link" data-toggle="collapse" :href="'#collapse-'+ char.id">
                                            {{ getName(char.name) }}
                                        </a>
                                    </div>
                                    <div :id="'collapse-'+ char.id" class="collapse show" :data-parent="'#collapse-'+ char.id">
                                        <div class="card-body">
                                            <div class="card-content brand">
                                                <div class="custom-control custom-checkbox" v-for="(attr, indexx) in char.attributes" :key="indexx">
                                                    <input type="checkbox" class="custom-control-input" v-model="filters"  :id="'check'+char.id+indexx" name="filter" :value="{id: char.id, name: char.name, type: char.type, attribute: attr}">
                                                    <label class="custom-control-label" :for="'check'+char.id+indexx" v-if="char.type === 'checkbox'">
                                                        <span v-if="attr === 'true'">
                                                            {{ $t('app.exist') }}
                                                        </span>
                                                        <span v-if="attr === 'false'">
                                                            {{ $t('app.no') }}
                                                        </span>
                                                    </label>

                                                    <label class="custom-control-label" :for="'check'+char.id+indexx" v-else>
                                                        {{ attr }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="category-buttons pb-2 mt-4" v-if="characteristics.length > 0">
                                    <button type="submit" class="my-btn my-btn__apply my-3 apply_mobile" >{{ $t('vue.catalog.catalog_accept') }}</button>
                                    <button type="button" @click="removeAllFilter" class="my-btn my-btn__cancel my-3">{{ $t('vue.catalog.catalog_reset') }}</button>
                                </div>
                            </div>
                        </form>
                    </ul>

                    <li class="view">
                        {{ $t('vue.catalog.view_by') }} <i class="fas fa-caret-down"></i>
                        <ul class="inner-ul">
                            <li><a :class="orderby === 'all' ? 'active' : ''" @click="orderByChange('all')" href="#javascript:">{{ $t('vue.catalog.view_by_all') }}</a></li>
                            <li><a :class="orderby === 'new' ? 'active' : ''" @click="orderByChange('new')" href="#javascript:">{{ $t('vue.catalog.new') }}</a></li>
                            <li><a :class="orderby === 'cheap' ? 'active' : ''" href="javascript:"  @click="orderByChange('cheap')">{{ $t('vue.catalog.view_by_cheap') }}</a></li>
                            <li><a :class="orderby === 'expensive' ? 'active' : ''" href="javascript:"  @click="orderByChange('expensive')">{{ $t('vue.catalog.view_by_expensive') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div :class="categories.length > 0 || characteristics.length > 0 ? 'row row-outer' : 'row-outer'" >
                <div v-if="!mobile && categories.length > 0 || !mobile && characteristics.length > 0" class="col-md-4 col-lg-3">

                    <form action="#" @submit.prevent="SendFilterParams" class="h-100 d-md-block d-none">
                        <div class="categories sticky-top">
                            <div :class="characteristics.length === 0 ? 'card border-bottom-0' : 'card'" v-if="categories.length > 0">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapse-1111">
                                         {{ $t('vue.catalog.catalog_title') }}
                                    </a>
                                </div>
                                <div id="collapse-1111" class="collapse show" data-parent="#collapse-1111">
                                    <div class="card-body">
                                        <div class="card-content category">
                                            <ul>
                                                <li v-for="(category, index) in categories" v-if="category.published" :key="index">
                                                    <a :href="category.link">
                                                        {{ getName(category.name) }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card" v-if="characteristics.length > 0" v-for="(char, index) in characteristics" :key="index">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" :href="'#collapse-'+ char.id">
                                        {{ getName(char.name) }}
                                    </a>
                                </div>
                                <div :id="'collapse-'+ char.id" class="collapse show" :data-parent="'#collapse-'+ char.id">
                                    <div class="card-body">
                                        <div class="card-content brand">
                                            <div class="custom-control custom-checkbox" v-for="(attr, indexx) in char.attributes" :key="indexx">
                                                <input type="checkbox" class="custom-control-input" v-model="filters"  :id="'check'+char.id+indexx" name="filter" :value="{id: char.id, name: char.name, type: char.type, attribute: attr}">
                                                <label class="custom-control-label" :for="'check'+char.id+indexx" v-if="char.type === 'checkbox'">
                                                    <span v-if="attr === 'true'">
                                                        {{ $t('app.exist') }}
                                                    </span>
                                                    <span v-else>
                                                         {{ $t('app.no') }}
                                                    </span>
                                                </label>

                                                <label class="custom-control-label" :for="'check'+char.id+indexx" v-else>
                                                    {{ attr }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="category-buttons pb-2 mt-4" v-if="characteristics.length > 0">
                                <button type="submit" class="my-btn my-btn__apply my-3" >{{ $t('vue.catalog.catalog_accept') }}</button>
                                <button type="button" @click="removeAllFilter" class="my-btn my-btn__cancel my-3">{{ $t('vue.catalog.catalog_reset') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div :class="categories.length > 0 || characteristics.length > 0 ? 'col-md-8 col-lg-9' : 'col-12'">
                    <div class="d-md-block d-none" v-if="products.length > 0">
                        <div class="d-flex justify-content-between">
                            <ul class="sorting">
                                <li class="sorting-item"><a :class="orderby === 'all' ? 'active' : ''" @click="orderByChange('all')" href="#javascript:">{{ $t('vue.catalog.view_by_all') }}</a></li>
                                <li class="sorting-item"><a :class="orderby === 'new' ? 'active' : ''" @click="orderByChange('new')" href="#javascript:">{{ $t('vue.catalog.new') }}</a></li>
                                <li class="sorting-item"><a :class="orderby === 'cheap' ? 'active' : ''" href="javascript:"  @click="orderByChange('cheap')">{{ $t('vue.catalog.view_by_cheap') }}</a></li>
                                <li class="sorting-item"><a :class="orderby === 'expensive' ? 'active' : ''" href="javascript:"  @click="orderByChange('expensive')">{{ $t('vue.catalog.view_by_expensive') }}</a></li>
                            </ul>

                            <div class="my-form my-form__checkout my-form__countBy">
                                <div class="my-form__group">
                                    <select @change="SendFilterParams" v-model="page_products" class="custom-select">
                                        <option disabled selected>{{ $t('vue.catalog.view_byy') }}</option>
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="48">48</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="selected-tags" v-if="filters.length > 0">
                            <ul>
                                <li v-for="(attr, index) in filters" :key="index">
                                    <span v-if="attr.attribute === 'true'">
                                        {{ getName(attr.name) }}: {{ $t('app.exist') }}
                                    </span>
                                    <span v-else-if="attr.attribute === 'false'">
                                         {{ getName(attr.name) }}: {{ $t('app.no') }}
                                    </span>

                                    <span v-else>
                                        {{ attr.attribute }}
                                    </span>
                                    <span class="close" @click="removeFilter(index)"><i class="fal fa-times"></i></span>
                                </li>

                                <li class="clear-all" @click="removeAllFilter" id="clear_all">{{ $t('vue.catalog.catalog_reset') }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row row-inner">

                        <div v-if="products.length === 0">
                           {{ $t('app.no_category_product') }}
                        </div>

                        <div class="aksiya w-100 mt-0" v-if="categories.length === 0 && characteristics.length === 0">
                            <product-item v-for="(product, index) in products" :key="index" :product="product" :login-info="loginInfo"/>
                        </div>

                        <div v-if="categories.length > 0 || characteristics.length > 0" class="col-md-6 col-lg-4 col-xl-3 my-2" v-for="(product, index) in products">
                            <product-item :product="product" :login-info="loginInfo"></product-item>
                        </div>
                    </div>

                    <paginate v-if="product_count > 12"
                            v-model="page_current"
                            :pageCount="pageCount"
                            :clickHandler="PageCallBack"
                            :prevText="'<i class=\'far fa-long-arrow-left \'></i>'"
                            :nextText="'<i class=\'far fa-long-arrow-right \'></i>'"
                            :container-class="'pagination d-flex justify-content-center align-items-center flex-wrap mt-4'"
                            :page-class="'page-item'"
                            :page-link-class="'page-link'"
                            :next-class="'page-item'"
                            :prev-class="'page-item'"
                            :prev-link-class="'page-link'"
                            :next-link-class="'page-link'">
                    </paginate>

                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Product from '../Products/Product';
    import { isMobileOnly } from "mobile-device-detect";
    import Paginate from 'vuejs-paginate'

    export default {
        created() {
            this.MenuLiCount();
            if (localStorage.url_filter == window.location) {
                this.filters = JSON.parse(localStorage.filter);
            } else {
                localStorage.removeItem('url_filter');
                localStorage.removeItem('filter');
            }

            let url = new URL(window.location.href);
            let page = url.searchParams.get("page");

            this.page_current = page;

            if (this.page_current > 1) {
                this.SendFilterParams()
            }
        },

        props: {
            productsData: {},
            categoriesData: {},
            loginInfo: {},
            characteristicsData: {},
            categoryData: {},
            page: {}
        },

        components: {
            'product-item': Product,
            'paginate': Paginate
        },

        data() {
            return {
                products: this.productsData.data,
                categories: this.categoriesData,
                characteristics: this.characteristicsData,
                category: this.categoryData,

                filters: [],
                orderby: 'all',

                menu: 'three-li',
                mobile: isMobileOnly ? true : false,

                pageCount: this.productsData.last_page,
                page_current: 1,
                product_count: this.productsData.total,
                paginate: false,

                page_products: 12,
            }
        },

        watch: {
            filters: function (newVal) {
                this.SendFilterParams();
                localStorage.filter = JSON.stringify(this.filters);
            }
        },

        methods: {
            getName(name) {
                const lang = document.documentElement.lang.substr(0, 2);
                let value = '';

                if (lang) {
                    switch(lang){
                        case "ru":
                            value = name.ru;
                            break;
                        case "uz":
                            value = name.uz;
                            break;
                    }
                } else {
                    value = name.ru;
                }

                return value;
            },

            PageCallBack(pageNum) {
                this.page_current = pageNum;
                window.scrollTo(0,0);
                this.SendFilterParams();
            },

            async SendFilterParams() {
                const fields = {
                    order_by: this.orderby,
                    filter: this.filters,
                    page: this.page,
                    paginate: this.page_products
                };

                const { data } = await axios.post('/category/filter/' + this.category.slug + '?page='+ this.page_current,  fields);

                localStorage.url_filter = window.location;

                window.history.pushState({page: 1}, 'page', '?page=' + this.page_current);
                // window.document.title = response.data.post.name

                this.pageCount = data.page;
                this.products = data.products;
                this.product_count = data.count;
            },

            removeFilter(index) {
                this.filters.splice(index, 1);
            },

            orderByChange(type) {
                this.orderby = type;

                this.SendFilterParams()
            },

            MenuLiCount() {
              if (this.categories.length > 0 && this.characteristics.length > 0) {
                  this.menu = 'three-li';
              } else if (this.categories.length === 0 ^ this.characteristics.length === 0) {
                  this.menu = 'two-li';
              } else {
                  this.menu = 'one-li';
              }
            },

            removeAllFilter() {
                this.filters = [];
            }
        }
    }
</script>

<style scoped>

</style>
