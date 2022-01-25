<template>
    <div class="container-fluid">
        <header-component title="Notificaciones"></header-component>
        
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-right">
                    <a class="dropdown-toggle arrow-none card-drop" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a href="javascript:void(0);" @click="markAsRead()" class="dropdown-item">
                            Marcar todas como leídas
                        </a>
                    </div>
                </div>
                <h4 class="header-title mb-3">Actividades recientes</h4>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-hover mb-0">
                        <tbody>
                            <tr v-for="(notification, key) in notifications" :key="notification.id" :class="notification.read ? '' : 'not-read'" class="cursor-pointer">
                                <td @click="toDeliveryView(notification.delivery, notification.id)">
                                    <div class="d-flex align-items-left">
                                        <img class="me-2 rounded-circle" :src="/storage/+notification.avatar" width="40" alt="Generic placeholder image">
                                        <div>
                                            <h5 class="mt-0 mb-1">{{ notification.title }} <small class="fw-normal ms-3">{{ notification.date }}</small></h5>
                                            <span class="font-13">{{ notification.text }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td @click="toDeliveryView(notification.delivery, notification.id)">
                                    <span class="text-muted font-13">Envío ID #</span> <br>
                                    <p class="mb-0">{{ notification.delivery }}</p>
                                </td>
                                <td class="table-action" style="width: 50px;">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle arrow-none card-drop" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a v-if="!notification.read" href="javascript:void(0);" @click="markAsRead(notification.id)" class="dropdown-item">Marcar como leída</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" @click="deleteItem(notification.id, key)" class="dropdown-item">Eliminar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>                        
                        </tbody>
                    </table>
                    <infinite-loading @infinite="infiniteHandler" spinner="waveDots">
                        <div slot="no-more">No hay mas datos :)</div>
                        <div slot="no-results">No hay resultados :(</div>
                        <div slot="error" slot-scope="{ trigger }">
                            Error interno, click <a href="javascript:;" @click="trigger">aquí</a> para reintentar o intenta <a href="javascript:;" @click="reload">refrescar</a> para reiniciar sesión.
                        </div>
                    </infinite-loading>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let auth_user = document.head.querySelector('meta[name="user"]').content;

    import InfiniteLoading from 'vue-infinite-loading';
    import { mapMutations } from 'vuex';

    export default {
        components: {
            InfiniteLoading
        },
        mounted() {
            // Envento de escucha de pusher
            window.Echo.channel('notification-status')
                .listen('NotificationsPushEvent', (notification) => {
                    
                    // Se obtiene la data de la notificación en formato JSON
                    var detail = JSON.parse(notification.data);

                    // Se verifica si el id del usuario logueado es el mismo del receptor de la notificación
                    if (this.user_id == detail.receipter_id) {

                        // Se agrega la nueva notificación al modelo notifications
                        this.notifications.unshift({
                            id: notification.id,
                            title: detail.title,
                            text: detail.description,
                            url: '/delivery/' + notification.notifiable_id,
                            delivery: notification.notifiable_id,
                            time: notification.time,
                            date: notification.date,
                            read: notification.read_at,
                            avatar: detail.sender_avatar
                        });
                    }
                }
            );
        },
        data() {
            return {
                user_id: JSON.parse(auth_user).id,
                notifications: [],
                baseURL: '/notifications/',
                page: 1,
                state: null
            }
        },
        methods: {
            //Cargo los datos inicialmente usando scroll infinito
            infiniteHandler($state) {
                this.state = $state;
                let vm = this;

                axios.get(this.baseURL + 'get', {params: {page: this.page}}).then(
                    solve => {
                        let noti = solve.data.notifications.data;

                        if (noti.length > 0) {
                            this.page += 1;
                            $.each(noti, function(key, value) {
                                let detail = JSON.parse(value.data);

                                // Se agrega la nueva notificación al modelo notifications
                                vm.notifications.push({
                                    id: value.id,
                                    title: detail.title,
                                    text: detail.description,
                                    url: '/delivery/' + value.notifiable_id,
                                    delivery: value.notifiable_id,
                                    time: value.time,
                                    date: value.date,
                                    read: value.read_at,
                                    avatar: detail.sender_avatar
                                });

                            });
                            $state.loaded();
                        } else {
                            $state.complete();
                        }
                    }).catch(() => {
                    this.state.error();
                });
            },
            // Recargar pagina
            reload() {
                window.location.reload();
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
            // Eliminar notificación específica
            deleteItem(id, index) {
                axios.delete(this.baseURL + 'delete/' + id).then(
                    solve => {
                        if(solve.data.message == 'deleted') {
                            this.notifications.splice(index, 1);
                            this.decrement(1);
                        }
                    }
                )
            },
            // Redireccionar a vista de Delivery
            toDeliveryView(id, notification) {
                // Llamado a función encargada de marcar como leída
                this.markAsRead(notification);

                // Se hace push a la ruta de vista de envío
                this.$router.push({ name: 'delivery.show', params: { id: id } });
            },
            // Se importan las mutaciones...
            ...mapMutations(['decrement', 'setCountNotifications'])
        }
    };
</script>

<style>
    .not-read {
        background: #CEE0FF;
    }
</style>
