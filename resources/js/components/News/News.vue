<template>
  <div class="news">
    <a :href="'/blog/news/' + postData.id + '-' + postData.slug" class="news-img">
      <img :src="'/' + postData.image" :alt="postData.name" />
    </a>
    <div class="news-content">
      <div class="news-date">
        {{ postData.date }}
      </div>
      <h3 class="news-title">
        <a :href="'/blog/news/' + postData.id + '-' + postData.slug">
          {{ postData.name }}
        </a>
      </h3>
      <p class="news-subtitle" v-html="postData.content.replace(/<\/?[^>]+>/ig, '')">

      </p>

      <a :href="'/blog/news/' + postData.id + '-' + postData.slug" class="news-link">
        {{ $t('vue.news.news_read_more') }}
        <i class="fal fa-chevron-right ml-2"></i>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props: ['postData'],

  methods: {
      htmlStrip() {

      }
  }
};
</script>

<style lang="scss" scoped>
</style>
