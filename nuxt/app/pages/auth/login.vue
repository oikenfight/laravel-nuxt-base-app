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
                  <nuxt-link to="/auth/register" class="body-2">
                    新規登録
                  </nuxt-link>
                </v-col>
                <v-col cols="12" class="py-0">
                  Logazin
                </v-col>
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text>
                <v-text-field
                  v-model="user.email"
                  prepend-icon="email"
                  outline
                  label="メールアドレス"
                  type="email"
                ></v-text-field>
                <v-text-field
                  v-model="user.password"
                  prepend-icon="lock"
                  label="パスワード"
                  type="password"
                ></v-text-field>
              </v-card-text>
              <v-card-actions>
                <v-row>
                  <v-col cols="12" class="pa-0">
                    <v-row justify="center">
                      <v-col cols="6">
                        <v-btn color="info" block @click="login">
                          <v-icon>lock</v-icon>
                          ログイン
                        </v-btn>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
              </v-card-actions>
              <v-divider></v-divider>
              <v-card-actions>
                <v-row>
                  <v-col cols="12" class="pa-0">
                    <v-row justify="center">
                      <v-col cols="6">
                        <v-btn to="/auth/redirect" color="info" nuxt block>
                          Google
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
  name: 'Login',
  data() {
    return {
      user: {
        email: '',
        password: ''
      },
      message: {
        success: 'ログインに成功しました。',
        error: 'ログインに失敗しました。'
      },
      alert: {
        type: null,
        visible: false,
        message: ''
      }
    }
  },
  methods: {
    async login() {
      const result = await this.$store.dispatch('login', { user: this.user })
      if (result) {
        this.$router.push('/mypage')
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
