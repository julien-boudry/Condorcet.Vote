Initial volume creation: 
```shell
docker volume create condorcetdb
```

```shell
docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```

To DO:
- Voir les  ports dev/prod
- Voir pour du TLS
- Voir cohabitation ports sur le serveur de prod ou multi-ip
