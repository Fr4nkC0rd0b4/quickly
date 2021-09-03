<template>
    <li class="dropdown notification-list">
        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <i class="mt-3 fa fa-bell-o fa-2x"></i>
            <span class="badge badge-danger" v-if="notifications.length > 0">{{notifications.length}}</span>
        </a>
    	<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">
            <!-- item-->
            <div class="dropdown-item noti-title">
                <h5 class="m-0">
                    <span class="float-right">
                        <a href="#" class="text-dark">
                            <small>Clear All</small>
                        </a>
                    </span>Notification
                </h5>
            </div>

            <div style="max-height: 230px;" data-simplebar>
                <!-- item-->
                <a v-for="notification in notifications" href="#" class="dropdown-item notify-item">
                    <div class="notify-icon bg-primary">
                        <i class="mdi mdi-comment-account-outline"></i>
                    </div>
                    <p class="notify-details">{{ notification.description }}
                        <small class="text-muted">1 min ago</small>
                    </p>
                </a>
            </div>

            <!-- All-->
            <a href="#" class="dropdown-item text-center text-primary notify-item notify-all">
                View All
            </a>

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

        data(){
            return{
                notifications: []
            }
        },

        mounted() {
            // console.log("Component mounted")
            // window.Echo.channel('pizza-tracker.' + this.delivery_id)
            window.Echo.channel('delivery-status')
                .listen('NotificationsPushEvent', (delivery) => {
                    if (this.user_id == delivery.user_id) {
                    this.notifications.unshift({
                        description: 'Order ID: ' + delivery.id + ' updated',
                        url: '/delivery/' + delivery.id,
                        time: new Date()
                    })
                }
            });
        },
    };
</script>