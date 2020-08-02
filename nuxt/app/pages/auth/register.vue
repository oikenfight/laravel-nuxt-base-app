<template>
  <v-container fill-height>
    <v-col v-if="alert.visible" cols="12">
      <v-alert
        v-model="alert.visible"
        border="left"
        :type="alert.type"
        dismissible
      >
        {{ alert.message }}
      </v-alert>
    </v-col>
    <v-layout wrap align-center>
      <v-col cols="12">
        <v-row justify="center">
          <v-col cols="6">
            <v-card elevation="4" tag="section">
              <v-card-title>
                <v-col cols="12" class="py-0 text-right">
                  <nuxt-link to="/" class="body-2 mr-5">
                    TOP
                  </nuxt-link>
                  <nuxt-link to="/auth/login" class="body-2">
                    ログイン
                  </nuxt-link>
                </v-col>
                <v-col cols="12" class="py-0">
                  Logazin
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
                  prepend-icon="mdi-email"
                  outline
                  label="Email"
                  type="email"
                ></v-text-field>
                <v-text-field
                  v-model="user.password"
                  prepend-icon="mdi-key"
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
    </v-layout>
  </v-container>
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
      const result = await this.$store.dispatch('register', {
        user: this.user
      })
      if (result.status === 200) {
        this.$router.push('/auth/login')
      } else {
        this.alert.type = 'error'
        this.alert.visible = true
        let message = ''
        Object.keys(result.messages).forEach(function(key) {
          message += result.messages[key] + '\n'
        })
        this.alert.message = message
      }
    }
  }
}
</script>

<style scoped></style>
