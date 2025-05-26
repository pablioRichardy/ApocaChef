FROM postgres:15

# Instalar cron
RUN apt-get update && apt-get install -y cron

# Adiciona script de backup
COPY backup.sh /usr/local/bin/backup.sh
RUN chmod +x /usr/local/bin/backup.sh

# Adiciona cron job
COPY crontab.txt /etc/cron.d/backup-cron
RUN chmod 0644 /etc/cron.d/backup-cron && crontab /etc/cron.d/backup-cron

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Comando padrão para iniciar o cron
CMD ["/entrypoint.sh"]
