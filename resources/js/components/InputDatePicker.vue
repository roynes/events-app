<template>
  <div class="w-6/12 px-3">
    <label
      class="block uppercase tracking-wide
        text-gray-700 text-xs font-bold mb-2"
      for="event-to"
    >
      <span>
        {{ title }}
      </span>
    </label>
    <v-date-picker
      :min-date="minDate"
      :input-debounce="1500"
      v-model="computedDay"
    >
      <button
        :class="{'text-gray-500':!dateChosen, 'text-gray-700':dateChosen}"
        class="text-center appearance-none
          focus:outline-none block w-full
          bg-gray-200 border rounded py-3 px-4
          mb-3 leading-tight text-sm"

        id="event-from"
        type="button"
      >
        <span>
          {{ getLocaleDay }}
        </span>
      </button>
    </v-date-picker>
  </div>
</template>

<script>
export default {
  name: 'InputDatePicker',

  model: {
    prop: 'chosenDay',
    event: 'date-chosen'
  },

  props: {
    title: {
      type: String,
      default: 'title'
    },
    minDate: {
      type: Date,
      required: true
    },

    chosenDay: [String, Date, null]
  },

  computed: {
    dateChosen() {
      return this.chosenDay instanceof Date;
    },

    getLocaleDay: function() {
      return (this.chosenDay instanceof Date) ? this.chosenDay.toLocaleDateString() : "MM/DD/YY";
    },

    computedDay:  {
      get() {
        return this.chosenDay
      },

      set(newValue) {
        this.$emit('date-chosen', newValue);
      }
    }
  },
}
</script>
