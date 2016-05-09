<?php

/* 
Beschouw de volgende functie:

f(x) = f(x-1) + f(x-2)
waarbij f(0) = 1 en f(1) = 1 voor alle x >= 0

schrijf hiervoor een functie welke _het bewijs laat zien_ op het scherm dat f(10) = 55

hint:
  - schrijf de complete functieboom uit welke behoort bij f(x), bijv f(2)==> f(1) + f(0)
  - als er alleen nog f(1) en f(0) termen zijn kun je deze vervangen door 1
  - de weergave kan er als volgt uit zien:
  
  f(10) = f(9) + f(8)
  f(10) = f(8) + f(7) + f(7) + f(6)
  ...
  ..
  .
  f(10) = f(2) + f(1) + 1 + 1 + 1 + 1 + 1 .............. 
  f(10) = f(1) + 1 + 1 + 1 + 1 + 1 + 1 + 1 .............
  f(10) = 1 + 1 + 1 + 1 + 1 + 1 + 1 + 1 + 1 + 1.........
  f(10) = 55
  
  - voor eenvoud kun je gebruik maken van recursie

Succes!
*/


