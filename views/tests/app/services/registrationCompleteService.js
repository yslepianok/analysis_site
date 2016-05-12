'use strict';

myApp.service('registrationCompleteService', ['$timeout', function ($timeout) {

    var observerCallback;
    this.registrationComplete = false;

    //register an observer
    this.registerObserver = function(callback){
        observerCallback = callback;
    };

    var notifyObserver = function(){
        if (observerCallback) {
            observerCallback();
        } else {
            console.log("notify observer is empty");
        }
    };

    this.registrationCompleteFn = function() {
        var _self = this;
        this.registrationComplete = true;
        $timeout(function() {
            _self.registrationComplete = false;
            notifyObserver();
        }, 3000);
    }
}]);