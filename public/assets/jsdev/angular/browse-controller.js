if(typeof angular != 'undefined') {

    app.controller('browseController', ["$scope",  "$http" , function ($scope, $http) {

        angular.element(document).ready(function () {
            $scope.getCats();
        });

        $scope.activeCatSwitch = function(cat){
            $scope.activeCat = cat;
        };

        // browse box

        $scope.subCategories = function(e, cat){
            e.preventDefault();
            $scope.browse = cat;
            $scope.browseIsVisible = true;
        }

        $scope.closeBrowse = function(e){
            $scope.browseIsVisible = false;
        }

        $scope.getCats = function(){
            var path = '/ajax/categories/browse';
            var req = {
                method: 'POST',
                url: path,
                headers: {
                    'X-CSRF-Token': TOKEN
                }
            }

            var responsePromise = $http(req);

            responsePromise.success(function(data) {
                $scope.categories = data;
                console.log($scope.categories);
            });

            responsePromise.error(function(data) {
                console.log("AJAX failed!");
                console.log(data);
            });
        }
    }])

}