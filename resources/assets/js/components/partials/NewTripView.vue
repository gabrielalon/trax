<template>
  <v-form ref="form" v-model="valid" lazy-validation>
    <date-picker
      @dateChanged="dateChanged"
      :rules="[v => !!v  || 'Item is required']"
      :error-messages=errors.date
    ></date-picker>

    <v-select
      v-model="car"
      :items="cars"
      item-text="text"
      item-value="value"
      label="Car Driven"
      :rules="[v => !!v  || 'Item is required']"
      :error-messages=errors.car
    ></v-select>

    <v-text-field
      v-model="miles"
      label="Miles Driven"
      required
      :rules="[v => !!v  || 'Item is required', v => (v && !isNaN(v)) || 'Must be a number']"
      :error-messages=errors.miles
    ></v-text-field>

    <v-btn
      :disabled="isSubmitButtonDisabled"
      @click="submit"
    >
      submit
    </v-btn>
    <v-btn @click="clear">clear</v-btn>

  </v-form>
</template>

<script>
import {traxAPI} from "../../traxAPI";
import DatePicker from "../common/DatePicker";

export default {
  components: {
    DatePicker,
  },
  mounted() {
    this.fetchCars();
  },
  data() {
    return {
      valid: true,
      cars: [],
      date: null,
      car: null,
      miles: null,
      errors: [],
    }
  },
  watch: {},
  computed: {
    isSubmitButtonDisabled() {
      return !(this.date && this.car && this.miles);
    },
  },
  methods: {
    dateChanged(date) {
      this.date = date;
    },
    fetchCars() {
      axios.get(traxAPI.getCarsEndpoint())
        .then(response => {
          let cars = [];
          for (let i = 0; i < response.data.data.length; i++) {
            let car = response.data.data[i];
            cars.push({
              text: car.year + ' ' + car.brand + ' ' + car.model,
              value: car.id
            });
          }
          this.cars = cars;
        })
        .catch(e => {
          console.log(e);
        });
    },
    submit() {
      if (this.$refs.form.validate()) {
        axios.post(traxAPI.addTripEndpoint(this.car), {
          date: this.date.toISOString(),
          miles: this.miles
        })
          .then(response => {
            this.$router.push('/trips')
          })
          .catch(e => {
            this.errors = e.response.data.errors;
          });
      }
    },
    clear() {
      this.$refs.form.reset()
    }
  },
}
</script>
