---
title: "Kmom06 - rapport"
...

## Kmom06

### Har du någon erfarenhet av automatiserade testar och CI sedan tidigare?
Vi skrev lite tester under oophp, under oopython och skrivit en del tester i mitt individuella projekt. Jag tycker det är synd att det känns som om enhetstester har hamnat lite i skymundan i oophp och även denna kurs. Momenten kommer in i de sista kursmomenten som har blivit något av "komma ikapp" moment.

Den lilla erfarenhet jag har lyckats skaffat mig om enhetestester tyder på att de kan vara värdefulla från första testet. Även då kodteckningen är låg har vissa tester hjälpt mig att hitta svårupptäckta logiska buggar jag inte ens visste att jag hade, alternativt hjälpt mig få bort buggar redan innan jag testat något i webbläsaren.

Jag tycker att det är synd att enhetstester har behandlats som något som läggs till i efterhand i de senaste två kurserna. Att lära sig skriva tester som ett hjälpmedel medan man utvecklar tror jag kan ge en positivare attityd till enhetstester. Tester blir inte lika lätt en pålaga som man ska skriva när det känns som om man är färdig utan ett verktyg som man använder under utvecklingen på vägen till att bli färdig.

Jag tror att enhetstester skulle kunna integreras bättre i kurserna. Skippa tanken på att ha så hög kodteckning som möjligt. Lär istället ut hur vi kan använda tester för att testa funktioner och metoder som vi är osäkra på eller hur vi kan identifiera och testa mer kritiska funktioner och metoder.

CI har jag inte använt tidigare men nu när jag testat är känslan att självklart vill jag jobba med CI.

### Hur ser du på begreppen, bra, onödigt, nödvändigt, tidskrävande?
Jag tror att det kan kännas onödigt och framför allt tidskrävande när det görs som en pålaga i efterhand. Däremot tror jag att det är tidsbesparande i ett lite större projekt då jag tror tester kan förkorta buggletandet och underlätta vid refaktorering. Personligen tycker jag även att tester kan vara en bra form av dokumentation när man ska lära sig en kodbas.

Som sagt tror jag även att man kan lära sig att ha tester som ett naturligt verktyg under utvecklingen och då blir frågan om det är tidskrävande en ickefråga.

Jag är inte säker på att det är nödvändigt. Det beror på syftet med vad du skriver och vilka kvalitetskrav som är uppsatta för projektet.

### Hur stor kodtäckning lyckades du uppnå i din modul?
Jag har 100% kodteckning på de klasser som utgör kärnan i min modul. På databas-klassen som är inkluderad har jag inte skrivit 100% tester. Det är egentligen inte meningen att slutanvändaren av modulen ska använda databas-klassen utan denne bör använda en egen klass.

### Berätta hur det gick att integrera mot de olika externa tjänsterna?
Det var inga problem och gick väldigt smidigt. Förutom Travis, CircleCI och Scrutinizer lade jag till en tjänst som heter CodeScene från ett Malmö-baserat företag. CodeScene är lite annorlunda och baseras på tankarna i en bok som heter "Your code as a crime scene" av Adam Tornhill. Jag har bara precis skrapat på ytan av vad analysen hos CodeScene kan ge och jag bör väl se någon av Adam Tornhills föreläsningar för att kunna förstå och uppskatta analysen.

### Vilken extern tjänst uppskattade du mest, eller har du förslag på ytterligare externa tjänster att använda?
Jag tycker såhär långt bäst om Travis. Förmodligen för att det är rättframt och enkelt att förstå vad som händer.
