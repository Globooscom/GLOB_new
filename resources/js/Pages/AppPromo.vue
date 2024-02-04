<script setup>
import '../../../public/styles/styles.css'
import '../../../public/styles/fonts.css'
import '../../../public/styles/adapt.css'
import '../../../public/styles/lowSection.css'
import '../../../public/styles/ForBuilders.css'
import '../../../public/styles/blockInfo.css'
import '../../../public/styles/watchvideo.css'
import '../../../public/styles/welcom.css'
import '../../../public/styles/help.css'
import '../../../public/styles/ForRealtors.css'
</script>

<template>
  <app-modal-auth :oLoginRealtor="openLoginRealtor" :oLoginDeveloper="openLoginDeveloper" @close-modal="closeModal"
    @open-modal-realtor="openModalRealtor" @open-modal-developer="openModalDeveloper" :language="language"
    :selectLanguage="selectLanguage" />

  <app-modal-register :oLoginRegister="openRegister" @close-modal="closeModalRegister" :language="language"
    :selectLanguage="selectLanguage" />

  <AppModalAfterRegister
    v-if="openAfterRegister"
    :message="message"
    @close-modal="closeModalAfterRegister"
    :language="language"
  />

  <new-header @login-realtor="openLoginRealtor = !openLoginRealtor"
    @login-developer="openLoginDeveloper = !openLoginDeveloper" @open-register="openRegister = !openRegister"
    @open-modal-choise="mobileModal = !mobileModal" @selectLanguage="choseLanguage" :user_info="userInfo"
    :language="language"></new-header>

  <app-modal-text :openModalText="openModalText"/>

  <div v-if="mobileModal" class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div
      class=" modal choise relative bg-white rounded-[12px] p-10   z-50 w-[30%] lg:w-[48%] md:w-[60%] sm:w-[90%] h-fit">
      <div class="relative   ">
        <div class="btns">
          <button class="login" v-on:click="openLoginRealtor = !openLoginRealtor, mobileModal = !mobileModal">{{
            language.main[21] }}</button>
          <button class="registr" v-on:click="openRegister = !openRegister, mobileModal = !mobileModal">{{ language.main[22]
          }}</button>
        </div>
      </div>
    </div>
    <div @click="mobileModal = !mobileModal" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>

  <section class="welcom">

    <div class="container">
      <h1>Сервис №1 для профессионалов рынка
        зарубежной недвижимости</h1>
      <div class="row-info">
        <div class="left">
          <div class="top">
            <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M25.5 44.3859L24.7828 43.5093C24.3047 42.8718 12.1125 28.6078 12.1125 20.0812C12.1125 12.6703 18.1687 6.69373 25.5 6.69373C32.8312 6.69373 38.8875 12.75 38.8875 20.0812C38.8875 28.6078 26.6953 42.9515 26.2172 43.5093L25.5 44.3859ZM25.5 8.52654C19.125 8.52654 14.025 13.7062 14.025 20.0015C14.025 26.6953 22.8703 38.0906 25.5 41.3578C28.1297 38.0906 36.975 26.775 36.975 20.0015C36.975 13.7062 31.875 8.52654 25.5 8.52654Z" fill="#255ECC"/>
              <path d="M25.5 25.1812C22.7109 25.1812 20.4 22.8703 20.4 20.0812C20.4 17.2921 22.7109 14.9812 25.5 14.9812C28.289 14.9812 30.6 17.2921 30.6 20.0812C30.6 22.8703 28.289 25.1812 25.5 25.1812ZM25.5 16.8937C23.7468 16.8937 22.3125 18.3281 22.3125 20.0812C22.3125 21.8343 23.7468 23.2687 25.5 23.2687C27.2531 23.2687 28.6875 21.8343 28.6875 20.0812C28.6875 18.3281 27.2531 16.8937 25.5 16.8937Z" fill="#255ECC"/>
            </svg>
            <h3>Турция</h3>
          </div>
          <div class="line">
            <span>Стамбул</span>
            <span>Аланья</span>
            <span>Анталья</span>
            <span>Мерсин</span>
          </div>
        </div>
        <div class="right">
          <div class="top">
            <h3>Soon</h3>
          </div>
          <div class="line">
            <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M19.5 33.9422L18.9516 33.2719C18.5859 32.7844 9.2625 21.8766 9.2625 15.3563C9.2625 9.68909 13.8937 5.11877 19.5 5.11877C25.1062 5.11877 29.7375 9.75003 29.7375 15.3563C29.7375 21.8766 20.4141 32.8453 20.0484 33.2719L19.5 33.9422ZM19.5 6.52034C14.625 6.52034 10.725 10.4813 10.725 15.2953C10.725 20.4141 17.4891 29.1281 19.5 31.6266C21.5109 29.1281 28.275 20.475 28.275 15.2953C28.275 10.4813 24.375 6.52034 19.5 6.52034Z" fill="#255ECC"/>
              <path d="M19.5 19.2563C17.3672 19.2563 15.6 17.4891 15.6 15.3563C15.6 13.2235 17.3672 11.4563 19.5 11.4563C21.6328 11.4563 23.4 13.2235 23.4 15.3563C23.4 17.4891 21.6328 19.2563 19.5 19.2563ZM19.5 12.9188C18.1594 12.9188 17.0625 14.0157 17.0625 15.3563C17.0625 16.6969 18.1594 17.7938 19.5 17.7938C20.8406 17.7938 21.9375 16.6969 21.9375 15.3563C21.9375 14.0157 20.8406 12.9188 19.5 12.9188Z" fill="#255ECC"/>
            </svg>
            <span>Бали</span>
            <span>Дубай</span>
            <span>Северный Кипр</span>
            <span>Грузия</span>
          </div>
        </div>
      </div>



    </div>
  </section>

  <section class="rowInfo">
    <div class="container">
      <div class="row-info">
        <div class="block">
          <h4>{{ count_house }} +</h4>
          <p>{{ language.main[34] }}</p>
        </div>
        <div class="block">
          <h4>{{ count_people }} + </h4>
          <p>{{ language.main[35] }}</p>
        </div>
        <div class="block">
          <h4>{{ count_flats }} +</h4>
          <p>{{ language.main[36] }}</p>
        </div>
      </div>
      <button>Зарегистрироваться бесплатно</button>
    </div>
  </section>


  <section class="grid-info">
    <div class="container">
      <h2>{{ language.main[37] }}</h2>
      <h3>{{ language.main[38] }}</h3>
      <h4>Онлайн сопровождение сделок "под ключ""</h4>
      <div class="grid-setka">
        <div class="slide" v-for="(slide, index) in slides"  :key="index">
<!--          <div class="slide-text">-->
<!--            <h5>{{ slide.title }}</h5>-->
<!--          </div>-->
          <div class="slide-info"   ref="slideInfoRef" :class="{ purple: slide.color === 1 }">
            <img v-if="index===0" src="../../../public/images/img/forRealtors/1.png">
            <img v-if="index===1" src="../../../public/images/img/forRealtors/2.png">
            <img v-if="index===2" src="../../../public/images/img/forRealtors/3.png">
            <img v-if="index===3" src="../../../public/images/img/forRealtors/4.png">
            <img v-if="index===4" src="../../../public/images/img/forRealtors/5.png">
            <img v-if="index===5" src="../../../public/images/img/forRealtors/6.png">
            <h5>{{ slide.infoTitle }}</h5>
          </div>
        </div>
      </div>
      <button>Зарегистрироваться бесплатно</button>
    </div>
  </section>



  <section class="grid-info">
    <div class="container">
      <h2>{{ language.main[52] }}</h2>
      <div class="grid-info-row">
        <div class="grid-setka two">
          <div  class="slide"   >
            <img   src="../../../public/images/img/forBuilders/1.png">
            <h5>{{ language.main[53] }}</h5>
          </div>
          <div class="slide"   >
            <img   src="../../../public/images/img/forBuilders/2.png">
            <h5> {{ language.main[54] }}</h5>
          </div>
          <div class="slide"  >
            <img   src="../../../public/images/img/forBuilders/3.png">
            <h5>{{ language.main[55] }}</h5>
          </div>
          <div class="slide"  >
            <img   src="../../../public/images/img/forBuilders/4.png">
            <h5>Получайте теплые лиды</h5>
            <button>Новинка</button>
          </div>
        </div>
        <div class="rightImg"></div>
      </div>

      <button>Добавить объект на платформу</button>
    </div>
  </section>


  <section class="lowSection">
    <div class="container">
      <div class="rowLowSecion">
        <div class="left">
          <h2>Скачайте приложение  globoos</h2>
          <div class="col-refs-prog">
            <img class="shtrich" src="https://s3-alpha-sig.figma.com/img/d519/8dd8/f1b8958dc8868c4d7bf9f9fec68fff2f?Expires=1707696000&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=SjJqpzVDmVHNWJSqjbQhcYSo~1HGsI4Bi0OQyX0EdfSVM7fRNAIBUgfQ076vn9Mal2LcQ9HGcQkgaTSUDzBQRdoawcAuW55q~bF5IqNK0cEcDStcb-kTRTg~9UfRjkGWxPB2Q8Fy~rDwe3htMpvrg~zPwpBVnOGZ0quvCa16xjhEm3K2hzgh8c8hsTx1wx8UhlNE~SI6Ok63hnl7IbKYo1sxvnyMMW4BiohPhWUMCJK-1p12syhT1Rg6Rb0XA916vijDb0STIiqPCccVPSupGcTU51MVV5YR81nJuT3euTW7zHcHITilRckj9UjmIfDtnt9kygWNucMDFcDW9xYO5Q__">
            <img class="platform" src="../../../public/images/img/lowSection/1.png"/>
          </div>
        </div>
        <div class="right">
          <h2>Свяжитесь с нашим  менеджером</h2>
          <div class="row-refs">
            <p>
              <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_0_127)">
                  <path d="M11 0.558594C5.23359 0.558594 0.558594 5.23359 0.558594 11C0.558594 13.1098 1.18594 15.0777 2.26445 16.7191L0.919531 21.2738L5.65039 19.9633C7.21445 20.9 9.04492 21.4371 11 21.4371C16.7664 21.4371 21.4414 16.7621 21.4414 10.9957C21.4414 5.23359 16.7664 0.558594 11 0.558594Z" fill="#25D366"/>
                  <path d="M16.7363 13.866C16.7234 13.7285 16.6418 13.6082 16.5172 13.5523C15.675 13.1656 14.8285 12.7789 13.9863 12.3922C13.8918 12.3492 13.7758 12.3707 13.707 12.4523L12.5641 13.7414C12.4738 13.8445 12.332 13.8789 12.2074 13.8273C11.6145 13.5824 10.8152 13.1699 10.0074 12.4738C9.04063 11.6445 8.47344 10.7551 8.15547 10.175C8.31445 10.0676 8.74844 9.74531 8.9418 9.14804C8.9418 9.14374 8.94609 9.13945 8.94609 9.13945C9.06641 8.76992 9.04063 8.37031 8.90742 8.00507C8.67969 7.39921 8.22422 6.22617 8.04805 6.0457C8.01797 6.01562 7.98359 5.98554 7.98359 5.98554C7.85469 5.86953 7.68711 5.80507 7.51094 5.79648C7.45078 5.79218 7.38633 5.79218 7.31758 5.79218C7.11992 5.78789 6.94375 5.78789 6.81484 5.80507C6.44961 5.85664 6.1832 6.10156 6.01563 6.30781C5.81367 6.55273 5.57305 6.91796 5.41406 7.39921C5.40117 7.44218 5.38828 7.48085 5.37539 7.52382C5.19922 8.13398 5.23359 8.7871 5.44414 9.38867C5.6418 9.95156 5.92969 10.6219 6.36367 11.3309C7.09844 12.5383 7.89766 13.2859 8.43906 13.7801C9.04922 14.343 9.80547 15.0348 11.0043 15.6105C12.1129 16.1434 13.1184 16.341 13.793 16.4227C14.068 16.4484 14.575 16.4527 15.1551 16.2336C15.4215 16.1305 15.6449 16.0059 15.8254 15.8727C16.3023 15.5332 16.6375 15.0219 16.7234 14.4461C16.7234 14.4418 16.7234 14.4375 16.7234 14.4332C16.7535 14.2141 16.7492 14.025 16.7363 13.866Z" fill="white"/>
                </g>
                <defs>
                  <clipPath id="clip0_0_127">
                    <rect width="22" height="22" fill="white"/>
                  </clipPath>
                </defs>
              </svg>
              <span>Написать Whatsapp</span>
            </p>
            <p>globoos.com@gmail.ru.ru</p>
          </div>
          <a href="#"><img class="logo" src="../../../public/images/img/header/Globoos.png"></a>
        </div>
      </div>
    </div>
  </section>


  <new-footer :language="language"></new-footer>
</template>

<script>
import AppHeader from '../Layouts/AppHeader.vue'
import AppFooter from "../Layouts/AppFooter.vue"
import AppModalAuth from "../Layouts/modal/AppModalAuth.vue"
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import AppModalRegister from "@/Layouts/modal/AppModalRegister.vue";
import NewHeader from "@/Components/NewsComponent/NewHeader.vue";
import NewFooter from "@/Components/NewsComponent/NewFooter.vue";
import AppModalText from "@/Layouts/modal/AppModalText.vue";
import { ref, onMounted } from 'vue';
import AppModalAfterRegister from "@/Layouts/modal/AppModalAfterRegister.vue";

export default {
  name: "AppPromo",
  props: [
    'count_flats',
    'count_house',
    'count_people',
    'error',
    'userInfo',
    'registration',
    'message',
    'builder',
    'language_select'
  ],
  watch: {
    language(item) {
      this.editObject();
    }
  },
  provide() {
    return {
      error: this.error,
    }
  },
  data() {
    return {
      openLoginRealtor: false,
      openLoginDeveloper: false,
      openRegister: false,
      openModalText: false,
      language: this.$ru,
      selectLanguage: 0,
      user: [],
      mobileModal: false,
      showToolAnimation:false,


      isMouseDown: false,
      startX: 0,
      scrollLeft: 0,
      step: 1,
      slides: [],
      forBuilders: {
        activeIndex: 0
      },
      welcomText: {},
      touchStartX: 0,
      touchMoveX: 0,
      openClient: computed(() => usePage().props.value.check),
      openAfterRegister: null,
    }
  },
  created() {

    if(this.language_select !== null) {
      this.selectLanguage = parseInt(this.language_select);
    }

    if (this.userInfo.length === 0) {
      this.user = null;
    } else {
      this.user = this.userInfo;
    }

    if (this.user !== null) {
      if (this.user.lang === 0) {
        this.language = this.$ru;
      } else if (this.user.lang === 1) {
        this.language = this.$en;
      } else if (this.user.lang === 2) {
        this.language = this.$tur;
      }
    } else {
      if (this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }
    }

    this.editObject();

    this.type()
  },
  mounted() {
    this.openAfterRegister = this.message !== null
    const showToolAnimation = ref(false);
    const slideInfoElement = this.$refs.slideInfoRef;

    const handleScroll = () => {
      if (slideInfoElement) {
        const rect = slideInfoElement.getBoundingClientRect();
        showToolAnimation.value = rect.top < window.innerHeight && rect.bottom > 0;
      }
    };
    window.addEventListener('scroll', handleScroll);
  },
  methods: {
    closeModalAfterRegister() {
      this.openAfterRegister = false;
    },
    handleMouseDown(e) {
      this.isMouseDown = true;
      this.startX = e.pageX - this.$refs.cont.offsetLeft;
      this.scrollLeft = this.$refs.cont.scrollLeft;
    },
    handleMouseLeave() {
      this.isMouseDown = false;
    },
    handleMouseUp(e) {
      this.isMouseDown = false;
      if (Math.abs(e.pageX - this.startX) >= 200) {
        this.animationChange();
      }
    },
    handleMouseMove(e) {
      if (!this.isMouseDown) return;
      e.preventDefault();
      const x = e.pageX - this.$refs.cont.offsetLeft;
      const walk = (x - this.startX) * 3;
      this.$refs.cont.scrollLeft = this.scrollLeft - walk;
    },
    animationChange() {
      this.step++;
      if (this.step > 5) {
        this.step = 1;
      }
      const slides = this.$refs.cont.querySelectorAll(".slide");
      slides.forEach((element) => {
        element.classList.remove("active");
        if (element.classList.contains(`slide${this.step}`)) {
          element.classList.add("active");
        }
      });
    },
    handleTouchStart(event) {
      this.touchStartX = event.touches[0].clientX;
    },
    handleTouchEnd() {
      const touchDistance = this.touchMoveX - this.touchStartX;
      if (Math.abs(touchDistance) >= 100) {
        if (touchDistance > 0) {
          // Свайп вправо
          this.step--;
          if (this.step < 1) {
            this.step = this.slides.length;
          }
        } else {
          // Свайп влево
          this.step++;
          if (this.step > this.slides.length) {
            this.step = 1;
          }
        }
      }
    },
    handleTouchMove(event) {
      this.touchMoveX = event.touches[0].clientX;
    },
    editObject() {
      this.slides = [
        {
          title: this.language.main[39],
          infoTitle: this.language.main[40],
          infoCount: "30",
          color: 0,
        },
        {
          title: this.language.main[43],
          infoTitle: this.language.main[44],
          infoCount: "",
          color: 1,
        },
        {
          title: this.language.main[45],
          infoTitle: this.language.main[46],
          infoCount: "400",
          color: 0,
        },
        {
          title: this.language.main[47],
          infoTitle: this.language.main[48],
          infoCount: "",
          color: 1,
        },
        {
          title: this.language.main[49],
          infoTitle: this.language.main[50],
          infoBtn: this.language.main[51],
          infoCount: null,
          color: 0,
        },
      ];

      this.welcomText = {
        texts: [this.language.main[27], this.language.main[68], this.language.main[26]],
        text: "",
        index: 0,
        letterIndex: 0,
        isDeleting: false,
      }
    },
    startDrag(e) {
      this.isMouseDown = true;
      this.startX = e.pageX - e.currentTarget.offsetLeft;
      this.scrollLeft = e.currentTarget.scrollLeft;
    },
    endDrag(e) {
      this.isMouseDown = false;
      if (Math.abs(e.pageX - this.startX) >= 200) {
        this.animationChange();
      }
    },
    drag(e) {
      if (!this.isMouseDown) return;
      e.preventDefault();
      const x = e.pageX - e.currentTarget.offsetLeft;
      const walk = (x - this.startX) * 3;
      e.currentTarget.scrollLeft = this.scrollLeft - walk;
    },
    animationChange() {
      this.step++;
      if (this.step > 5) {
        this.step = 1;
      }
    },
    hideBtn(event) {
      event.target.classList.add('hide');
    },
    showBtn(event) {
      setTimeout(() => {
        event.target.classList.remove('hide');
      }, 3000);
    },
    type() {
      const text = this.welcomText.texts[this.welcomText.index];
      if (this.welcomText.isDeleting) {
        this.welcomText.letterIndex--;
        if (this.welcomText.letterIndex == 0) {
          this.welcomText.isDeleting = false;
        }
      } else {
        this.welcomText.text = this.language.main[24] + ' ' + text.substring(0, this.welcomText.letterIndex + 1);
        this.welcomText.letterIndex++;
        if (this.welcomText.letterIndex == text.length) {
          this.welcomText.isDeleting = true;
          setTimeout(() => {
            this.welcomText.index++;
            if (this.welcomText.index == this.welcomText.texts.length) {
              this.welcomText.index = 0;
            }
          }, 1000);
        }
      }
      setTimeout(this.type, 100)
    },

    activateItem(index) {
      this.forBuilders.activeIndex = index;
    },


    choseLanguage(language) {
      this.selectLanguage = language;

      if (this.selectLanguage === 0) {
        this.language = this.$ru;
      } else if (this.selectLanguage === 1) {
        this.language = this.$en;
      } else if (this.selectLanguage === 2) {
        this.language = this.$tur;
      }

    },
    closeModal() {
      this.openLoginRealtor = false
      this.openLoginDeveloper = false
      this.openRegister = false
    },
    openModalRealtor() {
      this.openLoginRealtor = true
      this.openLoginDeveloper = false
    },
    openModalDeveloper() {
      this.openLoginRealtor = false
      this.openLoginDeveloper = true
    },
    closeModalRegister() {
      this.openRegister = false
    }
  },

  components: {
    AppModalRegister,
    AppHeader,
    AppFooter,
    AppModalAuth,
    NewHeader,
    NewFooter,
    AppModalText,
    AppModalAfterRegister
  }
}
</script>

<style scoped></style>
