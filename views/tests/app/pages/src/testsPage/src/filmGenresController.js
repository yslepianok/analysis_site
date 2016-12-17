(function () {

    'use strict';

    myApp.controller('filmGenresController', filmGenresController);
    
    filmGenresController.$inject = ['$scope', '$uibModalInstance'];
    
    function filmGenresController($scope, $uibModalInstance) { 
        $scope.genreList = [['Исторические', 'Научная фантастика'],
                            ['Путешествие в игровые виртуальные миры, фентези', 'Путешествие по разным странам, континентам'],
                            ['Документальные фильмы о неизведанном с элементами мистики', 'Научно-популярные документальные фильмы'],
                            ['Интеллектуальные фильмы (Эффект ба-бочки, игры разума и т.п.)', 'Легкие фильмы (мелодрамы, комедии)'],
                            ['Крутые боевики (про хороших воров и бандитов), военные', 'Документальные и худежественные фильмы экологооздоровительной направленности'],
                            ['Ужасы, эротика, выживание в экстремальных ситуациях','Серьезные психологические']];
        $scope.testName = "film_genres_preferences";
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических различий предпочтения жанров фильмов. Инструкция проведения теста. Отметьте степень интереса к разного рода фильмам (по 10-бальной шкале) в представленных ниже 6 парах. По смыслу, описанные в каждой паре жанры фильмов, являются противоположными полюсами соответствующего аспекта темперамента человека.";
        $scope.titleList = [
            'Жанр фильма',
            'Оценка'
        ];
        $scope.modalInstance = $uibModalInstance;
    }

})();