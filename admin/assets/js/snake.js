const cvs = document.getElementById("snake");
const ctx2 = cvs.getContext("2d");

const box = 32;

const ground = new Image();
ground.src = "./admin/assets/snake/ground.png";

const foodImg = new Image();
foodImg.src = "./admin/assets/snake/food.png";

let dead = new Audio();
let eat = new Audio();

dead.src = "./admin/assets/snake/dead.mp3";
eat.src = "./admin/assets/snake/eat.mp3";
$(window).on('shown.bs.modal', function() { 
    if($('#snakemodal').hasClass('show')){
        let snake = [];

        snake[0] = {
            x : 9 * box,
            y : 10 * box
        };

        let food = {
            x : Math.floor(Math.random()*17+1) * box,
            y : Math.floor(Math.random()*15+3) * box
        }

        let score = 0;

        let d;

        document.addEventListener("keydown",direction);

        function direction(event){
            let key = event.keyCode;
            if( key == 37 && d != "RIGHT"){
                d = "LEFT";
            }else if(key == 38 && d != "DOWN"){
                d = "UP";
            }else if(key == 39 && d != "LEFT"){
                d = "RIGHT";
            }else if(key == 40 && d != "UP"){
                d = "DOWN";
            }
        }

        function collision(head,array){
            for(let i = 0; i < array.length; i++){
                if(head.x == array[i].x && head.y == array[i].y){
                    return true;
                }
            }
            return false;
        }

        function draw(){
            
            ctx2.drawImage(ground,0,0);
            
            for( let i = 0; i < snake.length ; i++){
                ctx2.fillStyle = ( i == 0 )? "green" : "darkgreen";
                ctx2.fillRect(snake[i].x,snake[i].y,box,box);
                
                ctx2.strokeStyle = "red";
                ctx2.strokeRect(snake[i].x,snake[i].y,box,box);
            }
            
            ctx2.drawImage(foodImg, food.x, food.y);

            let snakeX = snake[0].x;
            let snakeY = snake[0].y;
            
            if( d == "LEFT") snakeX -= box;
            if( d == "UP") snakeY -= box;
            if( d == "RIGHT") snakeX += box;
            if( d == "DOWN") snakeY += box;
            
            if(snakeX == food.x && snakeY == food.y){
                score++;
                eat.play();
                food = {
                    x : Math.floor(Math.random()*17+1) * box,
                    y : Math.floor(Math.random()*15+3) * box
                }
            }else{
                snake.pop();
            }
                
            let newHead = {
                x : snakeX,
                y : snakeY
            }
            
            if(snakeX < box || snakeX > 17 * box || snakeY < 3*box || snakeY > 17*box || collision(newHead,snake)){
                clearInterval(game);
                dead.play();
                // console.log('Perdu !');
                // alert('Partie terminé');
            }
            
            snake.unshift(newHead);
            
            ctx2.fillStyle = "darkgreen";
            ctx2.font = "45px Verdana";
            ctx2.fillText(score,2*box,1.6*box);
        }

        let game = setInterval(draw,128);
    }
})