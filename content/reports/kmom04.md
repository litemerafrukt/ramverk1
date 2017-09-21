---
title: "Kmom04 - rapport"
...

## Kmom04

### Hur gick det att integrera formulärhantering och databashantering i ditt kommentarssystem?
Jag har inte genomfört ändringarna till `HTMLForm` och active record i hela me-sidan. Vad gäller `HTMLForm` så ändrade jag mina användarformulär till att använda det nya formulärsystemet. Efter lite initialt pyssel blev det ganska bra och jag tror att jag absolut kommer att trivas med en sådan formulärhantering.

### Berätta om din syn på Active record och liknande upplägg, ser du fördelar och nackdelar?
Första gången jag använde något liknande var under oopython när vi använde SQLAlchemy och jag gillade det skarpt. Det känns mer i linje med vad vi vill uppnå med våra klasser och objekt. Det förenklar och förtydligar användandet av datastrukturerna. Dessutom känns det som om vi med active record tar bort stora stycken repetitiv kod som annars krävs för att läsa och skriva objekt mot databasen.

Vad gäller nackdelar har jag inte själv upplevt några ännu. I wikipedia-artikeln står om svårigheter att testa men samma svårighet uppstår väl alltid när klasser som skriver och läser en databas ska testas? Sedan argumenteras för att active record bryter mot "singel responsibility principle" men tills jag upplevt detta som ett problem tar jag det som ett teoretiskt funderande och som ett exempel på när det är bättre att koda än att hålla på principer.

### Utveckla din syn på koden du nu har i ramverket och din kommentars- och användarkod. Hur känns det?
Ännu så länge känns det fint. Jag hittar runt i koden och både routes och klasser ligger fint separerade och gör, oftast, inte allt för mycket. Den senaste refaktoreringen till formulärhantering och active record kan komma att stöka till det eftersom jag inte infört genomgående. Samtidigt ska vi bryta ut hela kommentarssystemet till en egen modul i nästa kursmoment vilket isolerar eventuella problem vid senare övergång till formulär och active record.

Generellt känns strukturen på me-sidan så här långt in på kursen betydligt stabilare än vid motsvarande kursmoment i oophp.

### Om du vill, och har kunskap om, kan du även berätta om din syn på ORM och designmönstret Data Mapper som är närbesläktade med Active Record. Du kanske har erfarenhet av likande upplägg i andra sammanhang?
Efter vad jag har förstått är Data Mapper och Active Record olika designmönster för att implementera en ORM. Men ännu så länge har jag inte kunskap nog för att kunna diskutera för och nackdelar med de olika designmönstren.

### Vad tror du om begreppet scaffolding, kan det vara något att kika mer på?
Jag tycker väldigt bra om scaffolding. Det kan vara väldigt kämpigt att börja med ett helt tomt ark. Även om man får någonting som behöver förändras en hel del kan det vara ett sätt att komma igång.
