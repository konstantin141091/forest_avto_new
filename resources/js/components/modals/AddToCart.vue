<template>
    <div class="notification">
        <transition-group
                name="messages"
                class="messages-list"
                tag="div"
        >
            <div
                    class="notification__content"
                    v-for="message in messages"
                    :key="message.id"
            >
                <p class="content__text">{{ message.name }}</p>
            </div>
        </transition-group>

    </div>
</template>

<script>
  export default {
    name: "AddToCart",
    props: {
      messages: {
        type: Array,
        default: () => {
          return []
        }
      }
    },
    methods: {
      hideNotification() {
        if (this.messages.length) {
          setTimeout(() => {
            this.messages.splice(this.messages.length - 1, 1)
          }, 1500)
        }
      }
    },
    watch: {
      messages() {
        this.hideNotification()
      }
    },
    mounted() {
      this.hideNotification()
    }
  }
</script>

<style lang="scss" scoped>
    .notification {
        position: fixed;
        top: 175px;
        right: 30px;
        z-index: 100;

        &__content {
            padding: 16px;
            border-radius: 5px;
            color: #FFFFFF;
            background: #D63838;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
    }

    .messages {
        &-enter {
            transform: translateX(120px);
            opacity: 0;
        }

        &-enter-active {
            transition: all .6s ease;
        }

        &-enter-to {
            opacity: 1;
        }

        &-leave {
            height: 50px;
            opacity: 1;
        }

        &-leave-active {
            transition: all .6s ease;
        }

        &-leave-to {
            height: 0;
            transform: translateX(120px);
            opacity: 0;
        }

        &-move {
            transition: transform .6s ease;
        }
    }
</style>
