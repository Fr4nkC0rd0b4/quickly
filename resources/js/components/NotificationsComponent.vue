<template>
    <li class="dropdown notification-list">
        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <i class="mt-3 fa fa-bell-o fa-2x"></i>
            <span class="badge badge-danger" v-if="count > 0">{{ count }}</span>
        </a>
    	<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">
            <!-- item-->
            <div class="dropdown-item noti-title">
                <h5 class="m-0">
                    <span class="float-right">
                        <a href="javascript:void(0);" @click="markAsRead()" class="text-dark">
                            <small>Marcar como leídas</small>
                        </a>
                    </span>Notificaciones
                </h5>
            </div>

            <div style="max-height: 230px;" data-simplebar="init">
                <div class="simplebar-wrapper" style="margin: 0px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                                style="height: auto; overflow: hidden scroll;">
                                <div class="simplebar-content" style="padding: 0px;">
                                    
                                    <!-- item-->
                                    <router-link v-for="notification in notifications" :key="notification.id" :to="notification.url" class="dropdown-item notify-item" :class="notification.read ? '' : 'not-read'">
                                        <div v-if="notification.avatar" class="notify-icon">
                                            <img :src="/storage/+notification.avatar" class="img-fluid rounded-circle" alt="profile-image">
                                        </div>
                                        <div v-else class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">{{ notification.title +' '+ notification.text }}
                                            <small class="text-muted">{{ notification.time }}</small>
                                        </p>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: auto; height: 390px;"></div>
                </div>
            </div>

            <!-- All-->
            <router-link to="/spa/notifications" class="dropdown-item text-center text-primary notify-item notify-all">
                Ver todas
            </router-link>

        </div>
    </li>
</template>
<script>

    import VueTimeago from 'vue-timeago'

    Vue.use(VueTimeago, {
        name: 'Timeago', // Component name, `Timeago` by default
        locale: 'en', // Default locale
        // We use `date-fns` under the hood
        // So you can use all locales from it
        locales: {
            'zh-CN': require('date-fns/locale/zh_cn'),
            ja: require('date-fns/locale/ja')
        }
    })

    export default {
        props: ['user_id'],

        data() {
            return {
                baseURL: '/notifications/',
                notifications: [],
                count: 0,
            }
        },

        mounted() {
            this.getNotifications();

            window.Echo.channel('notification-status')
                .listen('NotificationsPushEvent', (notification) => {
                    
                    // Se obtiene la data de la notificación en formato JSON
                    var detail = JSON.parse(notification.data);

                    // Se verifica si el id del usuario logueado es el mismo del receptor de la notificación
                    if (this.user_id == detail.receipter_id) {

                        // Se agrega la nueva notificación al modelo notifications
                        this.notifications.unshift({
                            title: detail.title,
                            text: detail.description,
                            url: '/spa/delivery/' + notification.notifiable_id,
                            time: notification.time,
                            read: notification.read_at,
                            avatar: detail.sender_avatar
                        });

                        // Se muestra la alerta toastr
                        toastr.options =
                        {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.success(detail.title + ' ' + detail.description);
                    }
                }
            );
        },

        methods: {
            getNotifications() {
                let vm = this;
                axios.get(this.baseURL + 'get').then(
                    solve => {
                        let noti = solve.data.notifications.data;

                        $.each(noti, function(key, value) {
                            let detail = JSON.parse(value.data);

                            // Se agrega la nueva notificación al modelo notifications
                            vm.notifications.push({
                                title: detail.title,
                                text: detail.description,
                                url: '/spa/delivery/' + value.notifiable_id,
                                time: value.time,
                                read: value.read_at,
                                avatar: detail.sender_avatar
                            });

                        });
                    
                        this.count = solve.data.not_reads;
                    }
                );
            },

            markAsRead() {
                axios.get(this.baseURL + 'mark-as-read').then(
                    solve => {
                        let response = solve.data;

                        if(response == 'done') {
                            $.each(this.notifications, function(key, value) {
                                value.read = 1;
                            });

                            this.count = 0;
                        } 
                    }
                )
            }
        }
    };
</script>

<style>
    .not-read {
        background: #CEE0FF;
    }
</style>
