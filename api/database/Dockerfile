FROM postgres:15

RUN apt-get update && apt-get install -y cron

# Scripts de inicialização (executados automaticamente pelo postgres)
COPY backups/*.sql /docker-entrypoint-initdb.d/

COPY backup.sh /usr/local/bin/backup.sh
COPY crontab.txt /etc/cron.d/backup-cron
COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /usr/local/bin/backup.sh /entrypoint.sh
RUN chmod 0644 /etc/cron.d/backup-cron && crontab /etc/cron.d/backup-cron

CMD ["/entrypoint.sh"]