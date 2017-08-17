---
title: "Kursmomentsrapporter"
...
Kursmomentsrapporter
=========================

## Kmom01


### Gör din egen kunskapsinventering baserat på PHP The Right Way, berätta om dina styrkor och svagheter som du vill förstärka under det kommande året.

Jag läste PHP The Right Way inför htmlphp-kursen för ett år sedan så innehållet är inte nytt.

Vad gäller kunskapsinventering är det väl så att det mesta i dokumentet känner jag till men mycket av det är sådant som jag inte alls har använt.

Jag har massor kvar att lära. Saker som PHP The Right Way tar upp och som jag faktiskt har testat/använt, där är jag fortfarande novice. Sådant jag endast känner till är jag inte ens det. Någon väldigt specifik svaghet tycker jag är svår att identifiera utifrån ett dokument som PHP The Right Way. Det är en mer generell oerfarenhet. Det tar tid att lära sig och det som behöver till är att göra och testa.

Vad gäller konkreta saker ur dokumentet som jag vill förstärka under det kommande året är det framför allt allmängiltiga saker snarare än specifikt för PHP. Jag vill bli bättre på tester och jag skulle vilja lära mig att arbeta enligt TDD. Säkerhet är ett annat område som jag behöver bli bättre på, både generellt och specifikt för PHP. Docker skulle jag vilja kunna.

Jag vet inte hur mycket PHP jag kommer att skriva framöver. Jag har en PHP-kurs kvar (denna) och även om det är svårt att sia om framtiden ser det ut som att javascript är mer efterfrågat än PHP här i Skåne (av de språk vi läser inom programmet).

### Vilket blev resultatet från din mini-undersökning om vilka ramverk som för närvarande är mest populära inom PHP (ange källa var du fann informationen)?
För ett par månader sedan dök det upp en artikel i min inbox med titeln [The State of PHP MVC Frameworks 2017](https://www.sitepoint.com/the-state-of-php-mvc-frameworks-in-2017/). Där beskriver författaren läget för PHP ramverk som:
1. Symfony eller Laravel
2. Resten

Detta stämmer väl med min egen bekräftelsefördom (confirmation bias). Det känns som om alla vägar leder mot Laravel och skulle du vilja välja något annat så välj Symfony. Som PHP-utvecklare i vardande har jag tyckt att Laravel har dykt upp överallt i tutorials och artiklar.

Laravel har till synes ett ordentligt momentum och verkar springa ifrån övriga, även symfony, i intresse. Jag tror att en viktig anledning kan vara den utomordentliga dokumentation och det läromaterial som finns till och om Laravel. Laracasts, en sajt med instruktionsvideor, kan ta dig hela vägen från nybörjare i PHP till Laravelutvecklare. Videorna spänner över allt ifrån att komma igång med PHP till avancerade tutorials om att bygga hela forum enligt TDD i Laravel. Communityn kring Laravel verkar också väldigt välkomnande och söker man efter aktuella PHP podcasts är de flesta riktade mot just Laravel.

### Berätta om din syn/erfarenhet generellt kring communities och specifikt communities inom opensource och programmeringsdomänen.

Generellt vad gäller communitys ligger det närmast, för mig, att jämföra med Ingress-communityn. Ingress är ett ganska simpelt augmented reality spel (från Niantic, de som som gjort Pokemon Go) och blir ganska snart ointressant om det inte hade varit för de communities som bildas kring spelet. Det är communityn som får spelare att hänga kvar och fortsätta. Inte sällan är det också någon i communityn som rekryterar nya spelare.

Jag tror att det kan vara en likande situation vad gäller opensource. Vill man få spridning för sitt opensourceprojekt behövs det en community. En community kan se till att sprida kunskap om projektet och hjälpa till med teknisk kunskap när inte dokumentationen räcker till. Att människor skriver om ett projekt kommer att göra att fler vågar testa.

### PHP Community
PHP har funnits i mer än 20 år och driver ca 80% av webben. Det är fantastiskt mycket PHP. Enligt videon finns uppskattningsvis 5 miljoner PHP utvecklare i världen.

I videon talar Elia om att det inte finns usergroups för C och Assembler för att sedan själv konstatera att det gör det nog i alla fall. Förmodligen är dessa specifikt inriktade mot att tex lära sig tekniken, något specialområde eller mot olika projekt. Med tanke på PHP:s storlek måste man räkna med att PHP-communityn är på väg åt samma håll. Med den synen på PHP-communityn skiljer sig inte längre PHP mot C eller Assembler.

PHP "core" community är bara en av många PHP communitys. Jag skulle ritat Elias cirklar över PHP-communityn annorlunda. En yttre, övergripande ring, som består av PHP användare, i denna ring ett antal mindre bubblor med olika communitys; Drupal, Symfony, Laravel och så vidare. I den övergripande bubblan är "core"-communityn bara en av många. Det måste bli så när en community växer sig så stor som PHP-communityn.

Samtidigt är PHP, som Elias också tar upp i videon, annorlunda mot nästan alla andra programmeringsspråk i och med det att PHP försöker ha en demokratisk process vad gäller framtiden för språket. Där finns ingen "Benevolent dictator for life" eller annan central grupp som har sista rösten. Men för majoriteten av de 5 miljoner PHP-användarna spelar detta förmodligen ingen roll. Sett från lite avstånd känns det som om påverkansmöjligheten för den vanliga PHP-användaren ligger på en liknande nivå som för den vanlige Python-användaren vad gäller att kunna påverka språkets utveckling.

### Vad tror du om begreppet “en ramverkslös värld” som framfördes i videon?
Spontant tycker jag att det låter ganska vackert. När jag sedan funderar på vad det kan innebära konkret blir jag mer tveksam.

Jag har läst en del av PHP fig-dokumenten (PSR). De jag tittat på definierar gränssnitt för olika delar av ramverkskomponenter med intentionen att standardisera gränssnitten. Detta skulle kunna liknas vid ett meta-ramverk, ett ramverk för ramverken att hålla sig till. Det ger ingen ramverkslös värld. Det ger konformitet. PHP-figs PSR dokument ser ut att innehålla bra saker men jag förstår om ramverksbyggare kan välja att inte hålla sig till dessa om de anser att det är bättre att göra på något annat sätt.

Att använda ett ramverk tror jag ofta kan vara en bra ide. I Michael Collums keynote, ca 5 minuter in, när han berättar om Symfony 1, säger han själv: "so we could stop using all those homegrown frameworks we started to build". Jag tycker det säger massor. Ett ramverk kan ge stadga. Använder vi ett ramverk kan styra upp och ha färdiga svar på frågor som dyker upp. Frågor som annars måste lösas "homegrown".

Ramverkslöshet tror jag till exempel är en del av "javascript fatigue". Många utvecklar till exempel med React men React är bara en del i ett större projekt. Du måste själv välja andra komponenter och det finns massor med alternativ. Hur ska man värdera och välja? Sedan har du massor med val att göra vad gäller din byggkedja osv. Nu är förvisso en del av javascript fatigue att det finns en sådan uppsjö av ramverk till att börja med.

Det går inte att vara expert på allt. Att någon annan redan har valt, förhoppningsvis på bra grund, ger dig frihet att fokusera på annat.

Jag lärde mig ett nytt uttryck under sommaren, ["raka yak"](http://www.hanselman.com/blog/YakShavingDefinedIllGetThatDoneAsSoonAsIShaveThisYak.aspx). Att använda ett ramverk där många val redan är gjorda och många frågor redan är besvarade ger dig färre yakar att raka.

### Forumförberedelse
Jag började fundera över vilket slags forum jag skulle vilja bygga. Hacker News och Redit är personliga favoriter. Jag gillar formatet som dessa sajter har och tycker att det är lättare att få översikt över en tråd i dessa forum jämfört med forum som exempelvis på dbwebb. Dessutom har jag en fetish för brutalistisk webdesign vilket speciellt Hacker News är ett bra exempel på.

Förutom att fundera över hur mitt önskeforumsprojekt kan tänkas fungera och se ut, tittade jag på en del videor där videomakaren bygger forum i PHP. Bland annat [Laracasts](http://laracasts.com) har en ambitös serie om hur man bygger ett forum med TDD i Laravel. Det blir ganska stora skillnader att bygga ett forum i Anax men på ett meta-plan upp är det ungefär samma sak.

### Allmänt
Jag uppskattar verkligen att redan i kmom01 få en hint om vad vi ska göra i projektet. Ställtiden för att komma igång när jag väl är på kmom10 kan förkortas avsevärt.

### Me-sidan
Jag integrerade laravel-mix för att, med hjälp av webpack, kompilera ihop mina assets, less till css och ES6 till ES5. Tyvärr fungerar inte uglifyjs med Ecmascript2015 så jag gjorde en workaround genom att använda typescript istället för javascript.

För att repetera less och lite javascript har jag valt att inte använda något css-ramverk utan att istället skriva det själv. Jag plockade i och för sig in typografin från design-kursen för att få texten snyggar. I javascript har jag bara gjort så att en enkel responsiv meny fungerar.

## Kmom02

### Utkast
När jag integrerade rem-servern skrev jag om en del, gjorde koden till min, men behöll strukturen.

### MVC
När jag skrev ihop kommentarsprototypen tänkte jag på att kontrollern borde höra ihop med appen snarare än klasserna som hör ihop med modellen. Därför har jag lagt alla mina, två så här långt, kontroller under en egen namespace.
