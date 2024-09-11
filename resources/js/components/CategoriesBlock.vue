<template>
    <ul class="nav">
        <li class="nav-item checkout">
            <a href="/stocks" class="dropbtn"><span v-html="$t('vue.cat_sales')"></span></a>
        </li>
        <li class="nav-item" v-for="(category, index) in categories" @mouseover="category.hover = true" @mouseleave="category.hover = false">
            <a :href="'/category/' + category.slug" class="dropbtn">
                <span>
                    {{ getName(category.name) }}
                </span>
            </a>
            <i class="fal fa-chevron-down"></i>
            <div class="nav-item-content" v-if="category.hover"> <!--v-if="category.hover"-->
                <div class="container">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 mb-lg-3 mb-1" v-for="(parent, index) in category.parents" v-if="parent.published">
                            <h3 class="nav-item-content__title">
                                <img v-if="parent.image" :src="'/' + parent.image">
                                <a :href="'/category/' + category.slug + '/' + parent.slug">
                                    {{ getName(parent.name) }}
                                </a>
                                <i class="fal fa-plus"></i>
                            </h3>
                            <div class="nav-item-content__toggle">
                                <a v-for="(child, index) in parent.parents" :href="'/category/' + category.slug + '/' + parent.slug + '/' + child.slug" v-if="child.published">
                                    {{ getName(child.name) }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            categoriesData: {}
        },

        data() {
            return {
                categories: this.categoriesData
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

                // console.log(value);
                return value;

            },
        }
    }
</script>

<style scoped>

</style>
