<template>
    <div>
        <div class="m-1">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" @click="changeLang" id="ru" data-toggle="tab" href="#RU" aria-selected="true">RU</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="changeLang" id="uz" data-toggle="tab" href="#UZ"  aria-selected="false">UZ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="changeLang" data-toggle="tab" href="#all" aria-selected="false">Все</a>
                </li>
            </ul>
            <ul class="nav nav-tabs" v-if="filter.lang" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" @click="changeType" id="mobile" data-toggle="tab" href="#RU" aria-selected="true">Мобильный</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="changeType" id="desktop" data-toggle="tab" href="#UZ"  aria-selected="false">Компьютер</a>
                </li>
            </ul>
            <ul class="nav nav-tabs" v-if="filter.type" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" @click="changePlacement" id="top" data-toggle="tab" href="#RU" aria-selected="true">Верхний</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="changePlacement" id="middle" data-toggle="tab" href="#UZ"  aria-selected="false">Нижний</a>
                </li>
            </ul>
        </div>
        <div class="table-responsive">
            <table class="table mb-0" :key="0">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" width="50">ID</th>
                    <th scope="col" width="50">{{ $t('admin.slider.image') }}</th>
                    <th scope="col">{{ $t('admin.slider.name') }}</th>
                    <th scope="col">{{ $t('admin.slider.position') }}</th>
                    <th scope="col" class="text-right">{{ $t('admin.actions') }}</th>
                </tr>
                </thead>
                <tbody v-if="sliders.length === 0">
                    <tr>
                        <td class="text-center" colspan="4">
                            {{ $t('admin.no_data') }}
                        </td>
                    </tr>
                </tbody>
                <draggable v-else v-model="sliders" tag="tbody">
                    <tr v-for="slider in sliders" :key="slider.id" v-if="(!filter.lang || filter.lang === slider.language) && (!filter.type || filter.type === slider.type) && (!filter.placement || filter.placement === slider.placement)">
                        <th scope="row">
                            {{ slider.id }}
                        </th>
                        <td>
                            <img :src="`/${slider.image}`" width="100%" alt="">
                        </td>
                        <td>
                            <i v-if="!slider.published" class="fa fa-info-circle text-danger" data-toggle="tooltip" data-original-title="$t('admin.no_publish')"></i>
                            {{ slider.name }}
                        </td>
                        <td>
                            {{ slider.position }}
                        </td>
                        <td class="text-right">
                            <a v-if="role.permissions.sliders.update" :href="`/dashboard/sliders/update/${slider.id}`" class="btn btn-sm btn-success btn-icon" data-toggle="tooltip" :data-original-title="$t('admin.edit')">
                                <i class="feather icon-edit"></i>
                            </a>

                            <a v-if="role.permissions.sliders.delete" :href="`/dashboard/sliders/delete/${slider.id}`" class="btn btn-sm btn-danger btn-icon" data-toggle="tooltip" :data-original-title="$t('admin.delete')">
                                <i class="feather icon-trash"></i>
                            </a>
                        </td>
                    </tr>
                </draggable>
            </table>
            <div class="card-body">
                <button class="btn btn-primary" @click="save">
                    <i class="fa fa-save"></i> Сохранить
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable'

export default {
    name: "SliderView",
    components: {
        draggable
    },
    props: {
        slidersData: {},
        role: {},
    },
    data() {
        return {
            sliders: this.slidersData,
            filter: {
                lang: null,
                type: null,
                placement: null,
            },
        }
    },
    // mounted() {
    //     console.log(this.sliders)
    // },
    methods: {
        changeLang(event) {
            let lang = event.target.getAttribute('id')
            this.filter.lang = lang
            if (!lang) {
                this.filter.type = null
                this.filter.placement = null
            }
        },
        changeType(event) {
            this.filter.type = event.target.getAttribute('id')
        },
        changePlacement(event) {
            this.filter.placement = event.target.getAttribute('id')
        },

        changePosition() {
            for (let i = 0; i < this.sliders.length; i++) {
                let position = i + 1
                this.sliders[i].position = i + 1;
            }
        },

        save() {
            this.changePosition()
            const form = new FormData()

            for (let i = 0; i < this.sliders.length; i++) {
                let slider = this.sliders[i]
                form.append(`sliders[${i}][id]`, slider.id)
                form.append(`sliders[${i}][position]`, slider.position)
            }

            axios.post('/dashboard/sliders/position', form)
        }
    }
}
</script>

<style scoped>

</style>
