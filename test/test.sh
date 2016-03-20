#!/bin/sh
dredd matrixcalc.apib http://matrixcalc.demecko.com/api/ >>report.log
RESULT=$?
exit $RESULT
