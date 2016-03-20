# Matrixcalc-API

Súťaž o lístky na StartUpWeekend Košice 2016 


Súťažné riešenie ktoré vykonáva požadové operácie s maticou. 

Požiadavky:

http://docs.matrixcalc.apiary.io/


Služba beží na na: 

http://matrixcalc.demecko.com/api/


!!! v požiadavkách som musel upraviť 
Content-type: application/json
na 
Content-type: application/json;charset=utf-8    

Kedže apache a php prídáva default charset a nenašiel som dokumentáciu ako túto časť parametra odstrániť. Aby som to vedel nasadiť na zdieľaný hosting.

Oboje hlavičky sú validne. API odosiela správne odpovede s výsledkom a chybami, 

Test je pomocou  dredd v /test sposlu s upraveným blueprintom a výstupom testu 

Výstup z testu: /test/report.log 










Použité technológie frameworky knižnice: 

PHP framework pre tvorbu API 
http://www.slimframework.com/

Knižnica pre operácia nad maticami:
https://github.com/chippyash/Matrix
