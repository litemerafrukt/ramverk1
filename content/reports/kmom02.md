---
title: "Kmom02 -rapport"
...

## Kmom02

### Vilka tidigare erfarenheter har du av MVC? Använde du någon speciell källa för att läsa på om MVC? Kan du med egna ord förklara någon fördel med kontroller/modell-begreppet, så som du ser på det?
Jag började titta på MVC-begreppet under webbappskursen som jag gick 2016. Där använde vi mithril version 0.2.0 och då stod det en del om MVC i dokumentationen. Varje mithril-komponent hade till exempel en controller. Då MVC var helt nytt för mig så läste jag på om det och diskuterade en del med webbutvecklare och lärare. Tyvärr fick jag då inga riktigt bra svar. Ett av råden jag fick var att bygga min app enligt MVW, Model View Whatever. Detta kan ha berott på kontexten, single page application med komponenter. Som jag har förstått det talas det allt mindre om MVC-arkitektur på frontend utan mer om enkelriktat dataflöde och deklarativ programmering (ex [Is Model-View-Controller dead on the front end?](https://medium.freecodecamp.org/is-mvc-dead-for-the-frontend-35b4d1fe39ec)). Sedan har jag börjat misstänka att  artiklar om MVC:s död på frontend kan bottna i olika tolkningar av vad MVC är eller kan vara.

Efter min första förvirring runt MVC-arkitekturen började jag titta på PHP-ramverket Laravel. MVC i Laravel verkar vara implementerat på ett likande sätt som i Anax (och som i Ruby on Rails om jag förstått rätt).

![mvc i anax](https://dbwebb.se/image/phpmvc/mvc_start.png)

Denna struktur är ganska enkel att förstå i ett fallet med en app som renderas på servern. Precis som mos skriver i vår kursartikel kan kontrollern här ses som ett slags lim som klistrar ihop begäran från request, data från modellen med en vy för att presentera ett response.

Men en sådan syn på MVC stämmer inte riktigt med presentationen av MVC på tex [wikipedia](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller). Där presenteras ett annat schema över MVC med ett dataflöde som är mer enkelriktat (och det är även vad som skrivs wikipedia artikeln). Samtidigt står i wikipedia-artikeln att MVC-mönstret är vanligt i webbappar och implementeras i många ramverk. Artiklar som; [Flux med redux och react](https://dbwebb.se/kunskap/flux-med-redux-och-react) och [Model View Confusion](https://r.je/views-are-not-templates.html) tillsammans med stackoverflow svar som [detta](https://stackoverflow.com/a/1947268) tycker jag målar en bild av att man inte alltid talar om samma sak när man talar om MVC.

Ser man på historien av MVC som implementerat i en desktopmiljö med kontrollern i en position mellan användaren och modellen men inte mellan modellen och vyn tycker jag att det liknar arkitekturen med react-redux mer än det sätt MVC ofta är implementerat i server-side appar.

Fördelen med MVC måste ju ställas i relation till vilken implementation man talar om. Generellt anser jag dock att MVC-arkitekturen ger en bra separation av ansvar i en applikation samtidigt som den är lätt att förstå. Av de två tolkningarna av MVC som verkar finnas inom webbutveckling tycker jag speciellt om den med enkelriktat dataflöde vilket jag tycker ger en struktur som är lätt att resonera kring, både i sin helhet och de separata delarna. Även tolkningen med kontrollern som ett slags lim tycker jag ger en stadga åt resonerandet kring vad som händer i en app. Förutom att isolera händelser och datamanipulation i mer greppbara storlekar kan uppdelningen i delar även underlätta uppdelningen i arbete. Detta tycker jag inte bara är en fördel när flera personer ska arbete på samma app (vilket jag egentligen aldrig gjort) utan även som ensam utvecklare ger det mig en möjlighet att fokusera på ett område åt gången.

### Kom du fram till vad begreppet SOLID innebar och vilka källor använde du? Kan du förklara SOLID på ett par rader med dina egna ord?
Jag har jobbat med att förstå varför objektorienterad programmering är det förhärskande paradigmet sedan vi hade oopythonkursen. Kanske är det så enkelt som mos antydde i en stream i våras, det är tillräckligt lätt att förstå objektorienterad design för att snabbt få produktiva programmerare. Men jag tror egentligen inte det. Jag tror att objektorienterad design kan vara mer än modulariserad imperativ kod och jag tror att SOLID är ett sätt att försöka lyfta det dit.

SOLID principerna får nog sägas vara en av grundpelarna i objektorienterad design. Samtidigt verkar de inte helt lätta att sammanfatta och förklara på ett par rader. Videon med Gareth Ellis är en timme lång och där hinner han faktiskt ge en översikt över alla fem principerna. Flera föreläsningar som jag tittat på i ämnet SOLID hinner knappt förbi S, single responsibility principle.

* S, en klass skall ha bara ett skäl att ändras. Blanda inte ihop olika saker i samma klass. Tex en klass för att formatera ett email ska inte veta hur ett mail ska skickas då de båda uppgifterna kan ändras oberoende av varandra.
* O, öppen för utökning men stängd för modifikation. Som Ellis beskrev, du ska kunna få en viss sorts anka att låta väldigt underligt utan att gå in och modifiera koden för ankor generellt.
* L, Liskovs substitution. Att ett objekt av en subklass skall kunna användas istället för ett objekt av basklassen. Låter enkelt och rättframt i teorin men går säkert att trolla bort i praktiken.
* I, interface separation. Ett objekt eller en klass som använder en annan klass eller objekt ska inte behöva vara beroende av metoder som den inte använder. Den här principen skulle jag behöva se fler exempel kring, framför allt brott mot. På ett plan säger det sig själv, men har någon känt ett behov att göra det till en princip misstänker jag att det inte är så självklart egentligen.
* D, omvänt beroende. Istället för att dina klasser är beroende av en specifik implementation kan du definiera ett kontrakt som den specifika implementationen måste uppfylla. Då kan du byta implementation så länge som den nya implementationen uppfyller kontraktet.

Kanske oop inte är helt lätt när allt kommer omkring?

Källor som jag använt i mitt utforskande av objektorienterad design är framför allt föreläsningar från olika konferanser. Speciellt Robert Martin och Sandi Metz tycker jag har bra föreläsningar om objektorientering. Utöver youtube håller jag på att jobba igenom boken [99 bottles of oop](https://www.sandimetz.com/99bottles/) av just Sandi Metz.

### Gick arbetet med REM servern bra och du lyckades integrera den i din me-sida?
Det gick bra. När jag integrerade REM-servern skrev jag om den lite bara för att bättre förstå hur den fungerade men jag behöll den övergripande strukturen.

### Berätta om arbetet med din kommentarsmodul, hur långt har du kommit och hur tänker du?
När jag skrev ihop kommentarsprototypen tänkte jag på att kontrollern borde höra ihop med appen snarare än klasserna som hör ihop med modellen. Därför har jag lagt alla mina, två så här långt, kontroller under en egen namespace.

Jag valde att följa de föreslagna kraven och jag använder session-storage. Det var inga problem med att skriva kommentarsmodulen, speciellt när jag använder session storage liknar modulen remservern ganska mycket.

Jag försökte att optimera för framtida arkitektur genom att använda två klasser i modellagret där den undre bara ska vara ett interface mot valt lagringssätt. Tanken är att det ska vara så lite som möjligt som behöver bytas ut/skrivas om när session ska bytas mot en databas. Kmom04 får visa om det fungerar. Jag misstänker att det kommer att bli ett typexempel på fallerad förtida arkitekturoptimering.
