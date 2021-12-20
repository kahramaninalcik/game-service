## Description

game service with pure PHP on Redis.

## Requirements

```bash
* php >= 7.4
* redis installed (if not, there is a docker-compose file for redis)
```

## Install

```bash
git clone https://github.com/Kahraman160621/game-service.git

php -S localhost:8000
```

## Configurations

```bash
# config.php
```

## API

### /api/v1/user/signup

     request : {
      "username": "user", (required)
      "password": "password"  (required)
    }

    Response SUCCESS: {
        "status": "SUCCESS",
        "timestamp": "time",
        "result": {
            "id": 1,
            "username": "user",
            "password": "password"
        }

    Response ERROR: {
        "status": "ERROR",
        "timestamp": "time",
        "result": {
            "error": Error Title,
            "message": "Error Message",           
        }
    }

### /api/v1/user/signin

    request : {
      "username": "user",(required)
      "password": "password" (required) 
    }

    Response SUCCESS : {
        "status": "SUCCESS",
        "timestamp": "time",
        "result": {
            "id": "1",
            "username": "user"
        }
    }

     Response ERROR : {
        "status": "ERROR",
        "timestamp": "time",
        "result": {
            "error": Error Title,
            "message": "Error Message",           
        }
    }

### /api/v1/endgame

    request : {
        "players" : [
            {
                "id": 1, (required)
                "score": X (0-100)
            },
            {
                "id": 2, (required)
                "score": X (0-100)
            }
        ]
    }

    Response SUCCESS : {
    "status": "SUCCESS",
    "timestamp": "time",
    "result": [
            {
                "score": 80,
                "userId": "user1",
                "score": 10
            },
            {
                "score": 2,
                "userId": "user2",
                "score": 6
            }
        ]
    }
    
    Response ERROR : {
        "status": "ERROR",
        "timestamp": "time",
        "result": {
            "error": Error Title,
            "message": "Error Message",           
        }
    }

### /api/v1/leaderboard
   
    Response SUCCESS: {
    "status": "SUCCESS",
    "timestamp": "time",
    "result": [
        {
            "rank": 1,
            "id": 4,
            "username": "user4",
          
        },
        {
            "rank": 2,
            "id": 1,
            "username": "user1",
           
        },
        {
            "rank": 3,
            "id": 2,
            "username": "user2",
           
        }
    ]
    }

    Response ERROR : {
        "status": "ERROR",
        "timestamp": "time",
        "result": {
            "error": Error Title,
            "message": "Error Message",           
        }
    }
       
