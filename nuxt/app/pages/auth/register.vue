<template>
  <v-row>
    <v-col cols="12">
      <v-alert
        v-model="alert.visible"
        border="left"
        :type="alert.type"
        dismissible
      >
        {{ alert.message }}
      </v-alert>
    </v-col>
    <v-col cols="12">
      <v-row justify="center" align="center">
        <v-col cols="6">
          <v-card elevation="4" tag="section">
            <v-card-title>
              <v-col cols="12" class="py-0">
                Web Markdown Editor
              </v-col>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
              <v-text-field
                v-model="user.name"
                prepend-icon="mdi-account"
                outline
                label="name"
                type="text"
              ></v-text-field>
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
            </v-card-text>
            <v-card-actions>
              <v-row>
                <v-col cols="12" class="pa-0">
                  <v-row justify="center">
                    <v-col cols="6">
                      <v-btn color="info" block @click="register">
                        Register
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-col>
                <v-col cols="12" class="pa-0">
                  <v-row justify="center">
                    <v-col cols="6">
                      <v-btn to="/auth/login" color="grey" nuxt dark block>
                        Back
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-col>
              </v-row>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
export default {
  layout: 'guest',
  name: 'Register',
  data() {
    return {
      user: {
        name: '',
        email: '',
        password: ''
      },
      message: {
        success: '新規ユーザの作成に成功しました。',
        error: '新規ユーザ作成に失敗しました。'
      },
      alert: {
        type: null,
        visible: false,
        message: ''
      }
    }
  },
  methods: {
    async register() {
      const result = await this.$store.dispatch('register', { user: this.user })
      if (result) {
        this.$router.push('/auth/login')
      } else {
        this.alert.type = 'error'
        this.alert.visible = true
        this.alert.message = this.message.error
      }
    }
  }
}
</script>

<style scoped></style>
