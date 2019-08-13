<template>
  <div
    class="bg-red-100 border
      border-red-400 text-red-700
      px-4 py-3 rounded relative"
    role="alert"
  >
    <div class="mb-3">
      <strong class="font-bold">Holy smokes!</strong>
      <span class="block sm:inline">Something seriously bad happened.</span>
    </div>
    <div
      v-for="(value, name) in errors"
      :key="name"
    >
      {{value.join("\n")}}
    </div>
  </div>
</template>

<script>
export default {
  name: 'ErrorAlert',

  props: {
    errors: {
      type: Object,
      default: {}
    }
  },

  mounted() {
    setTimeout(() => {
      this.$emit('toggle', false);
    }, 6000)
  }
}
</script>
