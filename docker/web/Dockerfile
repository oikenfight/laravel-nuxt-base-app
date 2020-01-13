FROM node:13-alpine
# FROM node:10.15

RUN apk --no-cache update \
    && apk --no-cache upgrade \
    && apk add \
    musl \
    linux-headers \
    gcc \
    g++ \
    make \
    gfortran \
    openblas-dev \
    python3 \
    python3-dev

ARG MY_APP
ARG APP_ROOT

RUN mkdir ${APP_ROOT}
WORKDIR ${APP_ROOT}
# ADD ${MY_APP} ${APP_ROOT}

# RUN npm ci
# RUN npm run build

ENV HOST 0.0.0.0