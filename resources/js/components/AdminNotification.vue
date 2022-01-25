
<template>


 <li class="nav-item dropdown new-style">
        <a class="nav-link" data-toggle="dropdown" href="#" >
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" v-if="unreadCount > 0">{{ unreadCount }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right new-style-dropdown">
          <span class="dropdown-item dropdown-header" v-if="unreadCount > 0" > {{ unreadCount }} Notifications </span>
          <div class="dropdown-divider"></div>
          
        <a v-for="item in unread" :key="item.id" :href="`/admin/fatwas`" @click="readNotifications(item)" class="dropdown-item habiba">

            <i class="fas fa-question-circle qus-icon" ></i> 
             <div class="noti-style">
             <span class="float-right text-muted text-sm">  يوجد لديك طلب فتوى جديد من  
                 <span style="color:#045fa7;display:block">{{ item.data.name  }}</span>
             </span>
             <span class="float-right text-muted text-sm" style="direction:ltr!important">{{ item.data.created_at }}</span>
             </div>
          </a>
          
          <div class="dropdown-divider"></div>
        <!-- <a href="/admin/fatwas" class="dropdown-item dropdown-footer">See All Notifications</a> -->
        </div>
      </li> 


      

    
</template>



<script>
    export default {
        data: function () {
            return {
                read: {},
                unread: {},
                unreadCount: 0
            }
        },

        created: function () {
            this.getNotifications();
            let adminId = $('meta[name="adminId"]').attr('content');
            Echo.private('App.User.' + adminId)
                .notification((notification) => {
                    this.unread.unshift(notification);
                    this.unreadCount++;
                });
        },


        methods: {
            getNotifications() {
                axios.get('/admin/notifications/get').then(res => {
                    this.read = res.data.read;
                    this.unread = res.data.unread;
                    this.unreadCount = res.data.unread.length;
                }).catch(error => Exception.handle(error))
            },
            readNotifications(notification) {
                axios.post('/admin/notifications/read', {id: notification.id}).then(res => {
                    this.unread.splice(notification,1);
                    this.read.push(notification);
                    this.unreadCount--;
                })
            }
        }


    }
</script>