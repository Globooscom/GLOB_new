<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import ChangeLanguage from "@/Components/ChangeLanguage.vue";
</script>

<template>
  <div v-if="overlaySelect" @click="closeOverlaySelect" class="absolute h-full w-full z-40"></div>
  <!--  Меню до входа-->
  <header v-if="user_info === null" class="relative bg-[#255ECC]  leading-[100%]">
    <div class="_container h-[60px] xxl:h-12 xl:h-10 sm:px-1">
      <div class="flex items-center justify-between h-full ">
        <Link href="/" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
        <img src="../../../public/images/img/header/GloboosWh.png" class="h-6 xxl:h-5 xl:h-4 lg:h-5 sm:h-4" alt="Логотип">
        </Link>
        <div class="flex items-center gap-7 xxl:gap-5 lg:gap-2 text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[14px]">
          <change-language @selectLanguage="selectLanguage" :selectLang="selectLang" />
          <div class="flex gap-3 xxl:gap-2 font-medium">
            <div class="relative text-[#3B3A45] z-50">
              <button @click="loginOpens"
                class="login login__btn--bg text-white px-5 xxl:px-4 xl:px-3 py-2.5 xxl:py-2 xl:py-1 rounded-[3px]">{{
                  language.main[18] }}</button>
              <div v-if="loginOpen"
                class="login__dropdown absolute overflow-hidden top-[120%] flex flex-col items-start bg-white rounded-[6px]">
                <button @click="loginDeveloper"
                  class="hover__select whitespace-nowrap leading-none px-3.5 py-2.5 w-full">{{ language.main[13]
                  }}</button>
                <button @click="loginRealtor"
                  class="hover__select whitespace-nowrap leading-none text-left px-3.5 py-2.5 w-full">{{ language.main[4]
                  }}</button>
              </div>
            </div>
            <button @click="$emit('open-register')"
              class="register__button--bg text-white px-5 xxl:px-4 xl:px-3 py-2.5 xxl:py-2 xl:py-1 rounded-[3px]">{{
                language.main[19] }}</button>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Меню агента -->
  <header v-if="user_info !== null && user_info.role === 0" class="relative bg-[#255ECC]  leading-[100%]">

    <app-burger-agent :openClient="openClient" :tabindex="tabindex" @blur="openBurgerAgent = false" :class="{ 'left__0': openBurgerAgent }"
      :user="user" :language="language" @target-with-client="targetWithClient" @logout="logout" />

    <div class="_container h-[60px] xxl:h-12 xl:h-10 lg:h-12 sm:px-1">
      <div class="flex items-center justify-between h-full ">
        <div class="flex gap-20 xxl:gap-16 xl:gap-12 lg:gap-2 sm:gap-1.5 items-baseline lg:items-center">
          <div @click="openBurgerAgent = !openBurgerAgent"
            class="hidden lg:flex relative flex-col justify-evenly py-0.5 items-center cursor-pointer h-8 w-8 rounded-[5px] bg-[#255ECC] ">
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
          </div>
          <Link href="/houses" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
            <img src="../../../public/images/img/header/GloboosWh.png" class="h-6 xxl:h-5 xl:h-4 lg:h-5 sm:h-4" alt="Логотип">
          </Link>
          <div
            class="lg:hidden text-white text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[15px] flex gap-20 xxl:gap-16 xl:gap-12 x:gap-10">
            <Link href="/houses" v-on:click="tag = 0" :class="{ 'opacity-60': $page.url !== '/houses' }" class="whitespace-nowrap">
            {{ tag === 0 ? '' : language.rielt_1[0] }} <div v-if="tag === 0" class="minLoader"></div></Link>
            <Link href="/villages" v-on:click="tag = 1" :class="{ 'opacity-60': $page.url !== '/villages' }" class="whitespace-nowrap">
            {{ tag === 1 ? '' : language.rielt_1[1] }} <div v-if="tag === 1" class="minLoader"></div></Link>
            <Link href="/profile/compilation" :class="{ 'opacity-60': $page.url !== '/profile/compilation' }"
              class="whitespace-nowrap">
            {{ language.rielt_1[2] }}</Link>
            <Link href="/profile/favorites" :class="{ 'opacity-60': $page.url !== '/profile/favorites' }"
              class="whitespace-nowrap">
            {{ language.rielt_1[3] }}</Link>
            <Link href="/profile/help" :class="{ 'opacity-60': $page.url !== '/profile/help' }"
                  class="whitespace-nowrap">
              {{ language.subscription[39] }}</Link>
          </div>
        </div>
        <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[15px]">
          <div class="relative hover__search">
            <input @keydown.enter="startSearch" v-model="search"
              class="text-white focus:ring-white pr-14 xxl:pr-10 xl:pr-8 lg:pr-6 pl-4 xxl:pl-3 xl:pl-2.5 lg:pl-1.5 text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none bg-[#255ECC]  h-12 xxl:h-10 xl:h-8 w-[380px] exl:w-[18vw] lg:w-[160px] sm:w-[100px] rounded-[5px]"
              type="text">
            <img @click="startSearch" src="../../assets/svg/search_icon.svg"
              class="cursor-pointer absolute top-1/2 -translate-y-1/2 right-3 exl:right-[1vw] h-6 xxl:h-5 xl:h-4"
              alt="Поиск">
          </div>
          <div class="flex">
            <Link class="flex-shrink-0" :href="route('chats')">
            <div
              class="header__chat cursor-pointer flex items-center justify-center h-[60px] lg:h-12 xxl:h-12 xl:h-10 px-8 xxl:px-6 xl:px-5 lg:px-4 sm:px-3.5">
              <div class="relative">
                <img src="../../assets/svg/chat_icon.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="Чат">
                <div v-if="isChat === true"
                  class="absolute flex items-center justify-center -top-[30%] -right-[50%] rounded-full bg-[#255ECC] h-3.5 xxl:h-3 xl:h-2.5 lg:h-3.5 w-3.5 xxl:w-3 xl:w-2.5 lg:w-3.5">
                  <span class="text-white text-[12px] xxl:text-[10px] xl:text-[8px]">{{ chats }}</span>
                </div>
              </div>
            </div>
            </Link>
            <change-language @selectLanguage="selectLanguage" :selectLang="selectLang" />
            <div class="lg:hidden relative flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5 ml-5 xxl:mr-4 xl:mr-3">
              <button @click="openProfile" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span class="text-white text-lg xxl:text-sm xl:text-xs leading-none whitespace-nowrap">{{ user.first_name
                  + ' ' + user.last_name }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </button>
              <div v-if="openProfileMenu"
                class="overflow-hidden border border-solid border-[#E5DFEE] absolute z-50 top-[90%] right-0 flex flex-col bg-white rounded-[5px]">

                <Link href="/profile"
                  class="cursor-pointer hover__select border__bottom--not whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">
                  <span class="cursor-pointer pr-1 leading-none whitespace-nowrap cursor-default">{{ language.ob[42] }}</span>
                  <span class="cursor-pointer leading-none whitespace-nowrap cursor-default"
                    v-if="user !== null && user.subscription_info !== null"> {{ getDate(user.subscription_info.finished_at) }}</span>
                </Link>

                <div v-if="user.role === 0"
                  class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap cursor-default">{{ language.ob[32] }}</span>
                  <label
                    class="relative cursor-pointer inline-block w-[42px] xxl:w-[36px] xl:w-[30px] h-[24px] xxl:h-[20px] xl:h-[18px]">
                    <input v-model="withClient" @change="targetWithClient" class="hidden" type="checkbox">
                    <span class="slider round"></span>
                  </label>
                </div>
                <Link href="/profile"
                  class="hover__select border__bottom--not whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">{{
                    language.prof_zastr[0] }}</Link>
                <div @click="logout"
                  class="hover:bg-[#f5f5f5]   border__bottom--not text-[#255ECC]  whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">
                  {{ language.menu_zastr_1[2] }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Меню Застройщик-->
  <!--  v-if="user.role === 1" -->
  <header v-if="user_info !== null && user_info.role === 1"
    class="relative bg-[#255ECC]  leading-[100%]">

    <app-burger-dev :user="user_info" :language="language" :class="{ 'left__0': openBurgerDev }" @logout="logout"
      @target-with-client="targetWithClient" />

    <div class="_container h-[60px] xxl:h-12 xl:h-10 lg:h-12 sm:px-1">
      <div class="flex items-center justify-between h-full ">
        <div class="flex gap-20 xxl:gap-16 xl:gap-12 lg:gap-2 items-baseline lg:items-center">
          <div @click="openBurgerDev = !openBurgerDev"
            class="hidden lg:flex relative flex-col justify-evenly py-0.5 items-center cursor-pointer h-6 w-6 rounded-[5px] bg-[#255ECC] ">
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
          </div>
          <Link href="/profile/houses" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
            <img src="../../../public/images/img/header/GloboosWh.png" class="h-6 xxl:h-5 xl:h-4 lg:h-5 sm:h-4" alt="Логотип">
          </Link>
          <div
            class="lg:hidden text-white text-[16px] xxl:text-[13px] xl:text-[11px] flex gap-20 xxl:gap-16 xl:gap-12 x:gap-10">
            <Link href="/profile/houses" :class="{ 'opacity-60': $page.url !== '/profile/houses' }">{{
              language.menu_zastr[0] }}</Link>
            <Link href="/profile/news" :class="{ 'opacity-60': $page.url !== '/profile/news' }">{{ language.menu_zastr[1]
            }}</Link>
          </div>
        </div>
        <div class="flex items-center gap-7 xxl:gap-5 text-[16px] xxl:text-[13px] xl:text-[11px]">
          <div class="flex">
            <Link :href="route('chats')"
              class="cursor-pointer flex-shrink-0 flex items-center justify-center h-[60px] xxl:h-12 xl:h-10 lg:h-12 px-8 xxl:px-6 xl:px-5 lg:px-3.5">
            <div class="relative">
              <img src="../../assets/svg/chat_icon.svg" class="h-6 xxl:h-5 xl:h-4" alt="Чат">
              <div v-if="isChat === true"
                class="absolute flex items-center justify-center -top-[30%] -right-[50%] rounded-full bg-[#255ECC] h-3.5 xxl:h-3 xl:h-2.5 w-3.5 xxl:w-3 xl:w-2.5">
                <span class="text-white text-[12px] xxl:text-[10px] xl:text-[8px]">{{ chats }}</span>
              </div>
            </div>
            </Link>
            <change-language @selectLanguage="selectLanguage" :selectLang="selectLang" />
            <div class="lg:hidden relative flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5 ml-5 xxl:mr-4 xl:mr-3">
              <button @click="openProfile" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span class="text-white text-lg xxl:text-sm xl:text-xs leading-none">{{ user_info.first_name === 'null' ? '-' :
                  user_info.first_name }} {{ user_info.last_name === 'null' ? '-' : user_info.last_name }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </button>
              <div v-if="openProfileMenu"
                class="overflow-hidden lg:text-[13px] border border-solid border-[#E5DFEE] absolute z-50 top-[90%] right-0 flex flex-col bg-white rounded-[5px]">
                <div
                  class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap cursor-default">{{ language.ob[42] }}</span>
                  <span class="leading-none whitespace-nowrap cursor-default"
                    v-if="user_info !== null && user_info.subscription_info !== null">{{ getDate(user_info.subscription_info.finished_at) }}</span>
                </div>
                <Link href="/profile"
                  class="hover__select border__bottom--not whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">{{
                    language.prof_zastr[0] }}</Link>
                <div @click="logout"
                  class="hover:bg-[#f5f5f5]   border__bottom--not text-[#255ECC]  whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">
                  {{ language.menu_zastr_1[2] }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Меню Админа и модератора -->
  <header v-if="user_info !== null && user_info.role === 2 || user_info !== null && user_info.role === 3" class="relative bg-[#255ECC]  leading-[100%]">

    <app-burger-agent :openClient="true" :tabindex="tabindex" @blur="openBurgerAgent = false" :class="{ 'left__0': openBurgerAgent }"
                      :user="user_info" :language="language" @target-with-client="targetWithClient" @logout="logout" />

    <div class="_container h-[60px] xxl:h-12 xl:h-10 lg:h-12 sm:px-1">
      <div class="flex items-center justify-between h-full ">
        <div class="flex gap-20 xxl:gap-16 xl:gap-12 lg:gap-2 sm:gap-1.5 items-baseline lg:items-center">
          <div @click="openBurgerAgent = !openBurgerAgent"
               class="hidden lg:flex relative flex-col justify-evenly py-0.5 items-center cursor-pointer h-8 w-8 rounded-[5px] bg-[#255ECC] ">
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
            <span class="bg-white h-[1px] w-[60%] rounded-[2px]"></span>
          </div>
          <Link href="/houses" class="flex items-center gap-3 xxl:gap-2 xl:gap-1.5">
            <img src="../../../public/images/img/header/GloboosWh.png" class="h-6 xxl:h-5 xl:h-4 lg:h-5 sm:h-4" alt="Логотип">
          </Link>
          <div
            class="lg:hidden text-white text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[15px] flex gap-20 xxl:gap-16 xl:gap-12 x:gap-10">
            <Link href="/profile/houses" :class="{ 'opacity-60': $page.url !== '/profile/houses' }">{{
              language.menu_zastr[0] }}</Link>
            <Link href="/profile/news" :class="{ 'opacity-60': $page.url !== '/profile/news' }">{{ language.menu_zastr[1]
              }}</Link>
            <Link href="/houses" :class="{ 'opacity-60': $page.url !== '/houses' }" class="whitespace-nowrap">
              {{ language.rielt_1[0] }}</Link>
            <Link href="/villages" :class="{ 'opacity-60': $page.url !== '/villages' }" class="whitespace-nowrap">
              {{ language.rielt_1[1] }}</Link>
            <Link href="/profile/compilation" :class="{ 'opacity-60': $page.url !== '/profile/compilation' }"
                  class="whitespace-nowrap">
              {{ language.rielt_1[2] }}</Link>
            <Link href="/profile/help" :class="{ 'opacity-60': $page.url !== '/profile/help' }"
                  class="whitespace-nowrap">
              {{ language.subscription[39] }}</Link>
          </div>
        </div>
        <div class="flex items-center gap-5 xxl:gap-4 xl:gap-3 text-[16px] xxl:text-[13px] xl:text-[11px] lg:text-[15px]">
          <div class="relative hover__search">
            <input @keydown.enter="startSearch" v-model="search"
                   class="text-white focus:ring-white pr-14 xxl:pr-10 xl:pr-8 lg:pr-6 pl-4 xxl:pl-3 xl:pl-2.5 lg:pl-1.5 text-[18px] xxl:text-[15px] xl:text-[13px] lg:text-[15px] leading-none bg-[#255ECC]  h-12 xxl:h-10 xl:h-8 w-[380px] exl:w-[12vw] lg:w-[160px] sm:w-[100px] rounded-[5px]"
                   type="text">
            <img @click="startSearch" src="../../assets/svg/search_icon.svg"
                 class="cursor-pointer absolute top-1/2 -translate-y-1/2 right-3 exl:right-[1vw] h-6 xxl:h-5 xl:h-4"
                 alt="Поиск">
          </div>
          <div class="flex">
            <Link class="flex-shrink-0" :href="route('chats')">
              <div
                class="header__chat cursor-pointer flex items-center justify-center h-[60px] lg:h-12 xxl:h-12 xl:h-10 px-8 xxl:px-6 xl:px-5 lg:px-4 sm:px-3.5">
                <div class="relative">
                  <img src="../../assets/svg/chat_icon.svg" class="h-6 xxl:h-5 xl:h-4 lg:h-5" alt="Чат">
                  <div v-if="isChat === true"
                       class="absolute flex items-center justify-center -top-[30%] -right-[50%] rounded-full bg-[#255ECC] h-3.5 xxl:h-3 xl:h-2.5 lg:h-3.5 w-3.5 xxl:w-3 xl:w-2.5 lg:w-3.5">
                    <span class="text-white text-[12px] xxl:text-[10px] xl:text-[8px]">{{ chats }}</span>
                  </div>
                </div>
              </div>
            </Link>
            <change-language @selectLanguage="selectLanguage" :selectLang="selectLang" />
            <div class="lg:hidden relative flex items-center gap-3.5 xxl:gap-3 xl:gap-2.5 ml-5 xxl:mr-4 xl:mr-3">
              <button @click="openProfile" class="flex items-center gap-2.5 xxl:gap-2 xl:gap-1.5">
                <span class="text-white text-lg xxl:text-sm xl:text-xs leading-none whitespace-nowrap">{{ user_info.first_name
                  + ' ' + user_info.last_name }}</span>
                <img src="../../assets/svg/arrow_down.svg" class="w-2.5 xxl:w-2 xl:w-[7px]" alt="Стрелка вниз">
              </button>
              <div v-if="openProfileMenu"
                   class="overflow-hidden border border-solid border-[#E5DFEE] absolute z-50 top-[90%] right-0 flex flex-col bg-white rounded-[5px]">
                <div
                  class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap cursor-default">{{ language.ob[42] }}</span>
                  <span class="leading-none whitespace-nowrap cursor-default"
                        v-if="user_info !== null && user_info.subscription_info !== undefined">{{ getDate(user_info.subscription_info.finished_at) }}</span>
                </div>
                <div v-if="user_info.role === 0"
                     class="hover__select border__bottom--not flex justify-between gap-3.5 xxl:gap-3 xl:gap-2.5 items-center p-4 xxl:p-3 xl:p-2.5">
                  <span class="leading-none whitespace-nowrap cursor-default">{{ language.ob[32] }}</span>
                  <label
                    class="relative cursor-pointer inline-block w-[42px] xxl:w-[36px] xl:w-[30px] h-[24px] xxl:h-[20px] xl:h-[18px]">
                    <input v-model="withClient" @change="targetWithClient" class="hidden" type="checkbox">
                    <span class="slider round"></span>
                  </label>
                </div>
                <Link href="/profile"
                      class="hover__select border__bottom--not whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">{{
                  language.prof_zastr[0] }}</Link>
                <div @click="logout"
                     class="hover:bg-[#f5f5f5]   border__bottom--not text-[#255ECC]  whitespace-nowrap cursor-pointer p-4 xxl:p-3 xl:p-2.5">
                  {{ language.menu_zastr_1[2] }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import AppBurgerAgent from "@/Layouts/AppBurgerAgent.vue"
import AppBurgerDev from "@/Layouts/AppBurgerDev.vue"
import { useForm } from '@inertiajs/inertia-vue3'
import { router } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

export default {
  props: {
    heightMain: Number,
    user: [],
    tabindex: {
      type: Number,
      required: false,
      default: 0,
    },
    language: {},
    admin: [],
  },
  data() {
    return {
      tag: null,
      loginOpen: false,
      openProfileMenu: false,
      openBurgerAgent: false,
      openBurgerDev: false,
      overlaySelect: false,
      withClient: false,
      search: null,
      isChat: false,
      chats: 0,
      selectLang: 0,
      user_info: [],
      openClient: computed(() => usePage().props.value.check)
    }
  },

  mounted() {

    if (this.user !== null) {
      // setInterval(() => {
      //   axios.post('/api/chat/checkChat', {
      //     user_id: this.user_info.id,
      //     token: this.user_info.token,
      //   }).then(res => {
      //     this.chats = res.data;
      //
      //     if (this.chats > 0) {
      //       this.isChat = true;
      //     } else {
      //       this.isChat = false;
      //     }
      //   })
      // }, 5000)
    }

  },
  emits: ['login-realtor', 'login-developer', 'open-register'],
  methods: {
    getDate(d) {

      let date = new Date();
      let finish = new Date(d);

      if (finish - date > 0) {
        var timeDiff = Math.abs(finish.getTime() - date.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

        if (diffDays <= 1) {
          return diffDays + ' ' + this.language.default[2];
        } else if (diffDays > 1 && diffDays < 5) {
          return diffDays + ' ' + this.language.default[4];
        } else {
          return diffDays + ' ' + this.language.default[3];
        }
      } else {
        return '0' + this.language.default[3];
      }

    },
    selectLanguage(n) {
      this.$emit('selectLanguage', n);

      if (this.user_info !== null) {

        axios.post('/api/user/lang', {
          token: this.user_info.token,
          id: this.user_info.id,
          lang: n,
        })

      }
    },
    startSearch() {
      if (this.search) {
        localStorage.setItem('searchData', this.search)
        window.location.href = '/houses#search'
        if (window.location.href.split('#').at(-1) === 'search') {
          location.reload()
        }
      }
    },
    openProfile() {
      this.openProfileMenu = !this.openProfileMenu
      this.overlaySelect = !this.overlaySelect
    },
    loginOpens() {
      this.loginOpen = !this.loginOpen
      this.overlaySelect = !this.overlaySelect
    },
    closeOverlaySelect() {
      this.overlaySelect = false

      this.loginOpen = false
      this.openProfileMenu = false
    },
    logout() {
      router.post('/logout');
    },
    selectOption(language) {
      // this.langSelected =  language
      // localStorage.setItem('language', language)
      this.overlaySelect = false
    },
    loginRealtor() {
      this.$emit('login-realtor')
      this.loginOpen = false
      this.overlaySelect = false
    },
    loginDeveloper() {
      this.$emit('login-developer')
      this.loginOpen = false
      this.overlaySelect = false
    },
    targetWithClient() {
      localStorage.setItem('withClient', this.withClient)
      this.$emit('update-block-client', this.withClient)
    }
  },
  created() {

    if(this.admin !== null && this.admin !== undefined) {
      this.user_info = this.admin;
    } else {
      this.user_info = this.user;
    }

    this.withClient = localStorage.getItem('withClient') === 'true' ? true : false

    if (this.user !== null) {
      this.selectLang = this.user_info.lang
    }
  },
  components: {
    AppBurgerAgent,
    AppBurgerDev,
  }
}
</script>

<style>
  .minLoader {
    border: 3px solid #000; /* Light grey */
    border-top: 3px solid; /* Blue */
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 1s linear infinite;
    padding-left: 5%;
    padding-right: 5%;
  }
  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
</style>
