# https://hub.docker.com/_/postgres
FROM postgres:18.3

# タイムゾーンを設定（日本）
ENV TZ=Asia/Tokyo

COPY docker/local/postgres/postgresql.conf /etc/postgresql/postgresql.conf

EXPOSE 5432
