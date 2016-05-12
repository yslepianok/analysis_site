'use strict';


myApp.service('preferencesService', ['$timeout', function ($timeout) {
    
    
    this.gradations = ['red','white','green'];
    this.selectedColors = [];
    this.selectedPosButton = -1;
    this.selectedNegButton = -1;

    this.selectColor = function(letterIndex, gradationIndex) {
        this.selectedColors[letterIndex] = gradationIndex;
    }
    
    this.selectNegativeLetter = function(index) { 
        this.selectedNegButton = index;
    }
    
    this.selectPositiveLetter = function(index) {
        this.selectedPosButton = index;
    }

    this.isFormValid = function(selectedPosButton, selectedNegButton, selectedColors, itemListLength) {
        if (selectedPosButton == -1 || selectedNegButton == -1) {
            return false;
        }
        var selectedLettersLength = selectedColors.length;
        if (selectedLettersLength !== itemListLength) { 
            return false; 
        }
        for (var j = 0; j < selectedLettersLength ; j++ ) {
            if (selectedColors[j] == undefined ) {
                return false;
            }
        }

        return true;
    }

    this.outputDataFormat = function(selectedColors, selectedPosButton, selectedNegButton) {
        var selectedLength = selectedColors.length;
        var T = [];
        var outputIndex = 0;
        for (var i = 0; i < selectedLength ; i ++ ) {
            T[outputIndex] = selectedColors[i] - 1;
            outputIndex ++;
        }
        T[outputIndex] = selectedPosButton + 1;
        T[T[outputIndex]] = T[T[outputIndex]] + 2;
        outputIndex ++;
        T[outputIndex] = selectedNegButton + 1;
        T[T[outputIndex]] = T[T[outputIndex]] - 2;
        return T;
    }


    
    
}]);