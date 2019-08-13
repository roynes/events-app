<template>
  <div class="w-full px-3 my-4">
    <label
      class="block uppercase tracking-wide
        text-gray-700 text-xs font-bold mb-2"

      for="event-name"
    >
      Create new event
    </label>
    <input
      :value="value"
      @input="$emit('input', $event.target.value)"

      class="appearance-none block w-full
        bg-gray-200 text-gray-700
        border border-gray-200 rounded
        py-3 px-4 mb-3 leading-tight
        focus:outline-none focus:bg-white
        focus:border-gray-500"

      id="event-name"
      :placeholder="placeholder"
    >
  </div>
</template>

<script>
export default {
  name: 'TextInput',

  props: {
    title: {
      type: String,
      default: 'Input'
    },
    placeholder: {
      type: String,
      default: ''
    },
    value: ''
  },
}
</script>
