# Matrixcalc-API

Súťaž o lístky na StartUpWeekend Košice 2016 
Súťažné riešenie ktoré vykonáva požadové operácie s maticou. 

#Požiadavky:

http://docs.matrixcalc.apiary.io/

#Služba beží na na: 

http://matrixcalc.demecko.com/api/

#Test

!!! v požiadavkách som musel upraviť 

Content-type: application/json

na 

Content-type: application/json;charset=utf-8    

Kedže apache a php prídáva default charset a nenašiel som dokumentáciu ako túto časť parametra odstrániť. Aby som to vedel nasadiť na zdieľaný hosting.

Oboje hlavičky sú validne. API odosiela správne odpovede s výsledkom a chybami, 

Test je pomocou  dredd v /test sposlu s upraveným blueprintom a výstupom testu 

#Výstup z testu: /test/report.log 

info: Beginning Dredd testing...
pass: GET /add/2-3/2-1 duration: 17105ms
pass: GET /subtract/2-3/2-1 duration: 15225ms
pass: GET /multiply/2-3/2-1 duration: 15231ms
pass: GET /divide/2-3/2-1 duration: 15220ms
pass: GET /divide/2-3/2-1 duration: 5129ms
pass: GET /sum?range=2-x duration: 5173ms
pass: GET /product?range=2-x duration: 5211ms
pass: GET /max?range=2-x duration: 5137ms
pass: GET /min?range=2-x duration: 5139ms
pass: GET /average?range=2-x duration: 5186ms
complete: 10 passing, 0 failing, 0 errors, 0 skipped, 10 total
complete: Tests took 93767ms

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

Knižnica pre operácia nad maticami:
https://github.com/chippyash/Matrix
