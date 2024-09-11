<template>
    <div class="media msg">
        <div class="media-body">
            <small class="pull-right time">
                <i class="fas fa-calendar-alt mr-2"></i> {{ comment.created_at }}
            </small>
            <h5 class="media-heading">{{ comment.first_name }}</h5>
            <small v-html="comment.body"></small>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['commentData'],

        data() {
            return {
                comment: this.commentData
            }
        }
    }
</script>

<style scoped>

</style>
