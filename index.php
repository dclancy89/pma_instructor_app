<?php
//Main page for instructor app

?>

<html>
<head>
    <title>Polaris Martial Arts</title>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
    <script src="js/app.js"></script>
</head>

<body ng-app="instructorApp" ng-controller="dataCtrl" ng-model="instructor">
    <div class="wrapper">
        <img src="img/logo.png" />
        <h2>Instructor Accountability App</h2>
        <p class="first_time" ng-click="first_time=!first_time">First time here? Tap to find out more!</p>
        <div class="overlay" ng-show="first_time" ng-click="first_time=!first_time"><p>Polaris Martial Arts believes that holding students accountable is important for helping them become the best they can be. So if it works for the students, it works for the instructors! This app is designed to help the parents hold the instructors accountable for providing the best instruction possible. All you have to do is select an instructor and follow the prompts. </p><p style="font-size: 32px;"><br><br>Tap the window to close.</p></div>
        <div class="instructor">
            <center>
                <h3>Choose an instructor</h3>
                <select ng-model="selected_instructor" ng-options="instructor.instructor_name for instructor in instructors" ng-blur="check_level()">
                </select>
            </center>
        </div>
        
        
        <div class="quadrants" ng-show="selected_instructor">
            <center>
                <h3>Choose a grading quadrant</h3>
                <select ng-model="selected_quadrant" ng-options="quad for quad in quadrants" ng-blur="check_quad()" ng-focus="selected_quadrant=null">
                </select>
            </center>
        </div>
        
        
        
        <div class="rating" ng-show="selected_quadrant == 'Emotion'">
            <p>The following is a list of skills/tasks the instructor is expected to utilize/perform during each class. As the instructor demonstrations/performs the skill/task please check them off. To view a description of an item, tap/click on the item. </p>
            <form id="emotion_rating" name="emotion_rating" model="grade">
                <h3>Emotion</h3>
                <ol>
                    <li ng-repeat="x in emotion">
                        <input name="{{x.point_number}}" type="checkbox" value="{{x.instructor_point}}" ng-model="grade.checked" class="emotion_box">
                        <span ng-click="grade.checked = !grade.checked"></span>
                        <label for="{{x.point_number}}" ng-click="tooltip=!tooltip">{{x.instructor_point}}</label>
                        <div class="overlay" ng-show="tooltip" ng-model="tooltip" ng-click="tooltip=!tooltip"><h3>{{x.instructor_point}}</h3><p>{{x.description}}</p><p style="font-size: 32px;"><br>Tap the window to close.</p></div>
                    </li>
                </ol>
                
                <div class="confirm-button submit" id="emotion_submit" ng-click="confirm=true">Submit</div>
                
            </form>
        </div>
        
        <div class="rating" ng-show="selected_quadrant == 'Knowledge'">
            <p>The following is a list of skills/tasks the instructor is expected to utilize/perform during each class. As the instructor demonstrations/performs the skill/task please check them off. To view a description of an item, tap/click on the item. </p>
            <form id="knowledge_rating" name="knowledge_rating" model="knowledge_rating">
                <h3>Knowledge</h3>
                <ol>
                    <li ng-repeat="x in knowledge">
                        <input name="{{x.point_number}}" type="checkbox" value="{{x.instructor_point}}" ng-model="grade.checked" class="knowledge_box">
                        <span ng-click="grade.checked = !grade.checked"></span>
                        <label for="{{x.point_number}}" ng-click="tooltip=!tooltip">{{x.instructor_point}}</label>
                        <div class="overlay" ng-show="tooltip" ng-model="tooltip" ng-click="tooltip=!tooltip"><h3>{{x.instructor_point}}</h3><p>{{x.description}}</p><p style="font-size: 32px;"><br>Tap the window to close.</p></div>
                    </li>
                </ol>
                
                <div class="confirm-button submit" id="knowledge_submit" ng-click="confirm=true">Submit</div>
            </form>
        </div>
        
        
        
        <div id="success"></div>
        
        <div class="overlay" ng-show="confirm" ng-model="confirm"><center><p style="margin-top: 150px; text-align: center;">Are you sure you want to submit?</p><p class="confirm-button yes" ng-click="submit_grade()">Yes</p><p class="confirm-button no" ng-click="confirm=!confirm">No</p></center></div>
        
        <div class="overlay" ng-show="alldone" ng-model="alldone" ng-click="gradeComplete()"><p style="margin-top: 150px; text-align: center;">Your grade has been submitted. Thank you. Tap to exit.</p></div>
        
        
    </div>
    
</body>
    
</html>