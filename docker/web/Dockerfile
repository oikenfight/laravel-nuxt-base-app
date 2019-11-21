FROM node:13-alpine
# FROM node:10.15

RUN apk --no-cache update \
    && apk --no-cache upgrade

ARG MY_APP
ARG APP_ROOT

RUN mkdir ${APP_ROOT}
WORKDIR ${APP_ROOT}
# ADD ${MY_APP} ${APP_ROOT}

# RUN npm ci
# RUN npm run build

ENV HOST 0.0.0.0