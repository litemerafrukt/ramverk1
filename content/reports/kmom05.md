---
title: "Kmom05 - rapport"
...

## Kmom05


### Hur gick arbetet med att lyfta ut koden ur me-sidan och placera i en egen modul?
När jag tittade på de beroenden som mitt kommentarssystem från kmom04 hade på resten av me-sidan började jag fundera på om det var en lämplig sak att göra en modul av. Det kändes som att det lätt skulle bli en pusselbit som passar i ett enda pussel snarare än en legobit som kan användas till många byggen.

Ett arbetsflöde där det potentiellt ska kopieras filer vid var uppgradering av packet kändes mer som en scaffold än ett paket. Jag kan inte se att det är något fel att distribuera scaffolds genom packagist. Speciellt inte om man dessutom automatiserar scaffoldandet med tex make-script. (Jämför integreringen av remservern, från packagist, i kmom05 med integreringen av Book, från en Anax scaffold, i kmom04. Skillnaden finns i detaljerna men i stort är det nästan samma sak.)

Jag gillar Anax nya scaffolds och skulle här kunna göra min egen kommentars scaffold. Samtidigt lät det på uppgiften inte riktigt som att det skulle uppfattas som att vi skulle bygga en scaffold. En scaffold är en början och jag skulle nog vilja strippa bort en hel del från mina kommentarsklasser om det skulle bli en bra scaffold. Och skulle användardelen ingå? Eller skulle jag gå tillbaka till det läge som kommentarssystemet hade på kmom02? Och hur skulle jag isåfall integrera detta på ett snyggt sätt i min me-sida?

För att komma loss ur funderingarna bestämde jag mig för att försöka gå framåt istället. Då det talats om ett reddit-likanande forum i kmom10 började jag istället utveckla den "nästlade kommentarer på forumposter" funktion som finns på både reddit och hacker news.

Jag började skriva forum post kommentars funktionaliteten som en del av me-sidan och lyfte ut den när grundfunktionen fanns på plats. Det blev en hel del mer-arbete men jag hoppas det ska betala sig på i kmom10.

Då jag kunde bygga denna modul med färre krav på resten av me-sidan var det relativt enkelt att lyfta ut koden ur me-sidan.

### Flöt det på bra med GitHub och kopplingen till Packagist?
Det flöt på bra. Jag testade att lägga upp en del jag skrev under oophp på packagist så det var inte nytt.

### Hur gick det att åter installera modulen i din me-sida med composer, kunde du följa du din installationsmanual?
Då min me-sida redan hade de beroenden som paketet krävde i form av databastabeller och krav på databasklassen räckte det med en `composer require litemerafrukt/postcomments` för att allt skulle fungera.

### Hur väl lyckas du enhetstesta din modul och hur mycket kodtäckning fick du med?
Den modul som jag skrivit är inte speciellt besvärlig att enhetstesta. I SOLID-anda injiceras alla beroenden vid konstruktionen av objekten. Modulen behöver en liten databastabell och den skapas i en sqlite-databas i minnet vid testning.

Jag skrev bara några stycken tester i detta kursmoment och kodtäcknignen ligger på 74% för kommentarsklasserna och 36% för databasklassen.

### Några reflektioner över skillnaden med och utan modul?
Det blir krångligare när något skall läggas i en modul och jag ser inget direkt mervärde i att bryta upp delar som är appspecifika i moduler om inte dessa kan göras generella. Det blir merarbete och för att detta merarbete ska vara mödan värt behöver det vara en modul som faktiskt går att återanvända, finns ett behov av att återanvända och som är tillräckligt användarvänlig (utvecklaren är användaren i detta fallet).

Vissa saker passar alldeles utmärkt och bör ligga i en modul, har du en modul som liksom en legobit återanvänds i projekt efter projekt bör den läggas i en modul. Där skulle det bara vara det initiala merarbetet med att göra det till en modul. Att sedan kunna distribuera uppdateringar via packagist och bara göra en `composer update` för att uppdatera resten av projekten är helt lysande. Samma sak med en scaffold som används om och om igen. Dessa kan ju också distribueras via packagist men skillnaden är väl att när du väl börjat arbeta vidare från scaffolden är det inte längre speciellt lätt att uppdatera.

