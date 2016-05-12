myApp.service('outputLogicService', [function () {
    this.outputDataFnc = function(grades) {
        var dp;
        var t = [];
        var sumt0 = 0;
        var tempCharacterTable = [['-1-11-11','1-1-111','-111-11', '-1-1-111','11111'],
            ['-1-111-1','11-11-1','1-111-1','1-11-1-1','-11-1-1-1'],
            ['-11-1-11','1-1111','1-11-11','11-111','-1-1111'],
            ['11-1-1-1','111-1-1','1-1-1-1-1','-1-1-1-1-1','-1111-1'],
            ['-11111','11-1-11','111-11','1-1-1-11','-1-1-1-11'],
            ['1-1-11-1','-1-1-11-1','1111-1','-111-1-1','-1-11-1-1'],
            ['','','-11-11-1','-11-111','']];



        alg();

        if (sumt0 > 2) {
            do {
                dp -= 0.05;
                alg();

            } while (sumt0 <= 2)
        }

        var V;
        var knArray = [];
        var tArray = [];
        if (sumt0 === 0) {

            var tStr = t.join("");
            var kn = findingColAndRow(tStr, tempCharacterTable);
            V = 1;
            knArray = [kn];
        } else if (sumt0 === 1) {

            var t1 = [];
            var t2 = [];
            var tLength = t.length;
            V = 2;
            for (var i = 0; i < tLength; i++) {
                if (t[i] === 0) {
                    t1[i] = -1;
                    t2[i] = 1;
                } else {
                    t1[i] = t[i];
                    t2[i] = t[i];
                }
            }
            var kn1 = findingColAndRow(t1.join(""), tempCharacterTable);
            var kn2 = findingColAndRow(t2.join(""), tempCharacterTable);
            knArray = [kn1,kn2];
            tArray = [t1,t2];
        } else if (sumt0 === 2) {
            V = 4;
            // TODO: clarify this point
        }

        // point 3
        var T6 = [V, tArray,kn];
        debugger;
        return T6;


        function alg() {
            for (var j = 0; j<6 ; j++) {
                if (grades[j][1] == grades[j][0]) {
                    t[j] = 0;
                    sumt0 ++;
                    continue;
                }
                dp = (grades[j][1] - grades[j][0])/(grades[j][1] + grades[j][0]);
                if (dp < 0) {
                    dp = dp * -1;
                }

                if (dp > 0.2) {
                    t[j] = dp;
                } else {
                    sumt0 ++;
                    t[j] = 0;
                }

            }
        }

        function findingColAndRow(tStr, tempCharacterTable) {
            var tableLength = tempCharacterTable.length;
            var colLength = 0;
            var kn = [];
            for (var i = 0; i < tableLength; i++) { // finding col and row
                colLength = tempCharacterTable[i].length;
                for (var j = 0; j <colLength; j++) {
                    if (tempCharacterTable[i][j] == tStr) {
                        kn[0] = i;
                        kn[1] = j;
                    }
                }

            }
            return kn;
        }
    }
}]);