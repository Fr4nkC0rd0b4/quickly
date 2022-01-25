<template>
    <li class="dropdown notification-list">
        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <i class="mt-3 fa fa-bell-o fa-2x"></i>
            <span class="badge badge-danger" v-if="count_notifications > 0">{{ count_notifications }}</span>
        </a>
    	<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">
            <!-- item-->
            <div class="dropdown-item noti-title">
                <h5 class="m-0">
                    <span class="float-right">
                        <a href="javascript:void(0);" @click="markAsRead()" class="text-dark">
                            <small>Marcar como leídas</small>
                        </a>
                    </span>
                    Notificaciones
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
                                    <div v-for="(notification, i) in notifications" :key="i"> 
                                        <a href="javascript:void(0);" @click="toDeliveryView(notification.delivery, notification.id)" class="dropdown-item notify-item" :class="notification.read ? '' : 'not-read'">
                                            <div v-if="notification.avatar" class="notify-icon">
                                                <img :src="/storage/+notification.avatar" class="img-fluid rounded-circle" alt="profile-image">
                                            </div>
                                            <div v-else class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                            <p class="notify-details">{{ notification.title +' '+ notification.text }}
                                                <small class="text-muted">{{ notification.time }}</small>
                                            </p>
                                        </a>
                                    </div>
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
    import { mapMutations, mapState } from 'vuex';

    export default {
        props: ['user_id'],

        data() {
            return {
                baseURL: '/notifications/',
                notifications: []
            }
        },

        mounted() {
            // Llamado a método de obtener notificaciones
            this.getNotifications();

            // Envento de escucha de pusher
            window.Echo.channel('notification-status')
                .listen('NotificationsPushEvent', (notification) => {
                    
                    // Se obtiene la data de la notificación en formato JSON
                    var detail = JSON.parse(notification.data);

                    // Se verifica si el id del usuario logueado es el mismo del receptor de la notificación
                    if (this.user_id == detail.receipter_id) {

                        // Se llama mutador que incrementa el número de las notificaciones no leídas
                        this.increment();

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
            // Metodo encargado de obtener las notificaciones específicas de un usuario
            getNotifications() {
                let vm = this;
                axios.get(this.baseURL + 'get').then(
                    solve => {
                        let noti = solve.data.notifications.data;

                        $.each(noti, function(key, value) {
                            let detail = JSON.parse(value.data);

                            // Se agrega la nueva notificación al modelo notifications
                            vm.notifications.push({
                                id: value.id,
                                title: detail.title,
                                text: detail.description,
                                url: '/spa/delivery/' + value.notifiable_id,
                                delivery: value.notifiable_id,
                                time: value.time,
                                read: value.read_at,
                                avatar: detail.sender_avatar
                            });

                        });
                    
                        this.setCountNotifications(solve.data.not_reads);
                    }
                );
            },
            // Marcar una o mas notificaciones como leídas
            markAsRead(id = null) {
                let vm = this;
                let fullURL = this.baseURL + 'mark-as-read/';

                if (id) {
                    fullURL = fullURL + id;
                }

                axios.get(fullURL).then(
                    solve => {
                        let response = solve.data;

                        if(response.status == 'success') {
                            $.each(this.notifications, function(key, value) {
                                if(id && id == value.id) {                                    
                                    value.read = 1;
                                } else if(!id) {
                                    value.read = 1;
                                }
                            });
                            vm.decrement(response.counter);
                        }
                    }
                );
            },
            // Redirecciona a vista de Delivery
            toDeliveryView(id, notification) {
                // Llamado a función encargada de marcar como leída
                this.markAsRead(notification);

                // Se hace push a la ruta de vista de envío
                this.$router.push({ name: 'delivery.show', params: { id: id } }).catch(()=>{});
            },
            // Se importan las mutaciones...
            ...mapMutations(['increment', 'decrement', 'setCountNotifications'])
        },
        computed: {
            ...mapState(['count_notifications'])
        }
    };
</script>

<style>
    .not-read {
        background: #CEE0FF;
    }
</style>
