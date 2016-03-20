# Matrixcalc-API

Súťaž o lístky na StartUpWeekend Košice 2016 
Súťažné riešenie ktoré vykonáva požadové operácie s maticou. 

#Požiadavky

http://docs.matrixcalc.apiary.io/

#Služba beží na 

http://matrixcalc.demecko.com/api/

#Test
!!! Test mi vyhodnotilo za chybný aj ked posielal správnu hlavičku a odpoved podľa požiadaviek. 
!!! v matrixcalc.apib som musel upraviť 

Content-type: application/json

na 

Content-type: application/json;charset=utf-8    

Kedže apache a php prídáva default charset a nenašiel som dokumentáciu ako túto časť parametra odstrániť. Aby som to vedel nasadiť na zdieľaný hosting.

Oboje hlavičky sú validne. API odosiela správne odpovede s výsledkom a chybami, 

Test je pomocou  dredd v /test sposlu s upraveným blueprintom a výstupom testu 

#Výstup z testu: /test/report.log 


#Spustenie testu 

Je potrebné mať naištalované 
https://nodejs.org/en/

NPM package manager 
https://www.npmjs.com/

Naištalovaný dredd 

Pre spustenie na Unix-like machine 
bash /test/test.sh

Viac info o teste a návod 
http://blog.apiary.io/2013/10/17/How-to-test-api-with-api-blueprint-and-dredd/

#Použité technológie frameworky knižnice: 

PHP framework pre tvorbu API 
http://www.slimframework.com/

Knižnica pre operácie s maticami:
https://github.com/chippyash/Matrix
