<template>
  <div>
   <section class="section-news">
    <div class="container">
        <h2 class="section-title"><a title="Open another news" href="/blog/news">{{ $t('vue.news.news_title') }}</a></h2>
        <!-- News on desktop -->
        <div class="row mt-3 outer-row" v-if="!mobile">
            <div class="col-lg-5" v-if="topPost">
                <News :post-data="topPost" />
            </div>

            <div class="col-lg-7 mt-lg-0 mt-3" >
                <div class="row inner-row">
                    <div class="col-md-4 col-sm-6 mb-md-0 mb-3" v-for="(post, index) in postsData" :key="index">
                        <News :post-data="post" />
                    </div>
                </div>
            </div>
        </div>

        <NewsSlider :posts-data="postsSlider" v-if="mobile" />

    </div>
    </section>
  </div>
</template>

<script>
import News from "./News";
import NewsSlider from './NewsSlider';
import { isMobileOnly } from 'mobile-device-detect';

export default {
    props: ['postsData', 'topPost'],

    data() {
        return {
            mobile: isMobileOnly ? true : false,
            postsSlider: this.postsData
        };
    },
    components: {
        News,
        NewsSlider
    },

    mounted() {
        this.setPostData();
    },

    methods: {
        setPostData() {
            this.postsSlider.unshift(this.topPost);
        }
    }
};
</script>

<style lang="scss" scoped>
</style>
