---
title: "Kursmomentsrapporter"
...
Kursmomentsrapporter
=========================

## Kmom01
I Michael Collums keynote, ca 5 minuter in, när han berättar om Symfony 1 säger han sjäv "so we could stop using all those homegrown frameworks we started to build". Säger en massa. Ett ramverk kan ge stadga. Använder vi ett ramverk kan detta styra upp och ha svar på frågor som dyker upp. Frågor som annars måste lösas "homegrown".

Jmf javascript fatuige. Att alltid behöva välja. Raka Yak!!!
Jmf PHP standard lib.
Jmf PHP med C.
Ramar ger ofta kreativitet.
Inte uppfinna allt om och om igen.
Kod som är mycket använd bör ha en större chans att vara buggfri och säkrare. Dock inte alltid, se heartbleed.

### Comunity
PHP har funnits i mer än 20 år och driver ca 80% av webben. Det är fantastiskt mycket PHP. Enligt videon finns uppskattningsvis 5 miljoner PHP utvecklare i världen.

I videon talar Elia om att det inte finns usergroups för C och Assembler för att sedan själv konstatera att det gör det nog i alla fall. Förmodligen är dessa specifikt inriktade mot att tex lära sig tekniken, något specialområde eller mot ett projekt. Jag anser nog att med tanke på PHP:s storlek måste man räkna med att PHP-communityn är på väg, och till viss del redan är där, åt samma håll. Med det synen på communityn skilljer sig inte längre PHP mot C eller Assembler.

PHP "core" community är bara en av många PHP communitys. Jag skulle ritat Elias cirklar över PHP-communityn annorlunda. En yttre, övergripande ring, som består av PHP användare, i denna ring ett antal mindre bubblor med olika communitys, Drupal, Symfony, Laravel och så vidare. I den övergripande bubblan är "core"-communityn bara en av många. Det måste nästan bli så när en community växer sig så stor som PHP-communityn.

Samtidigt är PHP, som Elias tar upp i videon, annorlunda mot nästan alla andra programmeringsspråk i och med det att PHP försöker ha en hyggligt demokratisk process vad gäller framtiden för språket, där finns ingen "Benevolent dictator for life" eller annan central grupp som har sista rösten. För majoriteten av de 5 miljoner användarna av PHP spelar dock detta inte speciellt stor roll och sett från 10000 meter känns det som om påverkansmöjligheten för den vanliga PHP-användaren ligger på en liknande nivå som för den vanlige Python-användaren att kunna påverka.

Vad gäller videon med Elias får jag känslan av att han är lite nostalgisk för hur det var en gång.

### PHP the right way
Jag har ingen aning om PHP kommer att vara vad jag jobbar med om ett år, förmodligen kommer inte ens mitt exjobb att vara inom PHP. Därför satsar jag på sådant som jag anser är allmängiltigt, tdd tex.

### Forumförberedelse
Jag började fundera över vad för slags forum jag skulle vilja bygga. Hacker News och Redit är personliga favoriter. Jag gillar formatet som dessa sajter har och tycker att det är lättare att få översikt över en tråd i dessa forum jämfört med forumet på dbwebb. Dessutom har jag en fetish för brutalistisk webdesign vilket speciellt Hacker News är ett bra exempel på.

Förutom att fundera över hur mitt önskeforumsprojekt kan tänkas fungera och se ut tittade jag även på en del videor där videomakaren bygger forum i PHP. Bland annat [laracasts](http://laracasts.com) har en ambitös serie om hur man bygger ett forum med TDD i Laravel. Det blir ganska stora skillnader att bygga ett forum i Anax men ett meta-plan upp är det ungefär samma sak.

### Allmänt
Jag uppskattar verkligen att redan i kmom01 få en hint om vad vi ska göra i projektet. Ställtiden för att komma igång när jag väl är på kmom10 kan förkortas avsevärt.

### Me-sidan
Jag integrerade laravel-mix för att, med hjälp av webbpack, kompilera ihop mina assets, less till css och ES6 till ES5.
