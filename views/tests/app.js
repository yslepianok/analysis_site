var express = require('express');
var app = express();
var path = require('path');
var fileSystem = require('fs');
var bodyParser = require('body-parser');
var passwordHash = require('password-hash');
var fs = require('fs');

app.use('/bower_components', express.static(__dirname + '/bower_components'));
app.use('/uib', express.static(__dirname + '/uib'));
app.use('/jsApp.js', express.static(__dirname + '/jsApp.js'));
app.use('/app', express.static(__dirname + '/app'));
app.use('/lang', express.static(__dirname + '/lang'));
app.use(bodyParser.json()); // for parsing application/json

var config = require("./data/users.json");


app.get('/', function(req, res) {
    res.sendFile(path.join(__dirname + '/index.html'));
});

var users = require("./data/users.json");
var usersTestData = require("./data/usersTestData.json");

app.post('/userEntry', function (req, res) {
    if (!req.body) return res.sendStatus(400)
    
    
    var userInformation = {};

    for (var key in users) {
        if (users[key]['email'] === req.body.email && passwordHash.verify(req.body.password, users[key]['password'])) {
            userInformation.email = users[key]['email'];
            userInformation.birthDate = users[key]['birthDate'];
            userInformation.firstName = users[key]['firstName'];
            userInformation.lastName = users[key]['lastName'];
            userInformation.relations = users[key]['relations'];
            break;
        }
    }
    res.send(userInformation);

});

app.post('/getPassedTests', function (req, res) {
    if (!req.body) return res.sendStatus(400)
    
    var tests = [];
    
    var userIndex = null;
    for (var key in usersTestData) {
        if (usersTestData[key].email === req.body.email) {
            userIndex = key;
            break;
        }
    }
    
    if (userIndex == null) {
        var userWithTests = { "email": req.body.email, "tests" : [] }
        usersTestData.push(userWithTests);
        userIndex = usersTestData.length - 1;
        res.send(tests);
    }
    
    for (var key in usersTestData[userIndex].tests) {
        tests.push(usersTestData[userIndex].tests[key].testName);
    }
    
    res.send(tests);
    
    

});

app.post('/userRegistration', function (req, res) {
    if (!req.body) return res.sendStatus(400);

    var newUser = {
        "email":  req.body.email,
        "password": passwordHash.generate(req.body.password),
        "birthDate": req.body.birthDate,
        "firstName": req.body.firstName,
        "lastName": req.body.lastName,
        "relations": []
    }
    
    users.push(newUser);
    fs.writeFile('./data/users.json', JSON.stringify(users) , 'utf-8');
    res.send(true);

});

app.post('/checkEmail', function (req, res) {
    if (!req.body) return res.sendStatus(400);
    var email = req.body.email;
    var state = false;
    for (var key in users) {
        if (users[key]['email'] === email) {
            state = true;
            break;
        }
    }
    res.send(state);

});

app.post('/addRelation', function (req, res) {
    if (!req.body) return res.sendStatus(400);
    
    var index = null;
    for (var key in users) {
        if (users[key]['email'] === req.body.email) {
            index = key;
            break;
        }
    }
    
    var relation = {
        relationType: req.body.relation.relationType,
        birthDate: req.body.relation.birthDate,
        firstName: req.body.relation.firstName,
        lastName: req.body.relation.lastName,
    };
    
    users[index].relations.push(relation);
    
    fs.writeFile('./data/users.json', JSON.stringify(users) , 'utf-8');
    
    res.send(true);

});

app.post('/editRelation', function (req, res) {
    if (!req.body) return res.sendStatus(400);
    
    var index = null;
    for (var key in users) {
        if (users[key]['email'] === req.body.email) {
            index = key;
            break;
        }
    }
    
    users[index].relations = req.body.relations;
    
    fs.writeFile('./data/users.json', JSON.stringify(users) , 'utf-8');
    
    res.send(true);

});

app.post('/testInformation', function (req, res) {
    if (!req.body) return res.sendStatus(400);
    
    
    
    var userIndex = null;
    for (var key in usersTestData) {
        if (usersTestData[key].email === req.body.email) {
            userIndex = key;
            break;
        }
    }
    
    if (userIndex == null) {
        var userWithTests = { "email": req.body.email, "tests" : [] }
        usersTestData.push(userWithTests);
        userIndex = usersTestData.length - 1;
    }

    
    var testIndex = null;
    for (var key in usersTestData[userIndex].tests) {
        if (usersTestData[userIndex].tests[key].testName === req.body.testName) {
            testIndex = key;
            break;
        }
    }

    if (testIndex == null) {
        var test = {"testName" : req.body.testName, "testResults" : {} }
        usersTestData[userIndex].tests.push(test);
        testIndex = usersTestData[userIndex].tests.length - 1;
    }

    usersTestData[userIndex].tests[testIndex].testResults = req.body.testResults;

    fs.writeFile('./data/usersTestData.json', JSON.stringify(usersTestData) , 'utf-8');

    res.send(true);

});


app.post('/changeState', function (req, res) {
    setTimeout(function() { 
           res.send(true);
    },1000);

});


var randomIntFromInterval = function(min,max) {
    return Math.floor(Math.random()*(max-min+1)+min);
}

/*var requestFailed = false;*/

app.post('/getGraphData', function (req, res) {
    
    if (!req.body) return res.sendStatus(400);

    
    var x1,y1;
    var x0 = req.body.x0;
    var y0 = req.body.y0;
    var capacityY = req.body.capacityY;
    var x1min = req.body.x1min;
    
    x1 = randomIntFromInterval(x1min, x1min + 100); 
    y1 = randomIntFromInterval(0, capacityY); 
    
    var line = {x0: x0 , y0: y0 , x1: x1, y1: y1};
    
    
    /*if (!requestFailed) { // requests falls and then succeed again
        res.send(line);
        requestFailed = true;
    } else { 
        res.sendStatus(400);
        requestFailed = false;
    }*/
    res.send(line);
    
});

var statusMenuResponse;

app.post('/getMenuRequestData', function (req, res) {
    
    (statusMenuResponse) ? statusMenuResponse = false : statusMenuResponse = true;
    setTimeout(function() { 
        res.send(statusMenuResponse);
        
    },2000);
    
});


app.listen(3000, function () {
    console.log('Server running');
});