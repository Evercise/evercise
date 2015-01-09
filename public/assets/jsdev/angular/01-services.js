app.service('dataService', function($http) {
    delete $http.defaults.headers.common['X-Requested-With'];
    this.getData = function() {
        // $http() returns a $promise that we can add handlers with .then()
        return $http({
            method: 'Post',
            url:'' ,
            params: 'limit=10, sort_by=created:desc',
            headers: {'Authorization': 'Token token='}
        });
    }
}); 