<template>
  <div class="flex flex-wrap">
    <!-- Forms -->
    <div class="w-3/12 border border-solid border-gray-400 rounded-lg">
      <TextInput
        v-model="description"
        title="Create new event"
        placeholder="NAME"
      />

      <div class="w-full flex justify-around mb-3">
        <InputDatePicker
          title="from"
          v-model="from"
          :min-date="today"
        />

        <InputDatePicker
          title="to"
          v-model="to"
          :min-date="computeMinDateForTo"
        />
      </div>

      <div class="w-full px-3 flex justify-between uppercase">
        <div class="w-3s/12 text-xs flex text-gray-500">
          <div class="self-center">
            <router-link to="/">Cancel</router-link>
          </div>
        </div>

        <button
          :disabled="!(formValid)"
          @click="createEvent"
          :class="{'hover:bg-orange-700': formValid, 'opacity-50 cursor-not-allowed': !(formValid)}"
          class="
            focus:outline-none
            bg-orange-500
            text-white  py-2 px-4 rounded-full px-3 text-xs">
            SAVE
        </button>
      </div>
    </div>

    <!-- Calendar -->
    <div class="w-9/12 flex flow-col justify-center pl-3">
      <v-calendar
        mode='range'
        color='black'
        is-expanded
        title-position="left"
        :min-date="today"
        :attributes="attributes"
      />
    </div>

    <!-- Notifications -->
    <transition name="slide-fade">
      <div class="w-full py-3" v-if="hasErrors">
        <error-alert @toggle="hasErrors = $event" :errors="errors"/>
      </div>
    </transition>
    <transition name="slide-fade">
      <div class="w-full py-3" v-if="hasSuccess">
        <success-alert @toggle="hasSuccess = $event "/>
      </div>
    </transition>
  </div>
</template>

<script>
import TextInput from '../components/TextInput';
import InputDatePicker from '../components/InputDatePicker';

const colors = ["red", "orange", "yellow", "green", "purple", "teal", "blue", "pink"];

export default {
  name: 'Event',

  components: {
    'error-alert': () => import('../components/ErrorAlert'),
    'success-alert': () => import('../components/SuccessAlert'),
    TextInput,
    InputDatePicker
  },

  computed: {
    computedDateTo() {
      if(
        this.dateFromValid && !(this.dateToValid)
        || this.from > this.to
      )
        this.to = this.from;

      if(this.to instanceof Date)
        return this.to.toLocaleDateString();

      return this.to;
    },

    computedDateFrom() {
      if(this.from instanceof Date)
        return this.from.toLocaleDateString()

      return this.from
    },

    computeMinDateForTo() {
      if(!this.dateFromValid) return this.today;

      return this.from;
    },

    dateFromValid() {
      return this.from instanceof Date;
    },

    dateToValid() {
      return this.to instanceof Date;
    },

    dateRangeValid() {
      return this.dateToValid && this.dateFromValid;
    },

    eventNameEmpty() {
      return this.description.length === 0;
    },

    formValid() {
      return this.dateRangeValid && !(this.eventNameEmpty)
    }
  },

  methods: {
    createEvent() {
      const { description, to, from } = this;

      axios.post('api/events', {
        name: description, to: to.toLocaleDateString(), from: from.toLocaleDateString()
      }).then(resp => {
        const { data } = resp;
        const { id, name, to, from } = data;

        this.hasSuccess = true;

        this.attributes.push({
          key: `sample_00${id}`,
          bar: colors[id%8],
          dates: {
            start: new Date(from),
            end: new Date(to),
          },
          popover: {
            label: name,
            visibility: "focus"
          }
        });
      }).catch(reason => {
          this.errors=reason.response.data.errors;
          this.hasErrors = true
      });

      this.description = "";
      this.to = null;
      this.from = null;
    }
  },

  data: () => {
    const today = new Date();

    return {
      today,
      from: "MM/DD/YY",
      to: "MM/DD/YY",
      counts: 0,
      description: "",
      attributes: [],
      hasErrors: false,
      hasSuccess: false,
      errors: {},
      blabla: ''
    }
  },

  created() {
    axios.get('/api/events').then(({data}) => this.attributes.push(...data.map(event => ({
      key: `sample_00${event.id}`,
      bar: colors[++this.counts%8],
      dates: {
        start: new Date(event.from),
        end: new Date(event.to),
      },
      popover: {
        label: event.name,
        visibility: "focus"
      }
    }))));
  }
}
</script>

<style scoped>
  .slide-fade-enter-active {
    transition: all .3s ease;
  }
  .slide-fade-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
  }
  .slide-fade-enter, .slide-fade-leave-to {
    opacity: 0;
  }
</style>
