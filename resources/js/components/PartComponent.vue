<template>
    <div class="parts">
        <div class="parts__img">
            <div class="img__container">
                <div class="img__box" id="boxImg">
                    <img :src="parts.image" alt="part">
                    <ul class="img__list">
                        <li class="img__position" v-for="(position) in parts.labels"
                            :class="'position-' + position.number" @click="activeCoordinates(position.number)">
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="parts__list">
            <add-to-cart :messages="messages"></add-to-cart>
            <div class="parts__item" v-for="(part) in parts.numbers">
                <h3>{{ part.name }}</h3>
                <div class="item__info" v-for="(product, index) in part.parts" :id="'product-' + product.positionNumber">
                    <div class="d-flex align-items-center">
                        <p class="item__position" @click="activeCoordinates(product.positionNumber)">{{ product.positionNumber }}</p>
                        <p class="item__code">{{ product.number }}</p>
                        <img src="https://img.icons8.com/metro/50/000000/copy.png" alt="img" class="item__copy"
                             @click="doCopy(product.number)">
                    </div>
                    <a class="item__btn" :href="url + '?artikul=' + product.number" target="_blank">
                            Найти
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import AddToCart from "./modals/AddToCart";
  export default {
    name: "PartComponent",
    components: {AddToCart},
    props: {
      parts: {
        required: true,
      },
      url: {
        required: true,
      }
    },
    data() {
      return ({
        messages: [],
        lastActiveCoordinates: false,
        test: null
      })
    },
    methods: {
      doCopy(code) {
        this.$copyText(code);
        let timeStamp = Date.now().toLocaleString();
        this.messages.unshift(
          {name: 'Артикул скопирован', id: timeStamp}
        )
      },

      activeCoordinates(number) {
        if (this.lastActiveCoordinates) {
          let positions = document.querySelectorAll('.position-' + this.lastActiveCoordinates);
          positions.forEach((pos) => {
            pos.classList.remove('img__position-border');
          });

          let product = document.getElementById('product-' + this.lastActiveCoordinates);
          product.style.paddingLeft = "0";
          product.style.borderLeft = "none";
        }

        let positions = document.querySelectorAll('.position-' + number);
        positions.forEach((pos) => {
          pos.classList.add('img__position-border');
        });

        let product = document.getElementById('product-' + number);
        product.style.paddingLeft = "5px";
        product.style.borderLeft = "solid 3px #D63838";
        window.scrollTo(0, product.offsetTop);

        this.lastActiveCoordinates = number;
      },

      updateWidth() {
        this.initPosition()
      },
      initPosition() {
        let wight = 760 / document.getElementById('boxImg').clientWidth;
        let height = 1112 / document.getElementById('boxImg').clientHeight;
        this.parts.labels.forEach((el) => {
          let positions = document.querySelectorAll('.position-' + el.number);
          positions.forEach((pos) => {
            pos.style.transform = "translate(" + (el['coordinate']['top']['x'] / wight - 3) + "px," + (el['coordinate']['top']['y'] / height - 3) + "px)";
            pos.style.width = (el['coordinate']['bottom']['x'] - el['coordinate']['top']['x']) / wight + 12 + "px";
            pos.style.height = (el['coordinate']['bottom']['y'] - el['coordinate']['top']['y']) / height + 12 + "px"
          });
        })
      }
    },
    mounted() {
      setTimeout(() => {
        this.initPosition()
      }, 3000);
    },
    created() {
      window.addEventListener('resize', this.updateWidth);
    },
  }
</script>

<style lang="scss" scoped>
    .parts {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 30px;
        &__img {
            max-width: 48%;
            width: 100%;
        }
        &__list {
            width: 48%;
        }
        &__item {
            border-bottom: solid 1px #E5E5E5;
            padding: 10px 0;
            & h3 {
                font-size: 18px;
            }
        }
    }

    .img {
        &__container {
            width: 100%;
            top: 16px;
            position: sticky;
            display: flex;
            justify-content: center;
        }
        &__box {
            display: inline-block;
            position: relative;
        }
        &__box img {
            max-width: 100%;
            max-height: 90vh;
            width: auto;
        }
        &__list {
            position: absolute;
            top: 0;
            left: 0;
            padding: 0;
            margin: 0;
            list-style: none;
        }
        &__position {
            display: block;
            cursor: pointer;
            /*border: solid 3px #D63838;*/
            border-radius: 10%;
            position: absolute;
        }
        &__position-border {
            border: solid 3px #D63838;
        }
    }

    .item {
        &__info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.1s;
        }
        &__btn {
            display: block;
            background-color: transparent;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            text-align: center;
            color: #D63838;
            border: 1px solid #D63838;
            border-radius: 5px;
            padding: 12px 20px;
            margin-left: 10px;
            cursor: pointer;
            transition: 0.3s;
        }
        &__btn:hover {
            color: #ffffff;
            background-color: #D63838;
        }
        &__position, &__code {
            margin-bottom: 0;
        }
        &__position {
            font-size: 12px;
            cursor: pointer;
            margin-right: 15px;
        }
        &__position:hover {
            color: #D63838;
        }
        &__code {
            font-size: 17px;
        }
        &__copy {
            width: 10%;
            margin-left: 15px;
            cursor: pointer;
            transition: 0.5s;
        }
        &__copy:hover {
            transform: scale(1.1);
        }
    }

    @media screen and (max-width: 768px) {
        .parts {
            flex-direction: column;
            align-items: center;
            &__img {
                max-width: 90%;
            }
            &__list {
                width: 100%;
                margin-top: 20px;
            }
            &__item {
                & h3 {
                    font-size: 15px;
                }
            }
        }
        .item {
            &__code {
                font-size: 14px;
            }
        }

    }
</style>
