---
title: "Kmom05 - rapport"
...

## Kmom05

Jag är inte säker på att jag håller med om att kommentarsmodulen passar som ett packagist paket. Det känns mer som något som passar för att vara en scaffold.

När jag räknade ihop vad min kommentars kontroller hade för dependencies på resten av ramverket (sju stycken) och då kändes det tydligt att kontrollern snarare var en del av appen än en del av ett fristående paket. Samtidigt kan jag hålla med mos om att kommentarspaketet inte blir mycket att ha utan kontrollern.

Min känsla är att en kontroller i en anax app tillhör appen snare än något som passar för att lägga i ett paket. Ta remservern som exempel, när denna ska integreras i appen behöver diverse filer kopieras till rätt plats i appen för att kontrollern ska fungera som den ska. Vad händer vid en uppdatering av paketet? Då ska detta åter igen kopieras och möjligen också modifieras på sätt som fungerar i just min app. Jag måste smälta att paket som de på packagist passar för detta, min känsla är att detta passar bättre som scaffolding.

---



Jag har skrivit kommentarsmodulen som en del av "appen" som utgörs av min me-sida. Detta har medfört många kopplingar mellan kommentarsfunktionaliteten och resten av appen.

En kommentarsmodul skulle likna en scaffold snarare än ett packagistpaket. Jämför tex integreringen av remservern, från packagist, i kmom05 med integreringen av Book, från scaffold, i kmom04. Skillnaden finns i detaljerna men i stort är det nästan samma sak. Att en kommentarsmodul skulle vara en scaffold understryks kanske ännu tydligare av inlägget i forumet som tipsar om att vi kan göra en make-fil som ser till att kopiera saker till sina rätta ställen för att underlätta integreringen.

Jag kan inte se att det är något fel att distribuera scaffolds genom packagist. Speciellt inte om man dessutom automatiserar scaffoldandet med script eller tex ett make-script.

Vad jag kände var att min kommentarsmodul inte längre passade för att bli en scaffold. En scaffold är en början, ofta rå, och även om jag inte kommit speciellt långt på min kommentarsmodul kände jag att göra denna till en scaffold skulle vara att gå baklänges.

Ett alternativ hade varit att ta kommentarsmodulen och strippa denna för att sedan göra scaffold som jag senare integrerade i min hemsida som en ny modul. Men detta lockade mig inte. Däremot har det hela tiden talats om att projektet ska bestå i en twitter, stackoverflow, hacker new eller reddit kopia. En sak som utmärker de tre senare alternativen är att där är inlägg som sedan kommenteras.

När jag satt och begrundade mina val insåg jag att min kommentarsmodul mest liknat den klassiska 90-tals gästboken snarare än någon slags forum. Då såg jag en utväg ur min motvilja att göra min befintliga kommentarsmodul till en scaffold genom att göra om kommentarsfunktionaliteten till något som mer liknar ett reddit forum och sedan nyutveckla en modul som skulle underlätta införandet av kommentarer på inlägg. Möjligen innebär detta en del merarbete men jag hoppas att detta ska kunna betala sig när vi kommer till projektet.

Det första jag gjorde var en förändring av befintlig kommentarsfunktionalitet till att funktionellt och semantiskt (i koden) vara inlägg. Sedan började jag med en enkel kommentarsfunktion för dessa inlägg. Detta skulle även innebära att det mesta av den nya koden skulle hamna i modell-lagret och jag skulle slippa en kontroller som naturligt (i alla fall vad jag sett av kontrollers i anax och laravel) har starka kopplingar in i resten av appen.
