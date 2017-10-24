
## Kmom10

I mitt projekt, dbwebb-students funktionella studiegrupp, har jag valt att hämta min inspiration från reddit snarare än från stackoverflow. Tanken är att det ska likna en subreddit. Istället för frågor och svar och eventulla kommentarer på svar finns det, liknande reddit, en uppdelning mellan inlägg och frågor (reddit har uppdelning mellan inlägg och länkar.) Varje fråga och inlägg kan kommenteras. Kommentarerna är nästlade så att man kan följa diskussionstrådar.

### Krav 1-3

Det går bra att läsa på forumet oinloggad. Om man vill interagera, posta, kommentera eller rösta behöver man logga in. Det går registrera sig själv som användare.

Förstasidan presenterar i stort sett hela forumet på en gång med alla inlägg och frågor listade. Det går att välja att visa bara inlägg eller bara frågor i en navbar. 

De populäraste taggarna är alltid listade högst upp på alla sidor. Layouten har också en bar till höger där de användare med högst "cred" finns listade och en länk till "Om"-sidan. Layouten har en egen kontroller som körs för samtliga routes och som ser till att sätta upp saker som sidobaren och den dynamiska loginknappen.

Taggarna fick en egen kontroller då taggarna även har egna sidor. Tag-kontrollern körs också för samtliga routes för att sätta toptaggarna högst upp på sidan.

Markdown fungerar för både inlägg, frågor och kommentarer och jag har använt HTML-purifier för att tvätta markdown.

Användare kan editera och radera sina egna inlägg och frågor. Kommentarer kan däremot inte raderas utan bara editeras för att inte förstöra en eventuell diskussionstråd. Har användaren skrivit något så illa att det behöver raderas får hen radera texten istället för hela kommentaren. Inlägg, frågor och kommentarer tidstämplas vid skapande och uppdatering.

Taggar skrivs i klartext när man skapar sitt inlägg eller fråga och går också att editera om man editerar frågan eller inlägget.

Klickar man på en användare får man upp en sida med användarinfo med "cred" och en lista på inlägg, frågor och kommentarer som användaren gjort.

Det finns ett enkelt administratörsgränssnitt för att administrera användare. Administratörer kan skapa användare, kan befordra användare till administratörer och har möjlighet att stänga inloggningsmöjlighet för användare. Vidare kan administratörer editera alla inlägg och kommentarer.

Jag valde att använda en sqlite-databas då detta gör att jag får samma databasmiljö lokalt som på studentservern. Det blir också enkelt att  installera från github-repot.

Projektet finns på github med badges för travis och scrutinizer.

### Krav 4
Projektbeskrivningen har tydligt tagit inspiration från stackoverflow medan jag ville bygga ett reddit eller hacker-news inspirerat forum. På dessa forum har jag inte sett någon variant av accepterat svar. Istället implementerade jag att den som skrivit inlägget/frågan kan toggla en markering av kommentarer och detta får fungera som ett "accepterat svar" eller mer som en "det här tyckte jag som inläggsförfattare var bra".

Precis som på Medium kan man ge flera poäng om man tycker att ett inlägg eller kommentar var riktigt bra och inspirerad av reddit lät jag poängsorteringen använda poängen för första kommentaren för att sorta. Sorteras enligt poäng kommer även varje nästlad nivå av kommentarer att sorteras på poäng men trådar hänger fortfarande samman.

I översikten summeras poängen för samtliga kommentarer med poängen för inlägget/frågan.

### Krav 5
I appen kallas poängen för cred och det mesta man gör i forumet kan ge cred. Användaren får 1 poäng för att rösta upp. Att skriva inlägg/fråga/kommentar ger 5p + poängen på inlägget/frågan. För att minska negativiteten får användaren minuspoäng vid negativa röster.

Användarna har en publik profil som visar cred, inlägg/frågor och kommentarer. I den högra baren finns de fem användare med högst cred listade i fallande cred-ordning.

### Krav 6
Jag hade en del idéer om vad jag skulle göra som krav 6 men tiden rann iväg och det blev ett litet potpurri av saker som jag ansåg sidan behövde eller som jag ville repetera från tidigare kurser.

Kommentarerna behövde kunna skrivas och editeras på plats. Detta skrev jag i vanilla, dom-manipulerande, javascript som jag kände att jag borde repetera (knappt någon dom-manipulation sedan javascript1 för snart 2 år sedan). Interaktionen mellan de rekursivt genererade php-vyerna och javascriptet tog en stund att reda ut.

Att riktigt tvätta sin output när det ska vara markdown är inte helt trivialt.  Att köra htmlentities, strip-tags eller liknande innan man konvertera till markdown ser vid en första anblick ut att fungera. Om man inte skriver kodblock, för då blir allt inom kodblocken tvättat ("escapat") två gånger och outputen motsvarar inte det man tänkt sig. I ett forum som handlar om programmering är detta ganska illa. Många googlingar, stackoverflow-svar och ett par artiklar senare var jag inte helt klok på hur jag skulle lösa det men enligt råden skulle jag i alla fall inte försöka göra det manuellt med regex. Det slutade med att jag kollade upp och inkorporerade HTML-purifier som jag kör efter att outputen har konverterats till markdown.

För att kunna skapa ett reddit-liknande forum måste jag ha nästlade kommentarer. Det tog en stund att reda ut. Jag åstadkommer utskriften av de nästlade kommentarerna genom att gruppera kommentarerna på sin föräldrakommentar och sedan använda rekursiva vy-filer (php-filer som inkluderas rekursivt) för att rendera kommentarerna. PHP har ingen funktion för att gruppera associativa arrayer så jag använder Laravel-collections för detta (och en del annat).

Att kunna administrera användare fanns inte i kraven men jag valde att inkorporerade användarhanteringen, lätt modifierad, från tidigare kursmoment.

De tre senaste kurserna har jag använt bootstrap med allt som det ger gratis och har känt att mina css och less kunskaper behöver repeteras. Därför har jag inte använt något css-ramverk utan stylat appen för hand i less. Då jag hört mycket gott om laravel-mix för att kompilera sina assets valde jag att använda det. Som en bonus kunde jag då skriva min javascript med ES2015 syntax och fick även en liten titt på webpack.

### Allmänt
Det är spännande hur man lär sig allt eftersom. Jag tyckte det var tajt med tid för projektet och återanvände en del från min me-sida. Där fanns en struktur på saker som började från kmom03 (i kursens betaversion) innan vi skulle testa active record. Min användarhantering använder därför inte active record jag hittade inte tid för den refaktoreringen. Sedan är modellagret för inlägg och kommentarer skrivet med ett mellanlager mellan controller och active-record modellen, i vissa fall har detta gjort att kontrollern har kunnat bli tunnare men i andra fall blir det bara ett mellanlager som bara skickar vidare till nästa klass. Dessa mellanlager skulle jag nog också velat refaktorera bort.

Att så mycket av det som vi ska använda är i stort sett odokumenterat gör absolut sitt till att kodbasen i projektet fått blandade tekniker. Jag hittar nya sätt att göra saker allt eftersom jag tvingas in i ramverkets kod för att läsa och lära samt att nya versioner av ramverkets delar ibland kommit snabbare än jag hunnit refaktorera.

Att hålla en konsekvent kodstil genom ett projekt är nånting som jag behöver träna på. Jag behöver nog oftare skriva ner vilka val jag gör angående kodstil (tex om jag ska strunta i magic di eftersom halva kodbasen redan använder den gamla di), alternativt använda en strängare linter. Samtidigt väljer jag att ta ut svängarna i dessa skolprojekt då vi ändå är här för att lära.

Jag tyckte projektet kändes stressigt och det är mycket som jag skulle velat refaktorera och annat jag helt skulle vilja skriva om

### Tankar kring kursen
Jag måste säga att jag i stort sett är nöjd med kursen. Materialet, speciellt till och med kmom04, var riktigt bra. Något som jag hade önskat att vi använt, och fått lära oss att använda, är tester som ett verktyg i utvecklingen istället för något som läggs på i efterhand.

Ibland blir jag frustrerad över storleken på uppgifterna kontra den tid som finns tillgänglig. Samtidigt får jag erfarenhet och förhoppningsvis ringer det en varningsklocka nästa gång jag ska göra något liknande. Frustrationen över att inte hinna refaktorera och skruva på saker tills man är helt nöjd kan ju också ställas mot kravet att faktiskt leverera. En perfekt app som aldrig lämnar utvecklarens egen dator är väl analogt med fåglarna i skogen kontra den enda i handen.

Jag skulle absolut rekommendera kursen och ger en 8/10.