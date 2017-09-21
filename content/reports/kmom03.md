---
title: "Kmom03 - rapport"
...

## Kmom03
När jag gjorde uppgifterna i kmom03 var en av uppgifterna att lägga till användare och ett administratörsinterface. Detta lade jag till ungefär som jag gjort i oophp med PDO och databasklasser. Jag märkte direkt att strukturen blev bättre, utan någon speciell ansträngning, bara genom att jag använde MVC-mönstret. Det blev bland annat lättare att se hur jag kunde återanvända modeller mellan olika kontroller.

### Hur känns det att jobba med begreppen kring dependency injection, service locator och lazy loading?
Själva användningen av `$di` kontra `$app` skiljer sig inte speciellt mycket även om jag använder det PSR-11 kompatibla mönstret med `$di->get()`

Intressant att notera när man läser PSR-11, "Container Interface", är att vi använder `$di` som service locator vilket inte rekommenderas (SHOULD NOT). Wikipedia-artikeln till kursmomentet tar också upp att det av somliga ses som ett "anti-pattern" att använda en service locator. Jag har lite svårt att se de nackdelar som tas upp i wikipedia-artikeln om service locator. Till exempel att man kan skjuta problem från kompilation till runtime gäller inte för PHP. Kanske gör det också skillnad i hur PHP körs, varje request är en separat körning och inget korrupt state kan smyga sig in och ställa till det för nästa request.

Än så länge tycker jag om di-containern och tycker den tillför en bra struktur. Dock skulle jag behöva dela upp initierandet av de olika tjänsterna i fler filer för att få en bättre översikt.

### Hur känns det att göra dig av med beroendet till $app, blir $id bättre?
Jag ser ingen större skillnad i att mina klasser är beroende av `$di` istället för `$app`. Med lite repetition av regex kunde min editor genomföra större delen av ändringen från `$app` till `$di` på egen hand. Det blev lite handpåläggning efter konverteringen men i stort sett gick det smidigt och jag refaktorerade bort hela `App`-klassen.

### Hur känns det att återigen göra refaktoring på din me-sida, blir det förbättringar på kodstrukturen, eller bara annorlunda?
Vad gäller routrarna har jag ännu så länge svårt att se hur det blev bättre. Vi visades ju redan under kmom02 hur man kan använda kontroller-klasser i sina router även enligt tidigare system. Just nu är känslan att det mest blev komplicerat i onödan.

### Lyckades du införa begreppen kring DI när du vidareutvecklade ditt kommentarssystem?
Jag använder DI-containern där jag anser att den behövs. Däremot försöker jag att injekta enstaka beroenden vid klass instansiering istället för hela DI när inte hela ramverket behöver ha tillgång till ett objekt.

### Påbörjade du arbetet (hur gick det) med databasmodellen eller avvaktar du till kommande kmom?
Detta ingick inte i kmom03 när jag skrev det. Istället skrev jag hela hanteringen av användare, administratörer och administratörsinterfacet. Jag kunde kika på det jag gjort i oophp när jag skrev denna uppgift men jag ville ha in koden i ett MVC-mönster och blev det bara nyskriven kod.

Användare och administratörer kopplade jag ihop med kommentarssystemet från kmom02 så att endast inloggade användare kan skriva kommentarer och administrera sina egna kommentarer. Administratörer kan även editera och ta bort kommentarer för andra användare.

### Allmänna kommentarer kring din me-sida och dess kodstruktur?
Kodstrukturen på min me-sida håller fortfarande ihop bra. Jämfört med oophp känns det lättare att hitta runt bland koden. Sedan om det beror på att det är tredje kursen med anax eller det mer uttalade MVC-mönstret är lite svårt att veta.

Vissa av mina egna val vad gäller kodstruktur skiljer sig från övningsexemplen. Detta kan visa sig besvärligt framöver om tex en scaffold förutsätter viss struktur.
