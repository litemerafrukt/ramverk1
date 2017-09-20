---
title: "Kmom04 - rapport"
...

Utkast
===========================================

Jag gjorde hela uppgiften med användare och admin under kmom03 och ändrade inte allt enligt det nya systemet med klass-formulär och active record. Det får vänta till projektet. Nu är det en härlig blandning av gammalt och nytt i mitt anax-projekt.

När jag gjorde kommentarsystemet med active record tänkte jag på hur antagandet att man kan modellera den "vanliga" världen med hjälp av oop ofta ganska tidigt faller ihop. Om jag skulle följa exemplet från `Book` skulle jag döpa min klass till `Comment` men där ligger en `findAll` metod och sabbar hela abstraktionen. Hur kan det höra till en separat kommentar att kunna hitta samtliga kommentarer? Om jag istället döper klassen till `Comments`, då faller abstraktionen med att kunna sätta värden på en enskild kommentar.
