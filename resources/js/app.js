import './bootstrap';

import Vue from 'vue';

import CKEditor from '@ckeditor/ckeditor5-vue';
import Multiselect from 'vue-multiselect'
import Vue2Filters from 'vue2-filters'

import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';
import Moment from 'vue-moment';

Vue.use(Moment);


//Dashboard
import ProductAdd from './components/ProductStore';
import ProductEdit from './components/ProductEdit';
import CompilationStore from './components/Compilation/Store';
import CompilationUpdate from './components/Compilation/Update';
import OrderUpdate from './components/Order/Update';
import CategoryStore from './components/Dashboard/Category/Store';
import CategoryUpdate from './components/Dashboard/Category/Update';
import CategoryIndex from './components/Dashboard/Category/Index';

import VueFileAgent from 'vue-file-agent';
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css';
import ProductPreviewImport from "./components/ProductPreviewImport";
import Logs from "./components/Dashboard/Logs";
import Statics from "./components/Dashboard/Statics";
import SliderView from "./components/Slider/SliderView";


Vue.use(VueFileAgent);


Vue.component('product-add', ProductAdd);
Vue.component('product-edit', ProductEdit);

Vue.component('order-edit', OrderUpdate);
Vue.component('category-store', CategoryStore);
Vue.component('category-update', CategoryUpdate);
Vue.component('category-list', CategoryIndex);

Vue.component('compilation-store', CompilationStore);
Vue.component('compilation-update', CompilationUpdate);
Vue.component('product-preview', ProductPreviewImport);
Vue.component('logs-block', Logs);

Vue.component('dashboard-statics', Statics);

Vue.component('multiselect', Multiselect);
Vue.component('slider-view', SliderView)

Vue.use(CKEditor);

Vue.use(Vue2Filters);

Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);

Vue.config.devtools = true

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

const app = new Vue({
    el: '#app',
    i18n
});
