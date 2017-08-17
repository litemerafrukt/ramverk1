---
title: "Remserver"
...
REM Server - REST Mockup API
===========================================

Integrerat i denna sidan finns en REM-server, REST Mockup API. Servern svarar på på valfri API-endpoint och sparar data och ändringar i data med hjälp av sessionshantering.

Servern har två dataset för `remserver/api/users` och `remserver/api/starships` om du inte vill börja från noll.

Du kan lägga till egna datasets och arbeta med dess via `remserver/api/[dataset]`.



Testa
-------------------------------------------

You can try out the pre-populated dataset `users`.

Testa dataset `user`.

* [Hämta alla användare](remserver/api/users)
* [hämta användare nummer ett](remserver/api/users/1)

Testa dataset `starships`.

* [Hämta alla rymdskepp](remserver/api/starships)
* [Hämta rymdskepp nummer två](remserver/api/starships/2)

Manual
-------------------------------------------
[API-manual på engelska](remserver/manual)
