<template>
  <div class="product">
    <div class="product-top">
       <div class="type" v-if="product.diffDate && product.isAvailable">NEW</div>
       <div class="discound" v-if="product.discountPrice > 0 && product.price_discount && product.isAvailable">
         {{ $t('vue.sale') }}
       </div>
       <div class="xit" v-if="product.leader_of_sales && product.isAvailable">{{ $t('vue.xit') }}</div>
      <div class="no-product" v-if="!product.isAvailable">{{ $t('vue.not_available') }}</div>
    </div>
    <a :href="'/product/show/' + product.id + '-' + product.slug" class="product-img">
      <img :src="'/' + product.poster_thumb" :class="!product.isAvailable ? 'no-product-img' : ''" :alt="getName(product.name)" />
    </a>
    <div class="product-category">
      <a  v-for="(category, index) in product.categories" :href="category.link">
        {{ getName(category.name) }}
      </a>
    </div>
    <h3 class="product-title">
      <a :href="'/product/show/' + product.id + '-' + product.slug">
          {{ getName(product.name) }}
      </a>
    </h3>
    <div class="product-price">
      <div class="old-price" v-if="product.price_discount">
        {{ product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}
      </div>
      <div class="new-price">
        {{ product.price_discount ? product.price_discount : product.price | number('0,0', { thousandsSeparator: ' ' }) }} {{ $t('app.sum') }}
      </div>
    </div>
    <div class="product-buttons">
      <div class="product-to_cart">

        <button v-if="product.isAvailable && !product.isCart" :class="product.isCart ? 'product-to_basket is-active' : 'product-to_basket'" @click="AddToCart(product)">
            <i class="far fa-shopping-basket"></i>
            <span>{{ $t('app.product.in_cart') }}</span>
            <div class="added-to-basket" v-html="$t('vue.favorite.added_to_basket')">

            </div>
        </button>

        <button v-if="product.isAvailable && product.isCart" data-target="#basket_modal" data-toggle="modal" :class="product.isCart ? 'product-to_basket is-active' : 'product-to_basket'" @click="AddToCart(product)">
          <i class="far fa-shopping-basket"></i>
          <span>{{ $t('app.product.in_cart') }}</span>

        </button>

<!--        <button class="product-to_compare">-->
<!--          <i class="far fa-balance-scale"></i>-->
<!--        </button>-->
      </div>

      <button class="product-to_favorite" data-target="#login" data-toggle="modal" v-if="!loginInfo">
        <i class="fas fa-heart"></i>
      </button>

      <button :class="product.isFavorite ? 'product-to_favorite is-active' : 'product-to_favorite'" @click="Favorite(product)" v-if="loginInfo">
        <i class="fas fa-heart"></i>
      </button>

    </div>

  </div>
</template>

<script>
export default {
  props: ['product', 'loginInfo'],


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

    async Favorite(product) {
      var field = document.getElementById("favorite-count");
      var count = field.value;

      if (product.isFavorite === false) {
        const { data } = await axios.get('/favorites/store/' + product.id);
        this.product.isFavorite = true;
        field.value = parseInt(count) + 1;
      } else {
        const { data } = await axios.get('/favorites/delete/' + product.id);
        this.product.isFavorite = false;
        field.value = parseInt(count) - 1;
      }
    },

    async AddToCart(product) {
      if (this.product.isCart){
        this.$eventBus.$emit('cart-preview');
        return;
      }
      const fields = {
        product_id: product.children.id,
        count: 1
      };

      const { data } = await axios.post('/cart/store', fields);

      if (data.status) {
        product.isCart = true;
        var basket = document.getElementById("basket-count");
        basket.value = data.count;
      }
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
