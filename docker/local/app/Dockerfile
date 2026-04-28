# https://hub.docker.com/_/amazonlinux
FROM amazonlinux:2023

ENV TZ=Asia/Tokyo

RUN dnf install -y php8.5

# Composer システム要件
# https://getcomposer.org/doc/00-intro.md#system-requirements
RUN dnf install -y php8.5-zip

# Laravel システム要件
# https://laravel.com/docs/13.x/deployment#server-requirements
# 今の Docker イメージですべて有効化されている

# PostgreSQL の場合
RUN dnf install -y php-pgsql

# Node.js をインストールするのに必要
RUN dnf install -y tar findutils

RUN dnf clean all

ENV NODE_VERSION=24.15.0
ENV HOME=/root
ENV PATH=$HOME/.nvm/versions/node/v$NODE_VERSION/bin:$PATH

# https://nodejs.org/ja/download
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.4/install.sh | bash \
    && . $HOME/.nvm/nvm.sh \
    && nvm install $NODE_VERSION

WORKDIR /src

EXPOSE 5173 8000
