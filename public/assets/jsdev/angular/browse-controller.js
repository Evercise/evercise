if(typeof angular != 'undefined') {

    app.controller('browseController', ["$scope",  "$http" , function ($scope, $http) {

        angular.element(document).ready(function () {
            $scope.getCats();
        });

        // set height of tab bar
        $scope.browseTabHeight = function(){
            var sideBarHeight = $('.nav-browse .items').outerHeight();

        }

        $scope.searchTerm = laracasts.results.search;
        $scope.location = laracasts.results.area.name;
        $scope.area = laracasts.results.area.id;

        // area clear
        $('input[name="location"]').change(function(){
            $scope.area = '';
            $scope.$apply();
        })

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
            });

            responsePromise.error(function(data) {
            });
        }

        $scope.submit = function(term){
            $scope.searchTerm = term;
            $scope.location = '';
            $scope.area = '';

            setTimeout(function() {
                $('#search-form').trigger('submit');
            }, 500)


        }
    }])

}