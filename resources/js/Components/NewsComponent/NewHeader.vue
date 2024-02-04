<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import ChangeLanguage from "@/Components/ChangeLanguage.vue";
</script>

<template>
  <!--header-->
  <header>
    <div v-if="openLogIn" @click="openLogIn = false" class="absolute h-[100vh] w-full z-40"></div>
    <div class="container">
      <nav>
        <ul>
          <li>
            <a href="#"><img class="logo" src="../../../../public/images/img/header/Globoos.png" alt="" srcset=""></a>
          </li>
          <li class="ref-soc">
<!--            <a href="wa.me/+905442258559" target="_blank"><img src="images/img/header/s1.png" alt="" srcset=""></a>-->
<!--&lt;!&ndash;            <a href="https://m.facebook.com/people/EVON/100092335686616/" target="_blank"><img src="images/img/header/s2.png" alt=""&ndash;&gt;-->
<!--&lt;!&ndash;                srcset=""></a>&ndash;&gt;-->
<!--            <a href="https://t.me/evon_turkey" target="_blank"><img src="images/img/header/s3.png" alt="" srcset=""></a>-->
<!--            <a href="https://instagram.com/evon_platform_tr?igshid=OGQ5ZDc2ODk2ZA==" target="_blank"><img src="images/img/header/s4.png"-->
<!--                alt="" srcset=""></a>-->
          </li>
          <li class="lang">
            <change-language @selectLanguage="selectLanguage" :selectLang="selectLang" :user_info="user_info"/>
          </li>
          <li class="btns">
            <div class="logIn">
              <button class="login" @click="openLogIn = !openLogIn">{{ language.main[61] }}</button>
              <div class="select-login" v-if="openLogIn === true">
                <button @click="$emit('login-realtor'), openLogIn = false">{{ language.po_v_r[11] }}</button>
                <button @click="$emit('login-developer'), openLogIn = false">{{ language.po_v_r[12] }}</button>
              </div>
            </div>
            <button class="registr" @click="$emit('open-register')">{{ language.main[22] }}</button>
          </li>
          <li class="user"  @click="$emit('open-modal-choise')">
            <span></span>
            <span></span>
            <span></span>
          </li>

        </ul>
      </nav>
    </div>

  </header>
  <!--!header-->
</template>

<script>
export default {
  name: "NewHeader",
  props: ['user_info', 'language'],
  data() {
    return {
      openLanguage: false,
      selectLang: 0,
      modalMobile:false,
      openLogIn: false
    }
  },
  methods: {
    selectLanguage(n) {
      this.$emit('selectLanguage', n);

      if (this.user_info !== undefined) {

        axios.post('/api/user/lang', {
          token: this.user_info.token,
          id: this.user_info.id,
          lang: n,
        })

      }
    },
  }
}
</script>

<style scoped></style>
