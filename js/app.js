
var app = angular.module('instructorApp', []);



app.controller('dataCtrl', function($scope, $http) {
    
    
    
    var serializedData;
    
    $http.get("data.php")
    .then(function (response) {
        $scope.instructors = response.data.instructors;
        $scope.emotion = response.data.emotion;
        $scope.knowledge = response.data.knowledge;
        
    });
    
    
    
    
    $scope.check_level = function() {
        $scope.selected_quadrant = null;
        if($scope.selected_instructor.instructor_level == 3) {
            $scope.quadrants = ["Emotion", "Knowledge"];
        } else {
            $scope.quadrants = ["Emotion"];
        }
    };
    
    $scope.submit_grade = function(){
        $scope.confirm = false;
        //console.log(serializedData);
        
        $.ajax({
            url: 'submit.php',
            type: 'post',
            data: {"instructor": $scope.selected_instructor.instructor_name,
                    "quadrant": $scope.selected_quadrant,
                    "grade": serializedData},
            success: function(data, response, status) {
                $("#success").html(data);
                $scope.$apply(function(){
                    $scope.alldone = true;
                })
                
            },
            error: function(xhr, desc, err) {
                console.log("Error");
            }
        });
        
        $(document).ajaxComplete(function(){
            $scope.alldone = true;
        });
        
    };
    
    $scope.gradeComplete = function(){
        window.location.reload();
    }
    
    
    $(document).ready(function(){
    $('#emotion_submit').click(function(e){
        e.preventDefault();
        serializedData = $("#emotion_rating").serialize();
        
        
    })
    
    
    $('#knowledge_submit').click(function(e){
        e.preventDefault();
       serializedData = $("#knowledge_rating").serialize();
        
    })
});
    
    
});
