<template>
  <div class="fixed z-[100] w-full h-full flex items-center justify-center">
    <div
      class="relative flex flex-col gap-7 xxl:gap-6 xl:gap-5 bg-white rounded-[12px] px-12 xxl:px-10 xl:px-8 py-8 xxl:py-6 xl:py-5 z-50 w-[50%] lg:w-[64%] md:w-[80%] sm:w-[90%] h-fit">
      <div class="relative flex justify-between items-center">
        <h2 class="text-[22px] xxl:text-lg xl:text-base lg:text-[20px] font-semibold leading-none">{{ language.ob[0] }}</h2>
        <button v-on:click="$emit('close')" class="hover__close transition-all relative w-4 h-4 z-50">
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] rotate-45"></span>
          <span class="absolute h-[1px] top-1/2 left-0 w-4 bg-[#8A8996] -rotate-45"></span>
        </button>
      </div>
      <div
        class="text-[16px] xxl:text-[14px] xl:text-[12px] lg:text-[15px] pr-2 overflow-x-auto custom__scroll--chess max-h-[70vh]">
        <div class="py-5 xxl:py-4 xl:py-3 border__bottom">
          <span class="text-[#8A8996]"></span>
          <p class="text-[22px] xxl:text-lg xl:text-base lg:text-[20px] font-semibold leading-none my-2">{{
            new_object.title }}</p>
          <p v-html="new_object.description"></p>
        </div>
      </div>
    </div>
    <div v-on:click="$emit('close')" class="absolute bg-black opacity-50 h-full w-full z-40"></div>
  </div>
</template>

<script>
  export default {
    props: ['new_object', 'language'],
    name: "NewsModal",
    mounted() {

    }
  }
</script>

<style scoped>

</style>
