<template>
  <v-row>
    <v-flex sm12 md6 offset-md3>
      <v-card elevation="4" tag="section">
        <v-card-title>
          <v-layout>
            <v-flex>
              Web Markdown Editor
            </v-flex>
          </v-layout>
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <p>Sign in with your username and password:</p>
          <v-form>
            <v-text-field
              v-model="user.email"
              prepend-icon="email"
              outline
              label="Email"
              type="email"
            ></v-text-field>
            <v-text-field
              v-model="user.password"
              prepend-icon="lock"
              label="Password"
              type="password"
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="info">
            <v-icon left>lock</v-icon>
            Login
          </v-btn>
        </v-card-actions>
        <v-divider></v-divider>

        <v-card-actions>
          <v-layout wrap justify-center>
            <v-flex xs12 sm8 md6>
              <v-btn color="info" block>
                <nuxt-link to="/redirect">Google</nuxt-link>
              </v-btn>
            </v-flex>
          </v-layout>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-row>
</template>

<script>
export default {
  layout: 'guest',
  name: 'Login',
  data() {
    return {
      user: {
        email: ''
      }
    }
  }
}
</script>

<style scoped>
.g-signin-button {
  /* This is where you control how the button looks. Be creative! */
  display: inline-block;
  padding: 4px 8px;
  border-radius: 3px;
  background-color: #3c82f7;
  color: #fff;
  box-shadow: 0 3px 0 #0f69ff;
}
</style>
