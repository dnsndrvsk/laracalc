<!--suppress ALL -->
<template>
    <v-app>
        <v-content>
            <v-container fluid>
                <v-layout row justify-center>
                    <v-flex xs4>
                        <form>
                            <v-text-field
                                    v-model="postFormFields.name"
                                    type="text"
                                    value=""
                                    label="Ваше имя"
                                    append-icon="remove_red_eye"
                                    :error-messages="errors.collect('Имя')"
                                    v-validate="'required|max:10'"
                                    data-vv-name="Имя"
                                    required
                            ></v-text-field>

                            <v-text-field
                                    label="Номер договора"
                                    type="text"
                                    value=""
                                    v-model="postFormFields.contract"
                            ></v-text-field>

                            <v-text-field
                                    v-model="postFormFields.phone"
                                    label="Ваш телефон"
                                    type="tel"
                                    :error-messages="errors.collect('Телефон')"
                                    v-validate="'required'"
                                    data-vv-name="Телефон"
                                    required
                            ></v-text-field>

                            <v-text-field
                                    v-model="postFormFields.title"
                                    type="text"
                                    value=""
                                    label="Заголовок"
                                    :error-messages="errors.collect('Заголовок')"
                                    v-validate="'required|max:15'"
                                    data-vv-name="Заголовок"
                                    required
                            ></v-text-field>


                            <v-text-field
                                    v-model="postFormFields.desc"
                                    label="Ваш отзыв"
                                    :error-messages="errors.collect('Ваш отзыв')"
                                    v-validate="'required|max:500'"
                                    data-vv-name="Ваш отзыв"
                                    multi-line
                                    required
                            >

                            </v-text-field>

                            <div class="input-group__input">

                                <star-rating v-model="postFormFields.votes"
                                             :increment="0.5"
                                             :max-rating="5"
                                             :star-size="30"
                                             :border-width="1"
                                             :show-rating="false"
                                             border-color="#999"
                                             inactive-color="#000"
                                             active-color="#FFD700"

                                >
                                </star-rating>
                                <h3>{{postFormFields.votes}} из 5</h3>

                            </div>

                            <div class="v-reviews__form__content-drag">
                                <vue2-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"
                                               @vdropzone-success="fileOverwrite_Overwrite"></vue2-dropzone>
                                <!--                 @vdropzone-file-added="fileOverwrite_GetFile"
                                               @vdropzone-success="fileOverwrite_Overwrite"-->
                            </div>

                            <div class="v-reviews__form__content-input">
                                <v-btn color="info" type="button" @click="checkForm">Оставить отзыв</v-btn>
                            </div>
                        </form>
                    </v-flex>

                </v-layout>
            </v-container>
            <v-container grid-list-md>
                <v-layout row wrap>
                    <v-flex xs4 offset-xs4 v-for="(item,key) in reviews.pagination_items" :key="key">
                        <v-card>
                            <v-container fluid>
                                <v-layout row>
                                    <v-flex xs3>
                                        <div>
                                            <div class="headline">{{item.title}}</div>
                                            <div>{{item.name}}</div>
                                            <div>
                                                <star-rating :rating=parseInt(item.votes)
                                                             :increment="0.5"
                                                             :max-rating="5"
                                                             :star-size="10"
                                                             :border-width="1"
                                                             :show-rating="false"
                                                             :read-only="true"
                                                             border-color="#999"
                                                             inactive-color="#000"
                                                             active-color="#FFD700"></star-rating>
                                            </div>
                                            <div v-if="item.contract">
                                                № договора: {{item.contract}}
                                            </div>
                                        </div>
                                    </v-flex>
                                    <v-flex xs9>
                                        <div>{{item.desc}}</div>
                                    </v-flex>

                                </v-layout>
                                <v-layout row justify-space-starts>
                                    <div v-for="(image_src,key) in item.images" v-if="key<5">
                                        <v-avatar :size="100"
                                                  class="grey lighten-4">
                                            <img :src="item.name == 'Роман' ? image_src : 'http://via.placeholder.com/100x100'"/>
                                        </v-avatar>
                                    </div>
                                </v-layout>
                            </v-container>
                        </v-card>
                    </v-flex>
                </v-layout>
                <v-layout row justify-space-between>
                    <v-flex xs3 offset-xs5>
                        <vue-paginator :resource_url="reviews.resource_url"
                                       @update="updateResource"
                                       :options="reviews.options"
                        >
                        </vue-paginator>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>


    <!--<div class="v-reviews__content">-->
    <!--{{dropzoneOptions.prevFile}}-->
    <!--</div>-->


    <!--<ol>-->
    <!--<li v-for="item in reviews.pagination_items">-->
    <!--<div>Заголовок: {{ item.title }}</div>-->
    <!--<div>Имя: {{ item.name }}</div>-->
    <!--<div>Рейтинг:-->

    <!--</div>-->
    <!--<div>Дата: {{item.created_at.date}}</div>-->
    <!--<div>Картинки:-->
    <!--<div v-for="image in item.images" style="display: inline-block;margin-right: 10px">-->
    <!--&lt;!&ndash;<img :src="image" :alt="item.name" width="200" height="120">&ndash;&gt;-->
    <!--</div>-->
    <!--</div>-->


</template>

<script>
    import StarRating from 'vue-star-rating'
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.css'
    import VueResource from 'vue-resource'
    import VuePaginator from 'vuejs-paginator'

    import Vuetify from 'vuetify'
    import 'vuetify/dist/vuetify.css'
    import colors from 'vuetify/es5/util/colors'

    Vue.use(Vuetify, {
        theme: {
            primary: '#1867C0',
            secondary: colors.grey.darken1,
            accent: colors.shades.black,
            error: colors.red.accent3
        }
    })

    import VeeValidate, {Validator} from 'vee-validate';
    import messagesRU from 'vee-validate/dist/locale/ru.js';

    Validator.localize('ru', messagesRU);
    Vue.use(VeeValidate);

    import MaskedInput from 'vue-masked-input'


    export default {
        data: function () {
            return {
                reviews: {
                    resource_url: '//laracalc.loc/api/reviews',
                    pagination_items: false,
                    options: {
                        remote_current_page: 'meta.current_page',
                        remote_last_page: 'meta.last_page',
                        remote_next_page_url: 'links.next',
                        remote_prev_page_url: 'links.prev',
                        next_button_text: 'Вперед',
                        previous_button_text: 'Назад',
                        page_text: 'Страница',
                        of_text: 'из',
                    }
                },

                dropzoneOptions: {
                    url: '//laracalc.loc/api/reviews_images/create',
                    thumbnailWidth: 150,
                    uploadMultiple: false,
                    maxFiles: 5,
                    maxFilesize: 2,
                    autoProcessQueue: true,
                    prevFile: false,
                    addRemoveLinks: true,
                    acceptedFiles: '.png,.jpg,.gif,.bmp,.jpeg',
                    dictDefaultMessage: 'Нажмите на область или перетяните в нее фотографии, чтобы прикрепить их к отзыву',
                    dictRemoveFile: 'Удалить',
                    dictMaxFilesExceeded: 'Превышен лимит фотографий'
                },

                postFormFields: {
                    name: '',
                    contract: '',
                    phone: '',
                    title: '',
                    desc: '',
                    votes: 4.5,
                    files: {},
                    errors: {}
                },
                postFormRules: {
                    name: [],
                }


            }
        },
        mounted() {

        },
        methods: {
            fileOverwrite_GetFile() {
                // if(this.dropzoneOptions.prevFile) {
                //     this.$refs.myVueDropzone.removeAllFiles();
                // }
            },
            fileOverwrite_Overwrite(file) {
                var files = new Array;
                this.$refs.myVueDropzone.getAcceptedFiles().forEach(function (item) {
                    files.push(item.xhr.response);
                });
                this.postFormFields.files = files;
            },
            updateResource(data) {
                this.reviews.pagination_items = data
            },
            postData: function () { // Создаем отзыв
                axios.post('//laracalc.loc/api/reviews/create', this.postFormFields)
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            checkForm: function () {
                this.$validator.validateAll().then(result => {
                    if (!result) {
                        console.log('false');
                        return
                    }

                    this.postData();
                    this.resetForm();

                }).catch((error) => {
                    console.log(error);
                });
            },
            resetForm: function () {
                Object.assign(
                    this.postFormFields.name,
                    this.postFormFields.phone,
                    this.postFormFields.contract,
                    this.postFormFields.title,
                    this.postFormFields.desc
                );
            }
        },
        watch: {},
        filters: {
            json(value) {
                return JSON.stringify(value, null, 2)
            }
        },
        components: {
            StarRating,
            vue2Dropzone,
            VueResource,
            VuePaginator,
            MaskedInput
        }
    }
</script>

<style>
    .v-reviews {

    }
</style>
