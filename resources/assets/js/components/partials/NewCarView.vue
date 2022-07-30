<template>
  <v-form ref="form" v-model="valid" lazy-validation>
    <v-text-field
      v-model="year"
      :rules="[v => !!v  || 'Item is required', v => (v && v.length === 4 && !isNaN(v)) || 'Must be 4 digit year']"
      :error-messages=errors.year
      label="Year"
      required
    ></v-text-field>
    <v-text-field
      v-model="brand"
      label="Brand"
      :error-messages=errors.brand
      required
      :rules="[v => !!v || 'Item is required']"
    ></v-text-field>
    <v-text-field
      v-model="model"
      label="Model"
      :error-messages=errors.model
      required
      :rules="[v => (!!v) || 'Item is required']"
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

export default {
  data() {
    return {
      valid: true,
      year: null,
      brand: null,
      model: null,
      errors: [],
    }
  },
  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        axios.post(traxAPI.addCarEndpoint(), {
          year: this.year,
          brand: this.brand,
          model: this.model,
        })
          .then(response => {
            this.$router.push('/cars')
          })
          .catch(e => {
            this.errors = e.response.data.errors;
            this.valid = true;
          });
      }
    },
    clear() {
      this.$refs.form.reset()
    }
  },
  computed: {
    isSubmitButtonDisabled() {
      return !(this.year && this.brand && this.model);
    },
  }
}
</script>
