<template>
    <div class="row">
        <div class="col-12">
            <div
                class="card"
                style="
                    border-radius: 0;
                    box-shadow: 0 -1px 4px 0 rgb(0 0 0 / 15%);
                "
            >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Категория</label>
                                <select
                                    v-model="category"
                                    @change="handleMainCategory"
                                    class="form-control"
                                >
                                    <option :value="null">---</option>
                                    <option
                                        v-for="category in mainCategories"
                                        :value="category"
                                    >
                                        {{ category.category }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Подкатегория</label>
                                <select
                                    v-model="subCategory"
                                    @change="handleSubCategory"
                                    class="form-control"
                                >
                                    <option :value="null">---</option>
                                    <option
                                        v-for="category in subCategories"
                                        :value="category"
                                    >
                                        {{ category.category }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Tree
                :data="categories"
                @change="Change"
                draggable="draggable"
                cross-tree="cross-tree"
            >
                <div slot-scope="{ data, store }">
                    <template v-if="!data.isDragPlaceHolder">
                        <div class="d-flex justify-content-start">
                            <b
                                v-if="data.children &amp;&amp; data.children.length"
                                @click="store.toggleOpen(data)"
                            >
                                <i
                                    :class="
                                        data.open
                                            ? 'fa fa-minus-square'
                                            : 'fa fa-plus-square'
                                    "
                                ></i>
                                &nbsp;
                            </b>
                            <span>
                                <b>ID: {{ data.id }} </b>
                                {{ data.category }}
                            </span>

                            <div class="ml-auto">
                                <a
                                    :href="
                                        '/dashboard/categories/update/' +
                                        data.id
                                    "
                                    class="btn-primary btn btn-icon btn-sm"
                                >
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a
                                    :href="
                                        '/dashboard/categories/delete/' +
                                        data.id
                                    "
                                    onclick="return confirm('Вы действително хотите удалить')"
                                    class="btn-danger btn btn-icon btn-sm"
                                >
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </template>
                </div>
            </Tree>
            <div class="mt-2 mb-3">
                <button class="btn btn-primary" @click="SendForm">
                    <i class="fa fa-save"></i> Сохранить
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { DraggableTree } from "vue-draggable-nested-tree";

export default {
    props: {
        categoriesData: {},
    },

    components: {
        Tree: DraggableTree,
    },

    mounted() {
        console.log(this.categoriesData);
        this.Change();
    },

    data() {
        console.log(this.categoriesData);
        return {
            categories: this.categoriesData,
            mainCategories: this.categoriesData,
            subCategories: [],
            category: null,
            subCategory: null,
        };
    },

    methods: {
        async SendForm() {
            const formData = new FormData();
            for (var i = 0; i < this.categories.length; i++) {
                formData.append(
                    "categories[" + i + "][id]",
                    this.categories[i].id
                );
                formData.append(
                    "categories[" + i + "][position]",
                    this.categories[i].position
                );
                formData.append(
                    "categories[" + i + "][parent_id]",
                    this.categories[i].parent_id
                );
                if (this.categories[i].children.length > 0) {
                    for (
                        var c = 0;
                        c < this.categories[i].children.length;
                        c++
                    ) {
                        formData.append(
                            "categories[" + i + "][children][" + c + "][id]",
                            this.categories[i].children[c].id
                        );
                        formData.append(
                            "categories[" +
                                i +
                                "][children][" +
                                c +
                                "][position]",
                            this.categories[i].children[c].position
                        );
                        formData.append(
                            "categories[" +
                                i +
                                "][children][" +
                                c +
                                "][parent_id]",
                            this.categories[i].children[c].parent_id
                        );
                        if (
                            this.categories[i].children[c].children.length > 0
                        ) {
                            for (
                                var w = 0;
                                w <
                                this.categories[i].children[c].children.length;
                                w++
                            ) {
                                formData.append(
                                    "categories[" +
                                        i +
                                        "][children][" +
                                        c +
                                        "][children][" +
                                        w +
                                        "][id]",
                                    this.categories[i].children[c].children[w]
                                        .id
                                );
                                formData.append(
                                    "categories[" +
                                        i +
                                        "][children][" +
                                        c +
                                        "][children][" +
                                        w +
                                        "][position]",
                                    this.categories[i].children[c].children[w]
                                        .position
                                );
                                formData.append(
                                    "categories[" +
                                        i +
                                        "][children][" +
                                        c +
                                        "][children][" +
                                        w +
                                        "][parent_id]",
                                    this.categories[i].children[c].children[w]
                                        .parent_id
                                );
                            }
                        }
                    }
                }
            }

            const { data } = await axios.post(
                "/dashboard/categories/position",
                formData
            );

            if (data.status) {
                // window.location.href = "/dashboard/categories";
            }
        },

        Change() {
            for (var i = 0; i < this.categories.length; i++) {
                var num = i + 1;

                this.categories[i].position = num;
                this.categories[i].droppable = true;

                if (this.categories[i].children.length > 0) {
                    for (
                        var c = 0;
                        c < this.categories[i].children.length;
                        c++
                    ) {
                        var numm = c + 1;
                        this.categories[i].children[c].position = numm;
                        this.categories[i].children[c].parent_id =
                            this.categories[i].id;
                        this.categories[i].children[c].droppable = true;

                        if (
                            this.categories[i].children[c].children.length > 0
                        ) {
                            for (
                                var w = 0;
                                w <
                                this.categories[i].children[c].children.length;
                                w++
                            ) {
                                var nummm = w + 1;

                                this.categories[i].children[c].children[
                                    w
                                ].position = nummm;
                                this.categories[i].children[c].children[
                                    w
                                ].parent_id = this.categories[i].children[c].id;
                                this.categories[i].children[c].children[
                                    w
                                ].droppable = false;
                            }
                        }
                    }
                }
            }
        },

        handleMainCategory() {
            if (this.category) {
                this.categories = this.category.children;
                this.subCategories = this.category.children;
            } else {
                this.categories = this.categoriesData;
                this.subCategories = null;
            }
        },

        handleSubCategory() {
            if (this.subCategory) this.categories = this.subCategory.children;
            else this.categories = this.category.children;
        },
    },
};
</script>

<style scoped></style>
